<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Item};
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
        return view('vendor', [
            'user' => $user,
            'items' => $items
        ]);
    }
}
