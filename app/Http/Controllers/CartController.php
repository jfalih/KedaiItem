<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Cart;
class CartController extends Controller
{
    public function add(Request $request)
    {
        if(Cart::isEmpty())
        {
            $item = Item::findOrFail($request->id);
            if($item){
                $arr = [
                    'id' => $request->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'quantity' => $request->quantity,
                ];
                Cart::add($arr);
                return response()->json(['quantity' => Cart::getTotalQuantity()], 200);
            } else {
                return response()->json('Server Error', 500);
            }
        } else {
            $search = Cart::get($request->id);
            if($search){
                Cart::update($request->id, [
                    'quantity' => $request->quantity
                ]);        
                return response()->json(['quantity' => Cart::getTotalQuantity()], 200);
            } else {
                $item = Item::findOrFail($request->id);
                if($item){
                    $arr = [
                        'id' => $request->id,
                        'name' => $item->name,
                        'price' => $item->price,
                        'quantity' => $request->quantity,
                    ];
                    Cart::add($arr);
                    return response()->json(['quantity' => Cart::getTotalQuantity()], 200);
                } else {
                    return response()->json('Server Error', 500);
                }
            }
        }
    }
    public function destroy(Request $request)
    {
        Cart::remove($request->id);
        return redirect()->back()->with('success','Berhasil menghapus keranjang belanja!');
    }
    public function index()
    {
        return view('cart');
    }
}
