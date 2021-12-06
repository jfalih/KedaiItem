<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category, User, Item};
class VendorController extends Controller
{
    public function index(Request $request, $seller){
        $user = User::where('username', $seller)->first();
        $items = Item::whereHas('user', function($q) use ($seller){
            return $q->where('username', $seller);
        })->paginate(12);
        if($request->ajax()){    
            $items = Item::whereHas('user', function($q) use ($seller){
                return $q->where('username', $seller);
            })->paginate(12);
            return view('components.sections.shops.items.default',['items' => $items]);
        }
        $categories = Category::whereHas('subcategories', function($q) use($user){
            $q->whereHas('items', function($j) use($user){
                $j->where('user_id', $user->id);
            });
        })->get();
        return view('vendor', [
            'user' => $user,
            'items' => $items,
            'categories' => $categories
        ]);
    }
}
