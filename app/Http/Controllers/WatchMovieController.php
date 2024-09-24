<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\User;
use App\Models\WatchParty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchMovieController extends Controller
{
    //

    public function watch($id){

        $media = Media::find($id);
        if (!$media) {
            abort(404, 'Movie not found');
        }

        return view('users.watchMovie', ['movie' => $media]);
    }

    public function showParty() {
        $user = Auth::user();
        $parties = $user->watchParties()->with(['media', 'participants'])->get();

        $parties->map(function ($party) {
            $party->member_count = $party->participants->count();
            return $party;
        });

        return view('users.parties.watchPartyList', ['parties' => $parties]);
    }

    public function showCreateParty(){
        $user = Auth::user();
        $movies = Media::all();

        $friendsFromUserId = $user->UserColumn()->wherePivot('status', 'accepted')->get();
        $friendsFromFriendId = $user->FriendColumn()->wherePivot('status', 'accepted')->get();
        $friends = $friendsFromUserId->merge($friendsFromFriendId);

        return view('users.parties.createParty', compact('movies', 'friends'));
    }

    public function watchParty($id){
        $party = WatchParty::with(['media', 'participants', 'media.genre'])->findOrFail($id);
        $chats = $party->chats()->with('user')->orderBy('created_at')->get();
        $media = $party->media;

        if ($media) {
            $genres = $media->genre->pluck('genre_type')->implode(', ') ?: 'No genres';
        } else {
            $genres = 'No media found';
        }

        return view('users.parties.watchParty', ['media' => $media, 'genres' => $genres, 'party' => $party, 'chats' => $chats]);
    }

    public function findParty(Request $request) {
        $searchTerm = $request->search_id;

        if (!$searchTerm) {
            $searchResult = collect();
        } else {
            $searchResult = WatchParty::where('name', 'like', '%' . $searchTerm . '%')->with('media')->get();
        }

        return view('users.parties.findParty', compact('searchResult'));
    }

    public function joinParty($id){
        $user = Auth::user();
        $party = WatchParty::findOrFail($id);

        if ($party->participants()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('message', 'You are already a member of this party.');
        }

        elseif($party->participants()->count() > 8) {
            return redirect()->back()->with('message', 'The party is full.');
        }

        $party->participants()->attach($user->id, ['status' => 'joined', 'joined_at' => now(), 'created_at' => now(), 'updated_at' => now()]);

        return redirect()->route('wp.show')->with('message', 'You have joined the party.');
    }


    public function createParty(Request $request){
        $request->validate([
            'party_name' => 'required|string|max:255',
            'media_id' => 'required|exists:medias,id',
            'friend_ids' => 'required|array',
            'friend_ids.*' => 'exists:users,id',
        ]);

        $user = Auth::user();
        $party = WatchParty::create([
            'name' => $request->party_name,
            'media_id' => $request->media_id,
            'status' => 'active'
        ]);

        $party->participants()->attach($user->id, ['status' => 'joined', 'joined_at' => now(), 'created_at' => now(), 'updated_at' => now()]);
        foreach ($request->friend_ids as $friend_id) {
            $party->participants()->attach($friend_id, ['status' => 'joined', 'joined_at' => now(), 'created_at' => now(), 'updated_at' => now()]);
        }
        return redirect()->route('wp.show')->with('message', 'Party created successfully.');
    }

    public function leaveParty($id)
    {
        $user = Auth::user();
        $party = WatchParty::findOrFail($id);

        if ($party->participants()->where('user_id', $user->id)->exists()) {
            $party->participants()->detach($user->id);
            return redirect()->route('wp.show')->with('message', 'You have left the party.');
        }

        return redirect()->route('wp.show')->with('message', 'You are not a member of this party.');
    }

    public function sendMessage(Request $request, $id) {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $party = WatchParty::findOrFail($id);

        $party->chats()->create([
            'user_id' => $user->id,
            'message' => $request->message,
        ]);

        return redirect()->route('wp.watch', $id);
    }
}
