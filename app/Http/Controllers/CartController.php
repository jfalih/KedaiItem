<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Item,
    Payment,
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
            $request->validate([
                'method' => 'required',
                'option' => 'required|in:not,premium',
            ],[
                'required' => ':attribute harus diisi.'
            ]);
                $apiKey       = 'DEV-rroiOjKiTLhDfH0zs5P3R4vDoWHLr9stBlLsBYxa';
                $privateKey   = 'UPtWn-1d1l2-CO0Kk-36QbX-xXbGl';
                $merchantCode = 'T5005';
                $merchantRef = 'KEDAIITEM';
                $amount       = Cart::getTotal();
                $arr_barang = [];
                foreach(Cart::getContent() as $item){
                    $arr_barang[] = [
                        'sku' => 'ITEM-'.$item->id,
                        'name' => $item->name,
                        'price' => $item->price,
                        'quantity' => $item->quantity
                    ];
                }
                $data = [
                    'method'         => $request->method,
                    'merchant_ref'   => $merchantRef,
                    'amount'         => $amount,
                    'customer_name'  => Auth::user()->name,
                    'customer_email' => Auth::user()->email,
                    'customer_phone' => $request->phone,
                    'order_items'    => $arr_barang,
                    'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey)
                ];
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_FRESH_CONNECT  => true,
                    CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HEADER         => false,
                    CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
                    CURLOPT_FAILONERROR    => false,
                    CURLOPT_POST           => true,
                    CURLOPT_POSTFIELDS     => http_build_query($data)
                ]);
                $response = curl_exec($curl);
                $error = curl_error($curl);
                curl_close($curl);
                if(empty($error)) {
                    $res = json_decode($response);
                    if($res->success){                        
                        $payments = Payment::create([
                            'method' => $request->method,
                            'user_id' => Auth::user()->id,
                            'options' => $request->option,
                            'total' => Cart::getTotal(),
                            'references' => $res->data->reference
                        ]);            
                        foreach(Cart::getContent() as $cart){
                            $purchase = Purchase::create([
                                'item_id' => $cart->id,
                                'user_id' => Auth::user()->id,
                                'quantity' => $cart->quantity,
                                'status' => 'pending'
                            ]);
                            $purchase->payments()->attach($payments->id);
                        }
                        return redirect()->route('payment',[
                            'id' => $payments->id
                        ]);
                    } else {
                        echo $response;
                    }
                } else {
                    return redirect()->back()->with('error', 'Gagal request pembayaran!');
                }
        } else {
            return redirect()->route('login');
        }
    }
    public function destroy(Request $request)
    {
        Cart::remove($request->id);
        return redirect()->back()->with('success','Berhasil menghapus keranjang belanja!');
    }
    public function payment($id){
        $payment = Payment::where([
            ['user_id', '=', Auth::user()->id],
            ['id', '=', $id]
        ])->firstOrFail();        
        $apiKey = 'DEV-rroiOjKiTLhDfH0zs5P3R4vDoWHLr9stBlLsBYxa';
        $payload = ['reference'	=> $payment->references];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/detail?'.http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
        ]);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        if(empty($error)) {
            $res = json_decode($response);
            if($res->success){                                 
                return view('payment',[
                    'payment' => $payment,
                    'response' => $res,
                ]);
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
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
