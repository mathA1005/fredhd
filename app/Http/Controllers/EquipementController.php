<?php
namespace App\Http\Controllers;
use App\Models\Equipement;
use Illuminate\Http\Request;

class EquipementController extends Controller
{
    public function index()
    {
        $equipements = Equipement::all('nom'); // Récupère uniquement les noms des équipements
        return view('equipement.index', ['equipements' => $equipements]);
    }

    public function create()
    {
        return view('equipement.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string' // Assurez-vous que le formulaire contient ce champ
        ]);

        $equipement = new Equipement();
        $equipement->nom = $request->nom;
        $equipement->description = $request->description; // Assignation de la description
        $equipement->save();

        return redirect()->route('equipements.index');
    }

}

