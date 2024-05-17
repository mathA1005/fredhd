<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('contact',
            ['contacts' => $contacts]);
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
        Contact::create($request->all());

        return redirect('/contact')->with('success', 'Formulaire soumis avec succès!');
    }
    public function adminIndex()
    {
        $contacts = Contact::all();
        return view('admin.contacts.index', ['contacts' => $contacts]);
    }


}
