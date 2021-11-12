<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Facades Init
use Illuminate\Support\Facades\Storage;

// Model Init
use App\Models\{
    Setting,
    Image
};

class PengaturanWebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        return view('admin.pengaturan',['setting' => $setting]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'title' => 'required'
        ], [
            'required' => ':attribute harus diisi.'
        ]);
        $setting = Setting::first();
        $setting->name = $request->name;
        $setting->title = $request->title;
        $setting->description = $request->description;
        if($request->file('files')){
            Image::destroy($setting->logo_id);
            $path = Storage::putFile('public/website/', $request->file('files'));
            $setting->logo()->create([
                'caption' => 'logo website '.$request->name,
                'name' => $path,
                'status_id' => 1
            ]);
        }
        $setting->save();
        return redirect()->back()->with('success', 'Berhasil mengubah pengaturan website!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
