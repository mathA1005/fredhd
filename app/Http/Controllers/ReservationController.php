<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['chambre', 'user'])->get();
        return view('reservation.index', compact('reservations'));
    }
}
