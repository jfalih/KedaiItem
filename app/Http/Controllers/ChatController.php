<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    User,
    Message
};
use Auth;
class ChatController extends Controller
{
    public function index($user)
    {
        $user = User::where('username', $user)->firstOrFail();
        $messages = Message::where([
            ['to_id', '=',$user->id],
            ['from_id', '=', Auth::user()->id]
        ])->orWhere([
            ['from_id','=',$user->id],
            ['to_id','=', Auth::user()->id]
        ])->get();
        return view('chat.detail', [
            'messages' => $messages
        ]);
    }
    public function create(Request $request)
    {

    }
}
