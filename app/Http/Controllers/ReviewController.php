<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ReviewController extends Controller
{


    public function index()
    {
        $reviews = Review::with('user')->latest()->get();
        return view('reviews.index', compact('reviews'));
    }

    public function adminIndex()
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }
        $reviews = Review::latest()->get();
        return view('admin.reviews.index', compact('reviews'));
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

        return redirect()->back()->with('success', 'Merci pour votre avis. Votre avis a bien été ajouté.');
    }

    public function destroy($id)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }

        $review = Review::find($id);

        if ($review) {
            $review->delete();
            return redirect()->back()->with('success', 'L\'avis a été supprimé.');
        }

        return redirect()->back()->with('error', 'L\'avis n\'a pas été trouvé.');
    }
}
