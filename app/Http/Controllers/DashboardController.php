<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Convertation,
    User, 
    Image, 
    Status, 
    Message,
    Payment,
    Purchase,
    Setting
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
        $setting = Setting::first();
        $purchase = Purchase::with('payments')->where('user_id', Auth::user()->id)->get();
        if($request->ajax()){ 
            return DataTables::of($purchase)
            ->addIndexColumn()
            ->addColumn('image', function (Purchase $purchase) {
                return view('components.items.tableImage', [
                    'images' => $purchase->item->images()->first()->name
                ]);
            })
            ->addColumn('name', function (Purchase $purchase) {
                return $purchase->item->name;
            })
            ->addColumn('total', function (Purchase $purchase) use($setting){
                if($purchase->options === 'premium'){
                    return 'Rp'.number_format($purchase->quantity * $purchase->item->price + $setting->harga,0,',','.');
                } else {
                    return 'Rp'.number_format($purchase->quantity * $purchase->item->price,0,',','.');    
                }
            })
            ->addColumn('option', function (Purchase $purchase) {
                return view('pembelian.option', [
                    'data' => $purchase
                ]);
            })
            ->addColumn('status', function (Purchase $purchase) {
                return view('pembelian.status', [
                    'data' => $purchase
                ]);
            })
            ->addColumn('action', function (Purchase $purchase) {
                return view('pembelian.action', [
                    'data' => $purchase
                ]);
            })
            ->make(true);
        }
        return view('pembelian');
    }
    public function pembayaran(Request $request)
    { 
        $pembelian = Payment::where('user_id', Auth::user()->id)->get();
        if($request->ajax()){ 
            return DataTables::of($pembelian)
            ->addIndexColumn()
            ->addColumn('id', function (Payment $pembelian) {
                return 'Payment#'.$pembelian->id;
            })
            ->addColumn('total', function (Payment $pembelian) {
                return 'Rp'.number_format($pembelian->total,0,',','.');
            })
            ->addColumn('status', function (Payment $payment) {
                return view('pembayaran.status', [
                    'data' => $payment
                ]);
            })
            ->addColumn('action', function (Payment $payment) {
                return view('pembayaran.action', [
                    'data' => $payment
                ]);
            })
            ->make(true);
        }
        return view('pembayaran');

    }
    public function pengaturan()
    {
        return view('pengaturan');
    }
    public function verification()
    {
        return redirect()->back()->with('error_verif', 'Silahkan verifikasi email terlebih dahulu');
    }
}
