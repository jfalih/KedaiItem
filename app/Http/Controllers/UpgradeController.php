<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Image, User, Status, Upgrade};
use Auth;
use Storage;

class UpgradeController extends Controller
{
    public function index()
    {
        $upgrade = Upgrade::where('user_id', Auth::user()->id)->first();
        return view('upgrade',[
            'upgrade' => $upgrade
        ]);
    }
    public function upgrade(Request $request)
    {
        $request->validate([
            'ktp' => 'required|mimes:jpg,png,jpeg|max:3024',
            'tabungan' => 'required|mimes:jpg,png,jpeg|max:3024',
            'selfie' => 'required|mimes:jpg,png,jpeg|max:3024',            
            'nama_toko' => 'required|alpha_dash|min:3',
            'atas_nama' => 'required',
            'nomor_rekening' => 'required',
        ],[
            'required' => ':attribute harus diisi.',
            'ktp.required' => 'Ktp harus diupload.',
            'ktp.mimes' => 'File harus berupa jpg, png, dan jpeg.',
            'ktp.max' => 'Maximal ukuran file adalah 3MB.',
            'tabungan.required' => 'Tabungan harus diupload.',
            'tabungan.mimes' => 'File harus berupa jpg, png, dan jpeg.',
            'tabungan.max' => 'Maximal ukuran file adalah 3MB.',
            'selfie.required' => 'Selfie harus diupload.',
            'selfie.mimes' => 'File harus berupa jpg, png, dan jpeg.',
            'selfie.max' => 'Maximal ukuran file adalah 3MB.'
        ]);
        $check_up = Upgrade::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', 'pending']
        ])->first();
        if($check_up){
            return redirect()->back()->withErrors('Sudah dalam proses verifikasi..');
        }
        $req_tabungan = Storage::putFile('public/verification', $request->file('tabungan'));
        $tabungan = Image::create([
            'name' => $req_tabungan,
            'caption' => 'Verifikasi Buku Tabungan '.Auth::user()->name,
            'status_id' => Status::first()->id
        ]);
        $req_ktp = Storage::putFile('public/verification', $request->file('ktp'));
        $ktp = Image::create([
            'name' => $req_ktp,
            'caption' => 'Verifikasi Ktp '.Auth::user()->name,
            'status_id' => Status::first()->id
        ]);
        $req_selfie = Storage::putFile('public/verification', $request->file('selfie'));
        $selfie = Image::create([
            'name' => $req_selfie,
            'caption' => 'Verifikasi Ktp + Selfie '.Auth::user()->name,
            'status_id' => Status::first()->id
        ]);
        $user = User::findOrFail(Auth::user()->id);
        Upgrade::create([
            'user_id' => $user->id,
            'status' => 'pending'
        ]);
        $user->tabungan_id = $tabungan->id;
        $user->ktp_id = $ktp->id;
        $user->selfie_id = $selfie->id;
        $user->nomor_rekening = $request->nomor_rekening;
        $user->atas_nama = $request->atas_nama;
        $user->username = $request->nama_toko;
        $user->save();
        return redirect()->back()->withSuccess('Berhasil meminta verifikasi..');
    }
}
