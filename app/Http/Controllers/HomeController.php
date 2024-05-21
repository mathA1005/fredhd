<?php

namespace App\Http\Controllers;

use App\Models\Room; // Assurez-vous d'importer le modèle Room
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer les 5 premières chambres
        $rooms = Room::take(2)->get();

        // Passer les chambres à la vue
        return view('index', [
            'rooms' => $rooms
        ]);
    }
}
