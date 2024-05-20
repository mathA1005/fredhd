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
        // Pagination ajoutée et récupération des options associées
        $rooms = Room::with('roomOptions')->paginate(10);

        return view('rooms.index', [
            'rooms' => $rooms,
        ]);
    }

    public function create()
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }

        $roomOptions = RoomOptions::all();

        return view('admin.rooms.create', [
            'roomOptions' => $roomOptions,
        ]);
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);

        return view('rooms.show', ['room' => $room]);
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);

        if (!Gate::allows('admin')) {
            abort(403);
        }

        $roomOptions = RoomOptions::all();
        $roomOptionsValues = $room->roomOptions->pluck('pivot.value', 'id')->toArray();

        return view('admin.rooms.edit', [
            'room' => $room,
            'roomOptions' => $roomOptions,
            'roomOptionsValues' => $roomOptionsValues,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'label' => 'required|max:255',
            'description' => 'required',
            'picture' => 'nullable|image',
            'price_per_night' => 'required|numeric|min:0',
        ]);

        $room = Room::findOrFail($id);
        $room->label = $validatedData['label'];
        $room->description = $validatedData['description'];
        $room->price_per_night = $validatedData['price_per_night'];

        if ($request->hasFile('picture')) {
            // Stocker le fichier photo et obtenir le chemin
            $path = $request->file('picture')->store('public/rooms');
            $room->picture = $path;
        }

        $room->save(); // Sauvegarder les modifications

        if ($request->has('roomOptions')) {
            $values = $request->input('roomOptionsValues', []);
            $syncData = [];

            foreach ($request->input('roomOptions') as $optionId) {
                $value = isset($values[$optionId]) ? $values[$optionId] : null; // Utiliser une valeur par défaut si nécessaire
                if ($value !== null) { // S'assurer que la valeur n'est pas nulle
                    $syncData[$optionId] = ['value' => $value];
                }
            }

            $room->roomOptions()->sync($syncData);
        }

        return redirect()->route('admin.rooms.index')->with('success', 'Room mise à jour avec succès.');
    }

    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'label' => 'required|max:255',
            'description' => 'required',
            'picture' => 'required|image',
            'price_per_night' => 'required|numeric|min:0',
        ]);

        // Stocker le fichier photo et obtenir le chemin
        $path = $request->file('picture')->store('public/rooms');

        $room = new Room();
        $room->label = $validatedData['label'];
        $room->description = $validatedData['description'];
        $room->picture = $path;
        $room->price_per_night = $validatedData['price_per_night'];
        $room->save(); // Sauvegarder la room avant de synchroniser les équipements

        if ($request->has('roomOptions')) {
            $values = $request->input('roomOptionsValues', []);
            $syncData = [];

            foreach ($request->input('roomOptions') as $optionId) {
                $value = isset($values[$optionId]) ? $values[$optionId] : null; // Utiliser une valeur par défaut si nécessaire
                if ($value !== null) { // S'assurer que la valeur n'est pas nulle
                    $syncData[$optionId] = ['value' => $value];
                }
            }

            $room->roomOptions()->sync($syncData);
        }

        return redirect()->route('admin.rooms.create')->with('success', 'Room créée avec succès.');
    }

    public function adminIndex()
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }

        $rooms = Room::with('roomOptions')->paginate(10);

        return view('admin.rooms.index', [
            'rooms' => $rooms,
        ]);
    }
}
