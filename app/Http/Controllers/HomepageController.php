<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $chambres = Chambre::all();

        return view('homepage.index', [
            'chambres' => $chambres,
        ]);
    }
}
