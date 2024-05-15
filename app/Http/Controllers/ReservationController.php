<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function __construct()
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }
    }

    public function index(Request $request): View
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

        // Filtrage par date de début
        if ($request->filled('start_date')) {
            $startDate = Carbon::createFromFormat('Y-m-d', $request->input('start_date'))->startOfDay();
            $query->where('start_date', '>=', $startDate);
        }

        // Tri par nom d'utilisateur
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
}
