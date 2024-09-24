<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
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
            'review_id' => 'required|exists:reviews,id',
            'reply' => 'required|string|max:255',
        ]);

        Reply::create([
            'user_id' => Auth::id(),
            'review_id' => $request->review_id,
            'reply' => $request->reply,
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
            'reply' => 'required|string|max:255',
        ]);

        $reply = Reply::findOrFail($id);

        if ($reply->user_id !== Auth::id()) {
            abort(403);
        }

        $reply->update([
            'reply' => $request->reply,
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reply = Reply::findOrFail($id);

        if ($reply->user_id !== Auth::id()) {
            abort(403);
        }

        $reply->delete();

        return back();
    }
}
