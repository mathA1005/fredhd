<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;

class ReservationController extends Controller
{
    public function __construct()
    {
        if (! Gate::allows('admin')) {
            abort(403);
        }
    }
    public function index(): View
    {
        $reservations = Reservation::with('room')->get();

        return view('admin.index', [
            'reservations' => $reservations
        ]);
    }
}
