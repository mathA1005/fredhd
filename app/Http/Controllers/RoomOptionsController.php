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
        if (! Gate::allows('admin')) {
            abort(403);
        }
        return view('options.create');
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

        return redirect()->route('options.index');
    }

}

