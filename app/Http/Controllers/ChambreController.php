<?php

namespace App\Http\Controllers;
use App\Models\Equipement;
use App\Models\Chambre;
use Illuminate\Http\Request;

class ChambreController extends Controller
{
    public function index()
    {
        $chambres = Chambre::all();

        return view('chambre.index', [
            'chambres' => $chambres,
        ]);
    }
    public function create()
    {
        $equipements = Equipement::all(); // Assurez-vous que le modèle Equipement est bien importé avec use App\Models\Equipement;

        return view('chambre.create', [
            'equipements' => $equipements,
        ]);    }



    public function show($id)
    {
        // Récupère la chambre par ID, lance une erreur 404 si elle n'est pas trouvée
        $chambre = Chambre::findOrFail($id);

        // Retourne la vue avec la chambre
        return view('chambre.show', ['chambre' => $chambre]);
    }



    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'nom' => 'required|max:255',
            'description' => 'required',
            'photo' => 'required|image',
        ]);

        // Stocker le fichier photo et obtenir le chemin
        $path = $request->file('photo')->store('public/chambres');

        // Créer la nouvelle chambre avec les données validées
        $chambre = new Chambre();
        $chambre->nom = $validatedData['nom'];
        $chambre->description = $validatedData['description'];
        $chambre->photo = $path;
        $chambre->save(); // Sauvegarder la chambre avant de synchroniser les équipements

        // Vérifier si des équipements ont été fournis et les synchroniser
        if ($request->has('equipements')) {
            $chambre->equipements()->sync($request->equipements);
        }

        $equipements = Equipement::all();

        // Rediriger vers la même vue de création avec un message de succès
        return redirect()->route('chambre.create')->with([
            'success' => 'Chambre créée avec succès.',
            'equipements' => $equipements  // Assurer que les équipements sont de nouveau disponibles pour la vue
        ]);




    }}
