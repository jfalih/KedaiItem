<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Item,
    Purchase
};
use Cart;
use Auth;

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
    public function update(Request $request)
    {
        $cart = Cart::update($request->id,[
            'quantity' => $request->quantity
        ]);
        return response()->json([
            'item'=> Cart::getContent(),
            'total' => Cart::getTotal()
        ]);
    }
    public function checkout(Request $request)
    {
        if(Auth::check()){
            foreach(Cart::getContent() as $cart){
                Purchase::create([
                    'item_id' => $cart->id,
                    'user_id' => Auth::user()->id,
                    'quantity' => $cart->quantity,
                    'status' => 'pending'
                ]);
            }
            return redirect()->route('payment');
        } else {
            return redirect()->route('login');
        }
    }
    public function destroy(Request $request)
    {
        Cart::remove($request->id);
        return redirect()->back()->with('success','Berhasil menghapus keranjang belanja!');
    }
    public function index()
    {
        
        $apiKey = 'LqR9FsmjGCqj6ahtQyyI666Rtiie1bEiur8xwThv';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_FRESH_CONNECT  => true,
        CURLOPT_URL            => 'https://tripay.co.id/api/merchant/payment-channel',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
        CURLOPT_FAILONERROR    => false
        ));
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        $res = json_decode($response, true);
        return view('cart', ['data_pembayaran' => $res['data']]);
    }
}
