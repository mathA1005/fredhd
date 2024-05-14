<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FAQController extends Controller
{
    public function index()
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }
        $faqs = FAQ::all();
        return view('admin.faqs.index', compact('faqs'));

    }

    public function create()
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        FAQ::create($request->all());
        return redirect()->route('admin.faqs.index');
    }

    public function edit($id)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }
        $faq = FAQ::findOrFail($id);
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq = FAQ::findOrFail($id);
        $faq->update($request->all());
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ mise à jour avec succès');
    }

    public function destroy($id)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }
        $faq = FAQ::findOrFail($id);
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ supprimée avec succès');
    }

    public function showForUsers()
    {
        $faqs = FAQ::all();
        return view('faqs.index', compact('faqs'));
    }
}
