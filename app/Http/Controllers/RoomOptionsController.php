<?php

namespace App\Http\Controllers;

use App\Models\RoomOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoomOptionsController extends Controller
{

    public function index()
    {
        // Récupère toutes les options de salle depuis la base de données
        $roomOptions = RoomOptions::all();

        // Passe les options à la vue "index.blade.php"
        return view('options.index', ['roomOptions' => $roomOptions]);
    }

    public function create()
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }
        return view('admin.options.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'icon' => 'required|string|max:255',
                'label' => 'required|string' // Assurez-vous que le formulaire contient ce champ
            ]
        );

        $roomOptions = new RoomOptions();
        $roomOptions->icon = $request->icon;
        $roomOptions->label = $request->label; // Assignation de la description
        $roomOptions->save();

        return redirect()->route('admin.options.index');
    }

    public function edit($id)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }

        $roomOption = RoomOptions::findOrFail($id);

        return view('admin.options.edit', ['roomOption' => $roomOption]);
    }

    public function update(Request $request, $id)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }

        $request->validate([
            'icon' => 'required|string|max:255',
            'label' => 'required|string' // Assurez-vous que le formulaire contient ce champ
        ]);

        $roomOption = RoomOptions::findOrFail($id);
        $roomOption->icon = $request->icon;
        $roomOption->label = $request->label;
        $roomOption->save();

        return redirect()->route('admin.options.index');
    }

    public function destroy($id)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }

        $roomOption = RoomOptions::findOrFail($id);
        $roomOption->delete();

        return redirect()->route('admin.options.index');
    }

    public function adminIndex()
    {
        // Vérification si l'utilisateur est un administrateur
        if (!Gate::allows('admin')) {
            abort(403);
        }

        // Récupère toutes les options de salle depuis la base de données
        $roomOptions = RoomOptions::all();

        // Passe les options à la vue "admin.index.blade.php"
        return view('admin.options.index', ['roomOptions' => $roomOptions]);
    }

}

