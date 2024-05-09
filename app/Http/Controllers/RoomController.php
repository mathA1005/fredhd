<?php

namespace App\Http\Controllers;
use App\Models\RoomOptions;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $chambres = Room::all();

        return view('chambre.index', [
            'chambres' => $chambres,
        ]);
    }
    public function create()
    {
        $equipements = RoomOptions::all(); // Assurez-vous que le modèle RoomOptions est bien importé avec use App\Models\RoomOptions;

        return view('chambre.create', [
            'equipements' => $equipements,
        ]);    }



    public function show($id)
    {
        // Récupère la chambre par ID, lance une erreur 404 si elle n'est pas trouvée
        $chambre = Room::findOrFail($id);

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
        $chambre = new Room();
        $chambre->nom = $validatedData['nom'];
        $chambre->description = $validatedData['description'];
        $chambre->photo = $path;
        $chambre->save(); // Sauvegarder la chambre avant de synchroniser les équipements

        // Vérifier si des équipements ont été fournis et les synchroniser
        if ($request->has('equipements')) {
            $chambre->roomOptions()->sync($request->equipements);
        }

        $equipements = roomOptions::all();

        // Rediriger vers la même vue de création avec un message de succès
        return redirect()->route('chambre.create')->with([
            'success' => 'Room créée avec succès.',
            'equipements' => $equipements  // Assurer que les équipements sont de nouveau disponibles pour la vue
        ]);




    }}
