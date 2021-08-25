<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    User
};
class ChatController extends Controller
{
    public function index($user)
    {
        $user = User::where('username', $user)->firstOrFail();
        return view('chat.detail');
    }
}
