<?php

namespace App\Http\Controllers;
use App\Models\RoomOptions;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class RoomController extends Controller
{
    public function index()
    {
        $room = Room::all();

        return view('chambre.index', [
            'chambres' => $room,
        ]);
    }
    public function create()
    {   if (! Gate::allows('admin')) {
        abort(403);
    }
        $equipements = RoomOptions::all(); // Assurez-vous que le modèle RoomOptions est bien importé avec use App\Models\RoomOptions;

        return view('chambre.create', [
            'equipements' => $equipements,
        ]);    }



    public function show($id)
    {
        // Récupère la chambre par ID, lance une erreur 404 si elle n'est pas trouvée
        $room = Room::findOrFail($id);

        // Retourne la vue avec la chambre
        return view('chambre.show', ['room' => $room]);
    }



    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'label' => 'required|max:255',
            'description' => 'required',
            'picture' => 'required|image',
        ]);

        // Stocker le fichier photo et obtenir le chemin
        $path = $request->file('picture')->store('public/chambres');

        // Créer la nouvelle chambre avec les données validées
        $room = new Room();
        $room->label = $validatedData['label'];
        $room->description = $validatedData['description'];
        $room->picture = $path;
        $room->save(); // Sauvegarder la chambre avant de synchroniser les équipements

        // Vérifier si des équipements ont été fournis et les synchroniser
        if ($request->has('equipements')) {
            $room->roomOptions()->sync($request->room_options);
        }

        $equipements = roomOptions::all();

        // Rediriger vers la même vue de création avec un message de succès
        return redirect()->route('chambre.create')->with([
            'success' => 'Room créée avec succès.',
            'equipements' => $equipements  // Assurer que les équipements sont de nouveau disponibles pour la vue
        ]);

    }


}
