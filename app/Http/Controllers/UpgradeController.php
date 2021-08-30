<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Image, User, Status};
use Auth;
use Storage;

class UpgradeController extends Controller
{
    public function index()
    {
        return view('upgrade');
    }
    public function tabungan(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,png,jpeg|max:3024',
        ],[
            'image.required' => 'Gambar harus diupload.',
            'image.mimes' => 'File harus berupa jpg, png, dan jpeg.',
            'image.max' => 'Maximal ukuran file adalah 3MB.'
        ]);
        $path = Storage::putFile('public/verification', $request->file('image'));
        $image = Image::create([
            'name' => $path,
            'caption' => 'Verifikasi Buku Tabungan '.Auth::user()->name,
            'status_id' => Status::first()->id
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $user->tabungan_id = $image->id;
        $user->save();
        return redirect()->back()->with('success','Berhasil mengirim permintaan verifikasi!');
    }
    public function ktp(Request $request)
    {
        $request->validate([
            'imagektp' => 'required|mimes:jpg,png,jpeg|max:3024',
            'imageselfie' => 'required|mimes:jpg,png,jpeg|max:3024'
        ],[
            'imagektp.required' => 'Gambar harus diupload.',
            'imagektp.mimes' => 'File harus berupa jpg, png, dan jpeg.',
            'imagektp.max' => 'Maximal ukuran file adalah 3MB.',
            'imageselfie.required' => 'Gambar harus diupload.',
            'imageselfie.mimes' => 'File harus berupa jpg, png, dan jpeg.',
            'imageselfie.max' => 'Maximal ukuran file adalah 3MB.'
        ]);
        $pathktp = Storage::putFile('public/verification', $request->file('imagektp'));
        $pathselfie = Storage::putFile('public/verification', $request->file('imageselfie'));
        $image_ktp = Image::create([
            'name' => $pathktp,
            'caption' => 'Verifikasi Ktp '.Auth::user()->name,
            'status_id' => Status::first()->id
        ]);
        $image_selfie = Image::create([
            'name' => $pathselfie,
            'caption' => 'Verifikasi Ktp + Selfie '.Auth::user()->name,
            'status_id' => Status::first()->id
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $user->ktp_id = $image_ktp->id;
        $user->selfie_id = $image_selfie->id;
        $user->save();
        return redirect()->back()->with('success','Berhasil mengirim permintaan verifikasi!');
    }
}
