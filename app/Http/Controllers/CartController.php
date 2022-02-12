<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Item,
    Payment,
    Purchase
};
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $item = Item::findOrFail($request->id);
        if(session()->has('cart')){
            $cart = session()->get('cart');
            if(empty($cart[$item->user->username])) {
                $cart[$item->user->username][$request->id] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'quantity' => 1,
                ];
            } else {
                $cart[$item->user->username][$request->id]['quantity'] += 1;
            }
            session()->put('cart', $cart);
        } else {
            $cart = session()->get('cart');
            $cart[$item->user->username][$request->id] = [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => 1,
            ];
            session()->put('cart', $cart);
            session()->save();
        }
        return response()->json([
            'status' => true,
            'data' => $cart
        ]);
    }
    public function update(Request $request)
    {
        $cart = Session::get('cart');
        foreach($cart as $key => $val){
            $val[$request->id]['quantity'] += 1;
        }
        Session::put('cart', $cart);
        return response()->json([
            'status' => true,
            'data' => $cart
        ]);
    }
    public function checkout(Request $request)
    {
        if(Auth::check()){
            $request->validate([
                'options' => 'required',
                'options.*' => 'required|in:not,premium',
                'gusername' => 'required',
                'gusername.*' => 'required',
                'catatan'=> 'required',
                'catatan.*' => 'required',
            ],[
                'required' => ':attribute masih ada yang kosong.'
            ]);
            $cart = session()->get('cart');
            $catatan = $request->catatan;
            $gusername = $request->gusername;
            $options = $request->options;
            $total_cart = 0;
            foreach($cart as $cartVal){
                foreach($cartVal as $itemKey => $itemVal){
                    $item = Item::find($itemVal['id']);
                    $total_cart += $item->price * $itemVal['quantity'];
                    Purchase::create([
                        'item_id' => $item->id,
                        'user_id' => Auth::user()->id,
                        'quantity' => $itemVal['quantity'],
                        'catatan' => $catatan[$itemKey],
                        'gusername' => $gusername[$itemKey],
                        'options' => $options[$itemKey],
                        'status' => 'pending'
                    ]);
                }
            }
            $kode = 'KEDAIITEM-'.Str::random(30);
            $payment = Payment::create([
                'user_id' => Auth::user()->id,
                'references' => $kode,
                'total' => $total_cart,
                'kode_unik' => rand(500,600)
            ]);
            session()->forget('cart');
            return redirect()->route('payment',['id' => $payment->id]);
        } else {
            return redirect()->route('login');
        }
    }
    public function purchase($id, Request $request){
        $request->validate([
            'method' => 'required',
        ],[
            'required' => ':attribute harus diisi.'
        ]);
        
        $payment = Payment::where('user_id',Auth::user()->id)->findOrFail($id);
        $purchases = Purchase::whereHas('payments', function($q) use($payment){
            $q->where('payment_id', $payment->id);
        })->get();
        
        $apiKey       = 'DEV-rroiOjKiTLhDfH0zs5P3R4vDoWHLr9stBlLsBYxa';
        $privateKey   = 'UPtWn-1d1l2-CO0Kk-36QbX-xXbGl';
        $merchantCode = 'T5005';
        $merchantRef = 'KEDAIITEM-'.$payment->id;
        $arr_barang = [];
        
        foreach($purchases as $purchase){
            $arr_barang[] = [
                'sku' => 'ITEM-'.$purchase->item->id,
                'name' => $purchase->item->name,
                'price' => $purchase->item->price,
                'quantity' => $purchase->quantity
            ];
        }
        
        $amount = $payment->total;
        $data = [
            'method'         => $request->method,
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => Auth::user()->name,
            'customer_email' => Auth::user()->email,
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
        if(empty($error)){
            $res = json_decode($response, true);
            $payment->method = $request->method;
            $payment->references = $res['data']['reference'];
            $payment->save();
            return dd($res);   
        } else {
            return dd($err);
        }
    }
    public function payment($id)
    {
        $payment = Payment::where('user_id',Auth::user()->id)->findOrFail($id);
        $purchases = Purchase::whereHas('payments', function($q) use($payment){
            $q->where('payment_id', $payment->id);
        })->get();
        if(!$payment->method){
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
            return view('payment',[
                'payment' => $payment, 
                'purchases' => $purchases,
                'category_pembayaran' => $res,
            ]);
        } else {
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
            $res = json_decode($response, true);
            return view('payment',[
                'payment' => $payment, 
                'purchases' => $purchases,
                'category_pembayaran' => $res,
            ]);
        }
    }
    public function index()
    {
        return view('cart');
    }
}
