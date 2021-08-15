<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
class WelcomeController extends Controller
{
    public function index()
    {
        $items = Item::inRandomOrder()->limit(5)->get();        
        return view('welcome', [
            'items' => $items
        ]);
    }
}
