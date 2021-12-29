<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Convertation,
    User, 
    Image, 
    Status, 
    Message,
    Purchase
};
use Auth;
use Hash;
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
            'image' => 'required|mimes:jpg,png,jpeg|max:3024'
        ],[
            'image.required' => 'Gambar harus diupload.',
            'image.mimes' => 'File harus berupa jpg, png, dan jpeg.',
            'image.max' => 'Maximal ukuran file adalah 3MB.'
        ]);
        $path = Storage::putFile('public/images', $request->file('image'));
        $image = Image::create([
            'name' => 'public'.$path,
            'status_id' => Status::first()->id
        ]);
        Auth::user()->images()->attach($image->id);
        return redirect()->back()->with('success', 'Berhasil menambahkan gambar!');
    }
    public function change_avatar(Request $request)
    {
        $request->validate([
            'profile' => 'required|mimes:jpg,png,jpeg|max:2024'
        ],[
            'profile.required' => 'Silahkan upload gambar terlebih dahulu.'
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $path = Storage::putFile('public/images', $request->file('profile'));
        $image = Image::create([
            'name' => 'public'.$path,
            'status_id' => Status::first()->id
        ]);
        $user->profile_id = $image->id;
        $user->save();
        return redirect()->back()->withSuccess('Berhasil mengganti foto profil!');
    }
    public function change_password(Request $request)
    {
        $request->validate([
            'password' => 'required|max:255',
            'new_password' => 'required|min:6|max:255',
            'c_password' => 'required|min:6|max:255|same:new_password'
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
        $user = User::findOrFail(Auth::user()->id);
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
            $user->save();
            return redirect()->back()->with('success', 'Berhasil merubah pengaturan profil!');
        } else {
            return redirect()->back()->with('error', 'User tidak ditemukan!');
        }
    }
    public function chat()
    {
        $convertations = Convertation::where('from_id', Auth::user()->id)->orWhere('to_id', Auth::user()->id)->orderBy('created_at','DESC')->paginate(5);        
        return view('chat', [
            'convertations' => $convertations
        ]);
    }
    public function pembelian()
    {
        $pembelian = Purchase::where('user_id', Auth::user()->id)->paginate(5);
        return view('pembelian',[
            'pembelian' => $pembelian
        ]);
    }
    public function pengaturan()
    {
        return view('pengaturan');
    }
}
