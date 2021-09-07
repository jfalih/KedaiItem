<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use App\Models\{
    Category,
    Status
};
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $category = Category::all();
            return DataTables::of($category)
            ->addIndexColumn()
            ->addColumn('action', function (Category $category) {
                return view('admin.category.action', [
                    'data' => $category
                ]);
            })
            ->make(true);
        }
        $statuses = Status::all();
        return view('admin.category', ['statuses' => $statuses]);
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
            'status' => 'required'
        ], [
            'required' => ':attribute harus diisi.'
        ]);
        Category::create([
            'name' => $request->name,
            'status_id' => $request->status,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->back()->with('success', 'Berhasil menambahkan category!');
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
        $category = Category::findOrFail($id);
        return redirect()->back()->with('category-edit', $category);
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
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus category!');
    }
}
