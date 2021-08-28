<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    User,
    Convertation,
    Message
};
use App\Events\SendMessage;
use Auth;
use Pusher\Pusher;

class ChatController extends Controller
{
    public function index($user)
    {
        $seller = User::where([
            ['username', '=', $user]
        ])->firstOrFail();
        $convertation = Convertation::where([
            ['from_id', '=', Auth::user()->id],
            ['to_id', '=', $seller->id]
        ])->exist();
        if($convertation){
            $messages = Message::where('convertation_id', $convertation->first()->id)->get();
            return view('chat.detail', [
                'messages' => $messages,
                'seller' => $seller
            ]);
        } else {
            return view('chat.detail', [
                'messages' => [],
                'seller' => $seller
            ]);
        }
    }   
    public function create($user, Request $request)
    {
        $request->validate([
            'message' => 'required'
        ],[
            'message.required' => 'Silahkan isi pesan..',
        ]);
        $seller = User::where('username', $user)->firstOrFail();
        $check_convertation = Convertation::whereHas('sender', function($q){
            $q->where('id', Auth::user()->id);
        })->whereHas('receiver', function($q) use ($seller){
            $q->where('id', $seller->id);
        });
        if($check_convertation->count() == 0){
            $convertation = Convertation::create([
                'from_id' => Auth::user()->id,
                'to_id' => $seller->id
            ]);
            $message = Message::create([
                'convertation_id' => $convertation->id, 
                'message' => $request->message,
                'from_id' => Auth::user()->id,
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
            $pusher->trigger('my-channel.'.Auth::user()->id, 'receive', $message);
            return response()->json(['success' => 'Berhasil menambahkan pesan!', 'data' => view('components.chats.default',['message' => $message])->render()], 200);    
        } else {
            $message = Message::create([
                'convertation_id' => $check_convertation->first()->id, 
                'message' => $request->message,
                'from_id' => Auth::user()->id,
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
            $pusher->trigger('my-channel.'.Auth::user()->id, 'receive', $message);
            return response()->json(['success' => 'Berhasil menambahkan pesan!', 'data' => view('components.chats.default',['message' => $message])->render()], 200);    
        }
    }
}
