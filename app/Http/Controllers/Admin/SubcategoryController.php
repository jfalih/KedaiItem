<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\
{
    Subcategory,
    Status
};
use Illuminate\Support\Str;
use DataTables;
class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $subcategory = Subcategory::all();
            return DataTables::of($subcategory)
            ->addIndexColumn()
            ->addColumn('status', function (Subcategory $subcategory) {
                return view('admin.status.default', [
                    'data' => $subcategory
                ]);
            })
            ->addColumn('category', function (Subcategory $subcategory) {
                return view('admin.subcategory.category', [
                    'data' => $subcategory
                ]);
            })
            ->addColumn('action', function (Subcategory $subcategory) {
                return view('admin.subcategory.action', [
                    'data' => $subcategory
                ]);
            })
            ->make(true);
        }
        $statuses = Status::all();
        return view('admin.subcategory', ['statuses' => $statuses]);
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
            'status' => 'required',
            'category' => 'required'
        ],[
            'required' => ':attribute harus diisi.'
        ]);
        $subcategory = Subcategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status_id' => $request->status
        ]);
        $subcategory->categories()->attach($request->category);
        return redirect()->back()->with('success', 'Berhasil menambahkan subcategory!');
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
        $subcategory = Subcategory::findOrFail($id);
        return redirect()->back()->with('subcategory-edit', $subcategory);
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
            'category' => 'required',
            'status' => 'required'
        ]);
        $subcategory = Subcategory::find($id);
        $subcategory->name = $request->name;
        $subcategory->status_id = $request->status;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->save();
        $subcategory->categories()->attach($request->category);
        return redirect()->back()->with('success', 'Berhasil merubah subcategory!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus subcategory!');
    }
}
