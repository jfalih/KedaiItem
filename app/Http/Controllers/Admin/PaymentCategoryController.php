<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Paymentcategory as Payment,
    Status,
    Image
};
use DataTables;
use Illuminate\Support\Facades\Storage;
class PaymentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $category = Payment::all();
            return DataTables::of($category)
            ->addIndexColumn()
            ->addColumn('image', function (Payment $category) {
                return view('admin.image.default', [
                    'data' => $category
                ]);
            })
            ->addColumn('status', function (Payment $category) {
                return view('admin.status.default', [
                    'data' => $category
                ]);
            })
            ->addColumn('action', function (Payment $category) {
                return view('admin.paymentcategory.action', [
                    'data' => $category
                ]);
            })
            ->make(true);
        }
        $statuses = Status::all();
        return view('admin.paymentcategory', ['statuses' => $statuses]);
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
            'fee_admin' => 'required|integer',
            'code' => 'required|alpha_dash',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required'
        ],[
            'required' => ':attribute harus diisi.'
        ]);
        $path = Storage::putFile('public/website/', $request->file('image'));
        $image = Image::create([
            'name' => $path,
            'status_id' => 1
        ]);
        Payment::create([
            'name' => $request->name,
            'status_id' => $request->status,
            'code' => $request->code,
            'fee_admin' => $request->fee_admin,
            'img_id' => $image->id
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
        $category = Payment::findOrFail($id);
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
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'fee_admin' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required'
        ],[
            'required' => ':attribute harus diisi.'
        ]);
        $category = Payment::find($id);
        $category->fee_admin = $request->fee_admin;
        $category->name = $request->name;
        $category->status_id = $request->status;
        $category->code = $request->code;
        Image::destroy($setting->logo_id);
        $path = Storage::putFile('public/website/', $request->file('image'));
        $image =  Image::create([
            'name' => $path,
            'status_id' => 1
        ]);
        $category->img_id = $image->id;
        $category->save();
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
        $category = Payment::find($id);
        $category->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus category!');
    }
}
