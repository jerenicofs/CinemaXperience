<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class FriendController extends Controller
{

    public function ShowFriendList()
    {
        if(!auth()->check()){
            return redirect('login');
        }

        $user = auth()->user();
        $FriendsFromUserId = $user->UserColumn()->wherePivot('status', 'accepted')->get();
        $FriendsFromFriendId = $user->FriendColumn()->wherePivot('status', 'accepted')->get();
        $AllFriends = $FriendsFromUserId->merge($FriendsFromFriendId);
        // dd($AllFriends);
        return view('users.friendList', compact('AllFriends'));
    }

    public function showFriendRequests()
    {
        if(!auth()->check()){
            return redirect('login');
        }

        $user = auth()->user();
        $SentRequests = $user->UserColumn()->wherePivot('status', 'pending')->get();

        $ReceivedRequests = $user->FriendColumn()->wherePivot('status', 'pending')->get();

        $PendingRequests = $SentRequests->merge($ReceivedRequests);

        return view('users.friendRequest', compact('PendingRequests'));

    }

    public function acceptFriend($friendId)
    {
        $user = auth()->user();
        $user->FriendColumn()->updateExistingPivot($friendId,['status' => 'accepted']);
        return redirect()->route('friendrequests');
    }

    public function rejectFriend($friendId)
    {
        $user = auth()->user();
        // \Log::info("Rejecting request: User {$user->id} -> Friend {$friendId}");
        $user->FriendColumn()->updateExistingPivot($friendId,['status' =>'rejected'])->detach($friendId);
        return redirect()->route('friendrequests');
    }

    public function removeFriend($FriendId)
    {
        // \Log::info("Attempting to remove friend with ID: $FriendId");
        $user = auth()->user();
        $user->FriendColumn()->detach($FriendId);
        $user->UserColumn()->detach($FriendId);
        return redirect()->route('friendlist');
    }

    public function cancelRequest($friendId)
    {
        $user = auth()->user();
        // \Log::info("Cancelling request: User {$user->id} -> Friend {$friendId}");
        $user->UserColumn()->detach($friendId);
        return redirect()->route('friendrequests');

    }

    public function showAddFriendForm()
    {
        if(!auth()->check()){
            return redirect('login');
        }
        return view('users.addFriend');
    }

    public function searchFriend(Request $request)
    {
        $searchId = $request->input('search_id');
        $searchResult = User::find($searchId);

        if (!$searchResult || $searchResult->role == 'admin') {
            return redirect()->route('addfriend')->with('error', 'No user found with that ID.');
        }
        else if($searchId == auth()->user()->id){
            return redirect()->route('addfriend')->with('error', 'You cannot add your own ID.');
        }

        return view('users.addFriend', compact('searchResult'));
    }

    public function searchFriendByName(Request $request)
    {
        $searchName = $request->input('name');
        $searchResults = User::where('name', 'like', '%' . $searchName . '%')->where('role', '!=', 'admin')->get();

        if (!$searchResults) {
            return redirect()->route('addfriend')->with('error', 'No user found.');
        }

        return view('users.addFriend', compact('searchResults'));
    }

    public function addFriend(Request $request)
    {
        $user = auth()->user();
        $friendId = $request->input('friend_id');
        $targetUser = User::find($friendId);
        if ($targetUser && $targetUser->role == 'admin') {
        return redirect()->back()->with('error', 'You cannot add an admin as a friend.');
        }

        // Check if the user is already friends with the provided ID
        $existingFriendship = DB::table('user_friend_lists')
            ->where(function($query) use ($user, $friendId) {
                $query->where('user_id', $user->id)
                      ->where('friend_id', $friendId);
            })
            ->orWhere(function($query) use ($user, $friendId) {
                $query->where('user_id', $friendId)
                      ->where('friend_id', $user->id);
            })
            ->first();

        if ($existingFriendship) {
            return redirect()->back()->with('error', 'You are already friends or have a pending request.');
        }

        // Add the friend request
        DB::table('user_friend_lists')->insert([
            'user_id' => $user->id,
            'friend_id' => $friendId,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('friendrequests')->with('success', 'Friend request sent.');
    }

}
