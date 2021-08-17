<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Validator;
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
       $validated = $request->validate([
            'name' => 'required|min:10|max:255',
            'nomorhp' => 'required|numeric|unique:users',
            'email' => 'unique:users|required|email',
            'password' => 'min:10|max:255',
            'c_password' => 'same:password'
        ]);
        if($validated){
        return dd($validated);
        } else {
            return dd($request->all());
        }
    }
    public function register()
    {
        return view('auth.register');
    }
}
