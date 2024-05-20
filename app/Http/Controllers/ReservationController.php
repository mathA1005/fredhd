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

            // Utiliser $startDate dans la requête pour la date exacte
            $query->whereDate('start_date', $startDate);
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

        return view('admin.index', [
            'reservations' => $reservations
        ]);
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
        $start_date = Carbon::createFromFormat('d/m/Y', $arr_dates[0], 'Europe/Brussels');
        $end_date = Carbon::createFromFormat('d/m/Y', $arr_dates[1], 'Europe/Brussels');

        // Vérifier les dates de réservation
        $reserved = Reservation::query()
            ->where('room_id', $room_id)
            ->where(function($query) use ($start_date, $end_date) {
                $query->whereBetween('start_date', [$start_date, $end_date])
                    ->orWhereBetween('end_date', [$start_date, $end_date])
                    ->orWhere(function($query) use ($start_date, $end_date) {
                        $query->where('start_date', '<=', $start_date)
                            ->where('end_date', '>=', $end_date);
                    });
            })
            ->exists();

        if ($reserved) {
            Session::flash('error', "Impossible de faire cette réservation car déjà réservé");
            return redirect()->back();
        }

        Reservation::create([
            'user_id' => Auth::user()->id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'room_id' => $room_id,
        ]);

        Session::flash('success', "Votre réservation a bien été enregistrée ! N'oubliez pas de faire le virement.<br> Merci et à bientôt");
        return redirect()->route('home.index');
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
        if (!Gate::allows(Role::ADMIN)) {
            abort(403);
        }

        $users = User::all();
        $rooms = Room::all();

        return view(
            'admin.reservation.create',
            [
                'users' => $users,
                'rooms' => $rooms,
            ]
        );
    }

    public function storeFromAdmin(Request $request)
    {
        if (!Gate::allows(Role::ADMIN)) {
            abort(403);
        }

        $user_id = $request->get('user_id');

        $name = $request->get('name');
        $password = Hash::make(config('app.default_user.user_password'));
        $email = $request->get('email');

        $room_id = $request->get('room_id');
        $days = $request->get('dates');
        $arr_dates = explode(' - ', $days);
        $start_date = Carbon::createFromFormat('d/m/Y', $arr_dates[0], 'Europe/Brussels');
        $end_date = Carbon::createFromFormat('d/m/Y', $arr_dates[1], 'Europe/Brussels');

        $reserved = Reservation::query()->whereDate('start_date', '>=', $start_date)
            ->whereDate('end_date', '<=', $end_date)
            ->where('room_id', $room_id)
            ->exists();

        if ($reserved) {
            Session::flash('error', "Impossible de faire cette réservation car déjà réservé");
            return redirect()->back();
        }

        if (!$user_id) {
            $user = User::create(
                [
                    'name' => $name,
                    'password' => $password,
                    'email' => $email,
                    'role_id' => Role::where('name', Role::USER)->first()->id,
                ]
            );

            $user_id = $user->id;
        }

        Reservation::create(
            [
                'user_id' => $user_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'room_id' => $room_id,
            ]
        );

        Session::flash(
            'success',
            "Votre réservation a bien été enregistrée ! N\'oubliez pas de faire le virement.<br> Merci et à bientôt"
        );
        return redirect()->route('admin.index');
    }
}
