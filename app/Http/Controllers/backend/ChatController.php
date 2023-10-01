<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    //
    public function SendMsg(Request $request)
    {
        $request->validate([
            "msg" => "required"
        ]);

        ChatMessage::create([
            'sender_id' => Auth::id(),
            "receiver_id" => $request->receiverid,
            "msg" => $request->msg
        ]);

        return response()->json(["message" => "Message send successfully"]);
    }

    public function GetAllUsers()
    {
        $chats = ChatMessage::orderBy("id", "DESC")
            ->where("sender_id", Auth::id())
            ->orWhere("receiver_id", Auth::id())
            ->get();

        $users = $chats->flatMap(function ($chat) {
            if ($chat->sender_id === Auth::id()) {
                return [$chat->sender, $chat->receiver];
            }
            return [$chat->receiver, $chat->sender];
        })->unique();
        return $users;
    }

    public function UserMsgById($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $messages = ChatMessage::where(function ($q) use ($userId) {
                $q->where('sender_id', Auth::id());
                $q->where('receiver_id', $userId);
            })->orWhere(function ($q) use ($userId) {
                $q->where('sender_id', $userId);
                $q->where('receiver_id', Auth::id());
            })->with('user')->get();
            return response()->json([
                'user' => $user,
                'messages' => $messages
            ]);
        } else {
            abort(404);
        }
    }

    public function AgentLiveChat()
    {
        return view("agent.message.live_chat");
    }
}
