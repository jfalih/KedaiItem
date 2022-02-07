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
use Illuminate\Support\Facades\Validator;

use DataTables;
use Auth;
use Hash;
use Storage;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('dashboard');
    }
    public function indexChangePassword()
    {
        return view('change_password');
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
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpg,png,jpeg|max:3024',
        ]);
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'path' => null,
                'message' => 'Gagal mengganti foto profile!'
            ]);
        }
        $user = User::findOrFail(Auth::user()->id);
        $image = $request->file('file');
        $path = Storage::putFile('public/images', $image);
        $image = Image::create([
            'name' => $path,
            'status_id' => Status::first()->id
        ]);
        $user->profile_id = $image->id;
        $user->save();
        return response()->json([
            'success' => true,
            'path' => $path,
            'message' => 'Berhasil mengganti foto profile!'
        ]);
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
            'c_password.same' => 'Konfirmasi password tidak sama dengan password baru.',
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
    public function pembelian(Request $request)
    { 
        if($request->ajax()){ 
            $pembelian = Purchase::where('user_id', Auth::user()->id)->get();
            return DataTables::of($pembelian)
            ->addIndexColumn()
            ->addColumn('item', function (Purchase $pembelian) {
                return $pembelian->item->name;
            })
            ->addColumn('harga', function (Purchase $pembelian) {
                return $pembelian->item->price;
            })
            ->addColumn('total', function (Purchase $pembelian) {
                return $pembelian->item->price*$pembelian->quantity;
            })
            ->addColumn('aksi', function (Purchase $pembelian) {
                return 'belum';
            })
            ->make(true);
        }
        return view('pembelian');
    }
    public function pengaturan()
    {
        return view('pengaturan');
    }
}
