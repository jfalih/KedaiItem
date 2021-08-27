<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    User,
    Message
};
use App\Events\SendMessage;
use Auth;
use Pusher\Pusher;

class ChatController extends Controller
{
    public function index($user)
    {
        $user = User::where([
            ['username', '=', $user]
        ])->firstOrFail();
        $messages = Message::where([
            ['to_id', '=',$user->id],
            ['from_id', '=', Auth::user()->id]
        ])->orWhere([
            ['from_id','=',$user->id],
            ['to_id','=', Auth::user()->id]
        ])->get();
        
        return view('chat.detail', [
            'messages' => $messages,
            'seller' => $user
        ]);
    }
    public function create(Request $request, $user)
    {
        $request->validate([
            'message' => 'required'
        ],[
            'message.required' => 'Silahkan isi pesan..',
        ]);
        $user = User::where([
            ['username', '=', $user],
            ['username', '!=', Auth::user()->id]
        ])->firstOrFail();
        $message = Message::create([
            'message' => $request->message,
            'from_id' => Auth::user()->id,
            'to_id' => $user->id,
        ]);
        $message->data = view('components.chats.left',['message' => $message])->render();    
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
            );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $pusher->trigger('my-channel.'.$message->to_id, 'receive', $message);
        return response()->json(['success' => 'Berhasil menambahkan pesan!', 'data' => view('components.chats.default',['message' => $message])->render()], 200);
    }
}
