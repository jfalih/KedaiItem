<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Item,
    Subcategory
};
use Illuminate\Database\Eloquent\Builder;

class WelcomeController extends Controller
{
    public function index()
    {
        $random_items = Item::inRandomOrder()->limit(8)->get();
        $latest_items = Item::orderBy('created_at','ASC')->limit(8)->get();
        $subcategories = Subcategory::whereHas('status', function(Builder $q){
            $q->where('name','active');
        })->limit(3)->get();
        return view('welcome', [
            'random_items' => $random_items,
            'latest_items' => $latest_items,
            'subcategories' => $subcategories
        ]);
    }
}
