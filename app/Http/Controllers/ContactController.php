<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('contact', ['contacts' => $contacts]);
    }

    public function submitForm(Request $request)
    {
        // Valider les entrées
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:15',
            'description' => 'required|string|max:500',
        ]);

        // Enregistrer le contact dans la base de données
        Contact::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'description' => $request->description,
            'status' => 'untreated' // Statut par défaut
        ]);

        return redirect('/contact')->with('success', 'Formulaire soumis avec succès!');
    }

    public function updateStatus(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $request->validate([
            'status' => 'required|string|in:untreated,in process,treated,close'
        ]);

        $contact->status = $request->input('status');
        $contact->save();

        return redirect()->route('admin.contacts.index')->with('success', 'Statut mis à jour avec succès!');
    }

    public function adminIndex(Request $request)
    {
        $sort = $request->query('sort', 'created_at'); // Par défaut, trier par date de création
        $order = $request->query('order', 'asc'); // Par défaut, ordre ascendant
        $status = $request->query('status', ''); // Par défaut, pas de filtre de statut
        $search = $request->query('search', ''); // Recherche par prénom

        $query = Contact::orderBy($sort, $order);

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where('last_name', 'like', '%' . $search . '%');
        }

        $contacts = $query->get();

        return view('admin.contacts.index', [
            'contacts' => $contacts,
            'sort' => $sort,
            'order' => $order,
            'status' => $status,
            'search' => $search
        ]);
    }
}
