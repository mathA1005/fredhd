<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Review; // Assurez-vous d'importer le modèle Review
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer les 2 premières chambres
        $rooms = Room::take(2)->get();

        // Récupérer les 3 derniers avis
        $reviews = Review::with('user')->latest()->take(9)->get();

        // Passer les chambres et les avis à la vue
        return view('index', [
            'rooms' => $rooms,
            'reviews' => $reviews
        ]);
    }
}
