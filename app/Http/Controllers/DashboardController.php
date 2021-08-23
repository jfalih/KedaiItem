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
            'image' => 'required|mimes:jpg,png,jpeg|max:3024'
        ],[
            'caption.required' => 'Caption harus diisi.',
            'caption.min' => 'Minimal karakter caption harus :min karakter.',
            'image.required' => 'Gambar harus diupload.',
            'image.mimes' => 'File harus berupa jpg, png, dan jpeg.',
            'image.max' => 'Maximal ukuran file adalah 3MB.'
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
    public function change_avatar(Request $request)
    {
        $request->validate([
            'imagepicker' => 'required'
        ],[
            'imagepicker.required' => 'Silahkan pilih gambar terlebih dahulu.'
        ]);
        $user = User::find(Auth::user()->id);
        $user->profile_id = $request->imagepicker;
        $user->save();
        return redirect()->back()->withSuccess('Berhasil mengganti foto profil!');
    }
    public function change_password(Request $request)
    {
        $request->validate([
            'password' => 'required|min:10|max:255',
            'new_password' => 'required|min:10|max:255',
            'c_password' => 'required|min:10|max:255|same:new_password'
        ],[
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Minimal panjang karakter password harus :min karakter.',
            'password.max' => 'Maximal panjang karakter password harus :max karakter.',
            'new_password.required' => 'Password baru harus diisi.',
            'new_password.min' => 'Minimal panjang karakter password harus :min karakter.',
            'new_password.max' => 'Maximal panjang karakter password harus :max karakter.',
            'c_password.required' => 'Konfirmasi password baru harus diisi.',
            'c_password.min' => 'Minimal panjang karakter password harus :min karakter.',
            'c_password.max' => 'Maximal panjang karakter password harus :max karakter.',
            
        ]);
        $user = User::find(Auth::user()->id);
        if(Hash::check($request->password, $user->password)){
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success', 'Berhasil merubah password!');
        } else {
            return redirect()->back()->with('error', 'Gagal merubah password, password lama salah!');    
        }
    }
    public function change_profile(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user){
            $user->name = $request->name;
            $user->username = $request->username;
            $user->save();
            return redirect()->back()->with('success', 'Berhasil merubah pengaturan profil!');
        } else {
            return redirect()->back()->with('error', 'User tidak ditemukan!');
        }
    }
    public function upgrade()
    {
        return view('upgrade');
    }
    public function chat()
    {
        return view('chat');
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
