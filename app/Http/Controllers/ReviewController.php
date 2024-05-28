<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Review;
use Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return to_route('login');
        }    }

    public function index()
    {
        $reviews = Review::with('user')->latest()->get();
        return view('reviews.index', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Votre avis a été ajouté.');
    }
}
