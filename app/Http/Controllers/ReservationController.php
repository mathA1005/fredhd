<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['chambre', 'admin'])->get();
        return view('Admin.index', compact('reservations'));
    }
}
