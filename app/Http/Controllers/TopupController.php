<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Paymentcategory,
    Topup,
    User
};
use Auth;
use DataTables;
class TopupController extends Controller
{
    public function index(Request $request){
        $categoryPayment = Paymentcategory::where('status_id', 1)->get();
        $topup = Topup::where('user_id', Auth::user()->id)->get();
        if($request->ajax()){ 
            return DataTables::of($topup)
            ->addIndexColumn()
            ->addColumn('method', function (Topup $topup) {
                return $topup->paymentcategory->name;
            })
            ->addColumn('nominal', function(Topup $topup){
                return 'Rp'.number_format($topup->nominal,0,',','.');
            })
            ->addColumn('kode_unik', function(Topup $topup){
                return 'Rp'.number_format($topup->kode_unik,0,',','.');
            })
            ->addColumn('status', function (Topup $topup) {
                return view('pembelian.status', [
                    'data' => $topup
                ]);
            })
            ->addColumn('action', function (Topup $topup) {
                return view('topup.action', [
                    'data' => $topup
                ]);
            })
            ->addColumn('total', function (Topup $topup){
                return 'Rp'.number_format($topup->nominal + $topup->kode_unik,0,',','.');
            })
            ->make(true);
        }
        return view('topup', [
            'categoryPayment' => $categoryPayment
        ]);
    }

    public function topup(Request $request){
        $request->validate([
            'nominal' => 'required',
            'method' => 'required'
        ],[
            'required' => ':attribute harus diisi.'
        ]);
        $topup = Topup::create([
            'nominal' => $request->nominal,
            'method_id' => $request->method,
            'user_id' => Auth::user()->id,
            'kode_unik' => rand(500,900)
        ]);
        
        $apiKey       = 'DEV-rroiOjKiTLhDfH0zs5P3R4vDoWHLr9stBlLsBYxa';
        $privateKey   = 'UPtWn-1d1l2-CO0Kk-36QbX-xXbGl';
        $merchantCode = 'T5005';
        $merchantRef = 'KEDAIITEM-'.$topup->id;
        $arr_barang = [
            [
                'sku' => 'TOPUP-'.$topup->id,
                'name' => 'Topup Kedaiitem '.$topup->nominal,
                'price' => $topup->nominal,
                'quantity' => 1,
            ],
            [
                'sku' => 'KODEUNIK-'.$topup->id,
                'name' => 'Kode Unik Kedaiitem '.$topup->kode_unik,
                'price' => $topup->kode_unik,
                'quantity' => 1,
            ],
        ];
        $amount = $topup->nominal + $topup->kode_unik;
        $data = [
            'method'         => $topup->paymentcategory->code,
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
            $topup->references = $res['data']['reference'];
            $topup->save();
            return redirect()->route('topup.detail', ['id' => $topup])->with('success', 'Berhasil request topup saldo!');
        } else {
            return redirect()->back()->with('error', 'Gagal request topup saldo!');
        }
    }

    public function detail($id) {
        $topup = Topup::findOrFail($id);
        $apiKey = 'DEV-rroiOjKiTLhDfH0zs5P3R4vDoWHLr9stBlLsBYxa';
        $payload = ['reference'	=> $topup->references];
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
        if (empty($error)){
            $res = json_decode($response, true);
            return view('topup.detail', [
                'topup' => $topup,
                'data_api' => $res
            ]);
        } else {
            return redirect()->back()->with('error', 'Tidak dapat menemukan data topup!');
        }
    }
    public function check($id){
        $topup = Topup::findOrFail($id);
        $user = User::find(Auth::user()->id);
        $apiKey = 'DEV-rroiOjKiTLhDfH0zs5P3R4vDoWHLr9stBlLsBYxa';
        $payload = ['reference'	=> $topup->references];
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
        if (empty($error)){
            $res = json_decode($response, true);
            if($res['data']['status'] != 'PAID') {
                return redirect()->back()->with('error', 'Pembayaran belum dibayar!');
            } else if($topup->status == 'success') {
                return redirect()->back()->with('error', 'Pembayaran sudah pernah dilakukan!');
            } else {
                $topup->status = 'success';
                $topup->save();
                $user->balance += ($topup->nominal + $topup->kode_unik);
                $user->save();
                return redirect()->back()->with('success', 'Pembayaran berhasil dibayarkan!');            
            } 
        } else {
            return redirect()->back()->with('error', 'Tidak dapat menemukan data topup!');
        }
    }
    public function cancel($id){
        $topup = Topup::find($id);
        $topup->status = 'canceled';
        $topup->save();
        return redirect()->back()->with('success', 'Berhasil membatalkan topup saldo!');
    }
}
