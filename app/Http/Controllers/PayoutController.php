<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payout;
use Auth;

class PayoutController extends Controller
{
    public function index()
    {
        $payouts = Payout::where('user_id', Auth::user()->id)->paginate(5);
        return view('payout', [
            'payouts' => $payouts
        ]);
    }

    public function create()
    {
        $payout = Payout::where([
            ['user_id', '=',Auth::user()->id],
            ['status', '='. 'pending']
        ])->first();
        if($payout){
            return redirect()->back()->with('error', 'Masih ada penarikan dana yang pending!');
        } else {
            if(Auth::user()->balance < 30000){
                return redirect()->back()->with('error', 'Minimal saldo pada penarikan dana adalah 30ribu!');
            } else {
                Payout::create([
                    'user_id' => Auth::user()->id,
                    'status' => 'pending'
                ]);
                return redirect()->back()->with('success', 'Berhasil melakukan permintaan penarikan dana!');
            }
        }
    }
}
