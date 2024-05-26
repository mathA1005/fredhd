<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Role;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with('room', 'user');

        // Filtrage par nom de chambre ou par nom d'utilisateur
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->whereHas('room', function ($query) use ($search) {
                    $query->where('label', 'like', "%$search%");
                })->orWhereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                });
            });
        }

        // Filtrage par date exacte
        if ($request->filled('start_date')) {
            $startDate = Carbon::createFromFormat('Y-m-d', $request->input('start_date'))->startOfDay();
            $query->whereDate('start_date', $startDate);
        }

        // Filtrage par les 7 prochains jours
        if ($request->filled('next_7_days') && $request->input('next_7_days') == 'true') {
            $today = Carbon::today();
            $nextWeek = $today->addDays(7);
            $query->whereBetween('start_date', [$today, $nextWeek]);
        }

        // Tri par nom d'utilisateur ou autre critère
        if ($request->filled('sort_by') && $request->filled('order')) {
            $sortBy = $request->input('sort_by');
            $order = $request->input('order');
            if ($sortBy == 'user_name') {
                $query->join('users', 'reservations.user_id', '=', 'users.id')
                    ->orderBy('users.name', $order);
            } else {
                $query->orderBy($sortBy, $order);
            }
        } else {
            $query->orderBy('start_date', 'asc'); // Tri par défaut
        }

        $reservations = $query->get(['reservations.*']); // S'assurer que les champs de réservation sont sélectionnés

        return view('admin.index', ['reservations' => $reservations]);
    }

    public function show(int $id)
    {
        $room = Room::with('roomOptions')->findOrFail($id);
        $roomOptions = $room->roomOptions;
        $reservations = Reservation::where('room_id', $id)->get(['start_date', 'end_date']);

        return view('reservation.index', [
            'room' => $room,
            'roomOptions' => $roomOptions,
            'reservations' => $reservations,
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return to_route('login');
        }

        $room_id = $request->get('room');
        $days = $request->get('dates');
        $arr_dates = explode(' - ', $days);

        // Assurez-vous que le format de date est correct
        try {
            $start_date = Carbon::createFromFormat('Y-m-d', $arr_dates[0], 'Europe/Brussels')->startOfDay();
            $end_date = Carbon::createFromFormat('Y-m-d', $arr_dates[1], 'Europe/Brussels')->endOfDay();
        } catch (\Exception $e) {
            Session::flash('error', "Le format des dates est incorrect.");
            return redirect()->back();
        }

        // Vérifier les dates de réservation
        $reserved = Reservation::query()
            ->where('room_id', $room_id)
            ->where(function ($query) use ($start_date, $end_date) {
                $query->whereBetween('start_date', [$start_date, $end_date->copy()->subDay()])
                    ->orWhereBetween('end_date', [$start_date->copy()->addDay(), $end_date])
                    ->orWhere(function ($query) use ($start_date, $end_date) {
                        $query->where('start_date', '<=', $start_date)
                            ->where('end_date', '>=', $end_date);
                    });
            })->exists();

        if ($reserved) {
            Session::flash('error', "Impossible de faire cette réservation car déjà réservé");
            return redirect()->back();
        }

        Reservation::create([
            'user_id' => Auth::id(),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'room_id' => $room_id,
        ]);

        Session::flash('success', "Votre réservation a bien été enregistrée ! N'oubliez pas de faire le virement.<br> Merci et à bientôt");
        return redirect()->route('reservation.merci');
    }

    public function calculateTotalPrice(Request $request)
    {
        $room_id = $request->input('room_id');
        $start_date = Carbon::createFromFormat('Y-m-d', $request->input('start_date'));
        $end_date = Carbon::createFromFormat('Y-m-d', $request->input('end_date'));

        $room = Room::find($room_id);
        if (!$room) {
            return response()->json(['error' => 'Room not found'], 404);
        }

        $nights = $start_date->diffInDays($end_date);
        $totalPrice = $room->price_per_night * $nights;

        return response()->json(['totalPrice' => $totalPrice]);
    }

    public function createFromAdmin()
    {
        $users = User::all();
        $rooms = Room::with('reservations')->get();

        // Formatage des réservations pour chaque chambre
        foreach ($rooms as $room) {
            $room->reservations = $room->reservations->map(function ($reservation) {
                return [
                    'start_date' => $reservation->start_date->format('Y-m-d'),
                    'end_date' => $reservation->end_date->format('Y-m-d'),
                ];
            });
        }

        return view('admin.reservation.create', [
            'users' => $users,
            'rooms' => $rooms,
        ]);
    }

    public function storeFromAdmin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'dates' => 'required|string',
        ]);

        $user = User::find($request->input('user_id'));

        $dates = explode(' - ', $request->input('dates'));
        $start_date = Carbon::createFromFormat('Y-m-d', trim($dates[0]))->startOfDay();
        $end_date = Carbon::createFromFormat('Y-m-d', trim($dates[1]))->endOfDay();

        // Vérifier si les dates sont disponibles
        $isReserved = Reservation::where('room_id', $request->input('room_id'))
            ->where(function ($query) use ($start_date, $end_date) {
                $query->whereBetween('start_date', [$start_date, $end_date->copy()->subDay()])
                    ->orWhereBetween('end_date', [$start_date->copy()->addDay(), $end_date])
                    ->orWhere(function ($query) use ($start_date, $end_date) {
                        $query->where('start_date', '<=', $start_date)
                            ->where('end_date', '>=', $end_date);
                    });
            })->exists();

        if ($isReserved) {
            return redirect()->back()->with('error', "La chambre est déjà réservée pour ces dates.");
        }

        Reservation::create([
            'user_id' => $user->id,
            'room_id' => $request->input('room_id'),
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);

        return redirect()->route('reservation.merci')->with('success', 'La réservation a été créée avec succès.');
    }

}
