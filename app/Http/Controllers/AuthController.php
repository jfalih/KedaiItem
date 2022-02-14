<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Rules\AlphaSpace;
use App\Models\{User, Role, Status};
use Illuminate\Support\Facades\Validator;
use Hash;
use Auth;
class AuthController extends Controller
{
    
    public function __construct(){
        $this->middleware('guest');
    }
    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();
            return redirect()->route('welcome');
        }
        return back()->with('error_login', 'Email atau password salah!');
    }
    public function login()
    {
        return view('auth.login');
    }
    public function registerUser(Request $request)
    {
       $validator = Validator::make($request->all(),[
            'name' => ['required','max:255', new AlphaSpace],
            'nomorhp' => ['required','numeric','unique:users'],
            'email' => ['unique:users','required','email'],
            'password' => ['required','min:6','max:255'],
            'c_password' => ['required','same:password']
        ], [
            'required' => 'Silahkan isi :attribute masih kosong.',
            'min' => 'Minimal jumlah karakter pada :attribute adalah :min',
            'max' => 'Maximal jumlah karakter pada :attribute adalah :max',
            'unique' => ':attribute sudah digunakan.',
            'same' => ':attribute tidak sama dengan :same'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $role = Role::where('name', 'member')->first();
        $user = User::create([
            'name' => $request->name,
            'nomorhp' => $request->nomorhp,
            'email' => $request->email,
            'status_id' => Status::first()->id,
            'password' => Hash::make($request->password)
        ]);
        $user->roles()->attach([$role->id]);
        event(new Registered($user));
        Auth::loginUsingId($user->id);
        return redirect()->route('pengaturan')->with('success','Berhasil mendaftar, silahkan verifikasi alamat email!');
       
    }
    public function register()
    {
        return view('auth.register');
    }
}
