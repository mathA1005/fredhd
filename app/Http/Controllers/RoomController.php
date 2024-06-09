<?php

namespace App\Http\Controllers;

use App\Models\RoomOptions;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\RoomPicture;
use Illuminate\Support\Facades\Storage;

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
        $roomOptions = $room->roomOptions;
        $roomPictures = $room->pictures;

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
            'picture' => 'nullable|image',
            'pictures.*' => 'nullable|image',
            'price_per_night' => 'required|numeric|min:0',
        ]);

        $room = Room::findOrFail($id);
        $room->label = $validatedData['label'];
        $room->description = $validatedData['description'];
        $room->price_per_night = $validatedData['price_per_night'];

        if ($request->hasFile('picture')) {
            // Supprimer l'ancienne photo principale
            if ($room->picture) {
                Storage::delete($room->picture);
            }
            // Sauvegarder la nouvelle photo principale
            $path = $request->file('picture')->store('public/rooms');
            $room->picture = $path;
        }

        $room->save();

        // Gestion des photos supplémentaires
        if ($request->hasFile('pictures')) {
            // Supprimer les anciennes photos supplémentaires
            foreach ($room->pictures as $picture) {
                Storage::delete($picture->path);
                $picture->delete();
            }
            // Sauvegarder les nouvelles photos supplémentaires
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

        return redirect()->route('admin.rooms.index')->with('success', 'Chambre mise à jour avec succès.');
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
        $path = $request->file('picture')->store('public/storage/rooms');

        $room = new Room();
        $room->label = $validatedData['label'];
        $room->description = $validatedData['description'];
        $room->picture = $path;
        $room->price_per_night = $validatedData['price_per_night'];
        $room->save();

        // Stocker les photos supplémentaires
        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $picture) {
                $path = $picture->store('public/storage/rooms');
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

        return redirect()->route('admin.rooms.create')->with('success', 'Chambre créée avec succès.');
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
