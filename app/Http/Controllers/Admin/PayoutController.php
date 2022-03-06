<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payout;
use DataTables;
class PayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payout = Payout::all();
        if($request->ajax()){
            return DataTables::of($payout)
            ->addIndexColumn()
            ->addColumn('user', function(Payout $payout){
                return $payout->user->name;
            })
            ->addColumn('jumlah', function(Payout $payout){
                return 'Rp'.number_format($payout->jumlah,0,',','.');
            })
            ->addColumn('pengiriman', function (Payout $payout) {
                return view('admin.payout.option', [
                    'data' => $payout->opsi
                ]);
            })
            ->addColumn('status', function (Payout $payout) {
                return view('admin.payout.status', [
                    'data' => $payout->status
                ]);
            })
            ->addColumn('action', function (Payout $payout) {
                return view('admin.payout.action', [
                    'data' => $payout
                ]);
            })
            ->make(true);
        }
        return view('admin.payout', [
            'payout' => $payout
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function success($id)
    {
        $payout = Payout::findOrFail($id);
        $payout->status = 'success';
        $payout->save();
        return redirect()->back()->with('success', 'Berhasil merubah payout pada user '.$payout->user->name.' Jumlah Rp'.number_format($payout->jumlah,0,',','.').' !');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function canceled($id)
    {
        $payout = Payout::findOrFail($id);
        $payout->status = 'failed';
        $payout->save();
        return redirect()->back()->with('error', 'Berhasil merubah payout pada user '.$payout->user->name.' Jumlah Rp'.number_format($payout->jumlah,0,',','.').' !');
    }
}
