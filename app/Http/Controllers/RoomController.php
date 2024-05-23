<?php

namespace App\Http\Controllers;

use App\Models\RoomOptions;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\RoomPicture;

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
        $room = Room::with('roomOptions', 'pictures')->findOrFail($id);
        $roomOptions = $room->roomOptions; // Assurez-vous que roomOptions est chargé
        $roomPictures = $room->pictures; // Récupérer les photos supplémentaires

        return view('rooms.show', compact('room', 'roomOptions', 'roomPictures'));
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
        $validatedData = $request->validate([
            'label' => 'required|max:255',
            'description' => 'required',
            'pictures.*' => 'nullable|image',
            'price_per_night' => 'required|numeric|min:0',
        ]);

        $room = Room::findOrFail($id);
        $room->label = $validatedData['label'];
        $room->description = $validatedData['description'];
        $room->price_per_night = $validatedData['price_per_night'];
        $room->save();

        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $picture) {
                $path = $picture->store('public/rooms');
                RoomPicture::create(['room_id' => $room->id, 'path' => $path]);
            }
        }

        if ($request->has('roomOptions')) {
            $values = $request->input('roomOptionsValues', []);
            $syncData = [];

            foreach ($request->input('roomOptions') as $optionId) {
                $value = isset($values[$optionId]) ? $values[$optionId] : null;
                if ($value !== null) {
                    $syncData[$optionId] = ['value' => $value];
                }
            }

            $room->roomOptions()->sync($syncData);
        }

        return redirect()->route('admin.rooms.index')->with('success', 'Room mise à jour avec succès.');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'label' => 'required|max:255',
            'description' => 'required',
            'picture' => 'required|image',
            'pictures.*' => 'nullable|image',
            'price_per_night' => 'required|numeric|min:0',
        ]);

        // Stocker la photo principale
        $path = $request->file('picture')->store('public/rooms');

        $room = new Room();
        $room->label = $validatedData['label'];
        $room->description = $validatedData['description'];
        $room->picture = $path;
        $room->price_per_night = $validatedData['price_per_night'];
        $room->save(); // Sauvegarder la chambre pour obtenir l'ID

        // Stocker les photos supplémentaires
        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $picture) {
                $path = $picture->store('public/rooms');
                RoomPicture::create(['room_id' => $room->id, 'path' => $path]); // Utiliser l'ID de la chambre après la sauvegarde
            }
        }

        if ($request->has('roomOptions')) {
            $values = $request->input('roomOptionsValues', []);
            $syncData = [];

            foreach ($request->input('roomOptions') as $optionId) {
                $value = isset($values[$optionId]) ? $values[$optionId] : null;
                if ($value !== null) {
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
