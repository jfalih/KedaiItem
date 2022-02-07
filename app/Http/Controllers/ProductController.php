<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Item};
class ProductController extends Controller
{
    public function index($seller, $item){
        $item = Item::where('slug', $item)->whereHas('user', function($q) use ($seller) {
            return $q->where('username', $seller);
        })->firstOrFail();
        $latest_items = Item::orderBy('created_at','ASC')->limit(8)->get();
        $related = Item::where('slug', $item)->whereHas('user', function($q) use ($seller) {
            return $q->where('username', $seller);
        })->get();
        return view('item', [
            'item' => $item,
            'latest' => $latest_items,
            'related' => $related
        ]);
    }
}
