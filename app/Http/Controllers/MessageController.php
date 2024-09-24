<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
use App\Models\User;
use Illuminate\http\jsonResponse;

class MessageController extends Controller
{
    public function storeMessage(Request $request, $friendId): JsonResponse
    {
        $message = new Message();
        $message->user_id = auth()->id();
        $message->friend_id = $friendId;
        $message->message = $request->message;
        $message->save();

        return response()->json(['message' => $message]);
    }

    public function showMessage($friendId)
    {
    $userId = auth()->id();

    $messages = Message::where(function ($query) use ($friendId, $userId) {
        $query->where('user_id', $userId)
              ->where('friend_id', $friendId);
    })->orWhere(function ($query) use ($friendId, $userId) {
        $query->where('user_id', $friendId)
              ->where('friend_id', $userId);
    })->get();

    $friends = User::find($friendId);

    return view('users.Chatbox', compact('messages', 'friendId', 'friends'));
    }
}

