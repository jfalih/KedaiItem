<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Feature,
    Status,
    Image
};
use Storage;
use DataTables;
use Features;

class FeaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            $feature = Feature::all();
            return DataTables::of($feature)
            ->addColumn('action', function (Feature $feature) {
                return view('admin.feature.action', [
                    'data' => $feature
                ]);
            })
            ->addColumn('created_at', function (Feature $feature) {
                return $feature->created_at;
            })
            ->addIndexColumn()
            ->make(true);
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
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:3024'
        ],[
            'required' => ':attribute harus diisi.',
            'image.required' => 'Gambar harus diupload.',
            'image.mimes' => 'File harus berupa jpg, png, dan jpeg.',
            'image.max' => 'Maximal ukuran file adalah 3MB.'
        ]);
        $path = Storage::putFile('public/website', $request->file('image'));
        $img = Image::create([
            'name' => $path,
            'caption' => 'Features-'.rand(0,1000),
            'status_id' => Status::first()->id
        ]);
        $feature = Feature::create([
            'title' => $request->title,
            'description' => $request->description,
            'img_id' => $img->id
        ]);
        return redirect()->back()->with('success', 'Berhasil menambahkan features!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feature = Feature::findOrFail($id);
        return redirect()->back()->with('feature-edit', $feature);
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
        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);
        
        $feature = Feature::find($id);
        $feature->title = $request->title;
        $feature->description = $request->description;
        Image::destroy($feature->logo_id);
        $path = Storage::putFile('public/website', $request->file('image'));
        $img = Image::create([
            'name' => $path,
            'caption' => 'Features-'.rand(0,1000),
            'status_id' => Status::first()->id
        ]);
        $feature->img_id = $img->id;
        $feature->save();
        return redirect()->back()->with('success', 'Berhasil merubah category!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feature = Feature::findOrFail($id);
        $feature->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus feature!');
    }
}
