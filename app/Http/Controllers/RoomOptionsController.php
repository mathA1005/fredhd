<?php
namespace App\Http\Controllers;
use App\Models\RoomOptions;
use Illuminate\Http\Request;

class RoomOptionsController extends Controller
{
    public function index()
    {
        $options = RoomOptions::all('label'); // Récupère uniquement les labels des options
        return view(
            'equipement.index',
            [
                'options' => $options
            ]
        );
    }

    public function create()
    {
        return view('equipement.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nom' => 'required|string|max:255',
                'description' => 'required|string' // Assurez-vous que le formulaire contient ce champ
            ]
        );

        $equipement = new RoomOptions();
        $equipement->nom = $request->nom;
        $equipement->description = $request->description; // Assignation de la description
        $equipement->save();

        return redirect()->route('equipements.index');
    }

}
