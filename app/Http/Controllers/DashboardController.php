<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Image, Status};
use Auth;
use Storage;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addImage(Request $request)
    {
        $request->validate([
            'caption'=> 'required|min:10|max:255',
            'image' => 'required|file|max:3000'
        ]);
        $path = Storage::putFile('public/images', $request->file('image'));
        $image = Image::create([
            'name' => $path,
            'caption' => $request->caption,
            'status_id' => Status::first()->id
        ]);
        Auth::user()->images()->attach($image->id);
        return redirect()->back()->with('success', 'Berhasil menambahkan gambar!');
    }
    public function change_profile(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user){
            $user->name = $request->name;
            $user->username = $request->username;
            $user->save();
            return redirect()->back()->with('success', 'Berhasil merubah');
        } else {
            return redirect()->back()->with('error', 'User tidak ditemukan!');
        }
    }
    public function pembelian()
    {
        return view('pembelian');
    }
    public function pengaturan()
    {
        return view('pengaturan');
    }
    public function galeri()
    {
        return view('galeri');
    }
}
