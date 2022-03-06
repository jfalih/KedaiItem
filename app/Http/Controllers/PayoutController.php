<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payout;
use Auth;
use DataTables;
class PayoutController extends Controller
{
    public function index(Request $request)
    {
        $payouts = Payout::where('user_id', Auth::user()->id)->get();
        if($request->ajax()){ 
            return DataTables::of($payouts)
            ->addColumn('option', function (Payout $payouts) {
                return view('reseller.payout.option', [
                    'data' => $payouts
                ]);
            })
            ->addColumn('status', function (Payout $payouts) {
                return view('reseller.payout.status', [
                    'data' => $payouts
                ]);
            })
            ->addColumn('action', function (Payout $payouts) {
                return view('reseller.payout.action', [
                    'data' => $payouts,
                ]);
            })
            ->make(true);
        }
        return view('payout', [
            'payout' => $payouts
        ]);
        
    }
    public function show()
    {
        return view('reseller.payout.show');
    }
    public function create(Request $request)
    {
        $request->validate([
            'nominal' => 'required|min:30000|integer',
            'options' => 'required',
            'options.*' => 'required|in:not,premium',
        ],[
            'nominal.required' => 'Nominal harus diisi minimal 30000.',
            'options.in' => 'Harus diisi dengan pengiriman reguler atau premium',
            'options.required' => 'Opsi Pengiriman harus diisi.'
        ]);
        $payout = Payout::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', 'pending']
        ])->count();
        if($payout > 0){
            return redirect()->back()->with('error', 'Masih ada penarikan dana yang pending!');
        } else {
            if(Auth::user()->balance < 30000){
                return redirect()->back()->with('error', 'Minimal saldo pada penarikan dana adalah 30ribu!');
            } else if(Auth::user()->balance > $request->nominal){
                return redirect()->back()->with('error', 'Saldo kamu masih kurang!');    
            } else if(Auth::user()->point < 10 && $request->options == 'premium'){
                return redirect()->back()->with('error', 'Point kamu masih kurang!');     
            } else {
                $user = User::find(Auth::user()->id);
                if($request->options == 'premium'){
                    $user->point -= 10;
                    $user->balance -= $request->nominal;
                    $user->save();
                } else {
                    $user->balance -= $request->nominal;
                    $user->save();
                }
                Payout::create([
                    'jumlah' => $request->nominal,
                    'opsi' => $request->options,
                    'user_id' => Auth::user()->id,
                    'status' => 'pending'
                ]);
                return redirect()->back()->with('success', 'Berhasil melakukan permintaan penarikan dana!');
            }
        }
    }
}
