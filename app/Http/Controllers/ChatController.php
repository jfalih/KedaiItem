<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    User,
    Convertation,
    Message,
    Purchase
};
use App\Events\SendMessage;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class ChatController extends Controller
{
    public function index($id)
    {
        $purchase = Purchase::findOrFail($id);
        return view('chat', [
            'purchase' => $purchase,
            'messages' => $purchase->messages
        ]);
    }   
}
