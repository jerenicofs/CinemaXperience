<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'media_id' => 'required|exists:medias,id',
            'comment' => 'required|string|max:255',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'media_id' => $request->media_id,
            'comment' => $request->comment,
            'rating' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $review->update([
            'comment' => $request->comment,
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $review->delete();

        return back();
    }
}
