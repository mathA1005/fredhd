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
        $rooms = Room::paginate(10);
        $rooms = Room::with('roomOptions')->get(); // Récupère les options associées

        return view('rooms.index', [
            'rooms' => $rooms,

        ]);
    }
    public function create()
    {   if (! Gate::allows('admin')) {
        abort(403);
    }
        $roomOptions = RoomOptions::all();

        return view('rooms.create', [
            'roomOptions' => $roomOptions,
        ]);    }



    public function show($id)
    {
        $room = Room::findOrFail($id);

        return view('rooms.show', ['room' => $room]);
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

        // Créer la nouvelle rooms avec les données validées
        $room = new Room();
        $room->label = $validatedData['label'];
        $room->description = $validatedData['description'];
        $room->picture = $path;
        $room->save(); // Sauvegarder la rooms avant de synchroniser les équipements

        // Vérifier si des équipements ont été fournis et les synchroniser
        if ($request->has('roomOptions')) {
            $room->roomOptions()->sync($request->input('roomOptions'));
        }

        $roomOptions = roomOptions::all();

        // Rediriger vers la même vue de création avec un message de succès
        return redirect()->route('rooms.create')->with([
            'success' => 'Room créée avec succès.',
            'roomOption' => $roomOptions  // Assurer que les équipements sont de nouveau disponibles pour la vue
        ]);

    }


}
