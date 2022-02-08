<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Category,
    Status,
    Purchase,
    Item,
    Subcategory
};
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ResellerController extends Controller
{
    public function index()
    {
        return view('reseller.dashboard');
    }
    public function penjualan()
    {
        $penjualans = Purchase::where('status','!=','pending')->whereHas('item', function($q){
          $q->where('user_id', Auth::user()->id);
        })->paginate();
        return view('reseller.penjualan',[
            'penjualans' => $penjualans
        ]);
    }
    public function new_product()
    {
        $categories = Category::where('status_id', 1)->get();
        return view('reseller.product.add', ['categories' => $categories]);
    }
    public function ajax_subcategory($category, Request $request)
    {
        if ($request->ajax()) {
            $category = Category::where('id', $category)->first();
            $data = $category->subcategories;
            return response()->json($data, 200);
        }
        return abort(404);
    }
    public function store_product(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'subcategory' => 'required',
            'title' => 'required',
            'price' => 'required',
            'stok' => 'required|min:1',
            'min' => 'required|min:1',
            'description' => 'required',
            'file' => 'required',
            'file.*' => 'required|mimes:jpg,jpeg,png'
        ]);
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Masih ada form yang kosong!'
            ]);
        }
        $check_slug = Item::where('slug', Str::slug($request->title))->count();
        if ($check_slug > 0) {
            $number = $check_slug + 1;
            $slug = Str::slug($request->title . '-' . $number);
        } else {
            $slug = Str::slug($request->title);
        }
        $item = Item::create([
            'name' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'slug' => $slug,
            'min' => $request->min,
            'stok' => $request->stok,
            'user_id' => Auth::user()->id,
            'status_id' => Status::first()->id
        ]);
        $item_files = [];
        foreach ($request->file('file') as $file) {
            $path = Storage::putFile('public/reseller/' . Auth::user()->username, $file);
            array_push($item_files, [
                'name' => $path,
                'status_id' => Status::first()->id
            ]);
        }
        $item->subcategories()->attach($request->subcategory);
        $item->images()->createMany($item_files);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan produk!'
        ]);
    }
    public function updateImage($id, Request $request){
        $validator = Validator::make($request->all(), [
            'file' => 'required',
            'file.*' => 'mimes:jpg,jpeg,png'
        ]);
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Masih ada form yang kosong!'
            ]);
        }
        $item = Item::where('user_id', Auth::user()->id)->find($id);
        $item_files = [];
        if($request->file('file')){
            foreach ($request->file('file') as $file) {
                $path = Storage::putFile('public/reseller/' . Auth::user()->username, $file);
                array_push($item_files, [
                    'name' => $path,
                    'status_id' => Status::first()->id
                ]);
            }
            $item->images()->detach();
            $item->images()->createMany($item_files);
        }
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengedit gambar produk!'
        ]);
    }
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'subcategory' => 'required',
            'title' => 'required',
            'price' => 'required',
            'stok' => 'required|min:1',
            'min' => 'required|min:1',
            'description' => 'required',
        ]);
        $check_category = Category::find($request->category);
        $check_subcategory = Subcategory::find($request->subcategory);
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Masih ada form yang kosong!'
            ]);
        } else if(!$check_category && !$check_subcategory){
            return response()->json([
                'success' => false,
                'message' => 'Kategori atau subcategory tidak ditemukan!'
            ]);
        }
        $check_slug = Item::where('slug', Str::slug($request->title))->count();
        if ($check_slug > 0) {
            $number = $check_slug + 1;
            $slug = Str::slug($request->title . '-' . $number);
        } else {
            $slug = Str::slug($request->title);
        }
        $item = Item::where('user_id', Auth::user()->id)->find($id);
        $item->update([
            'name' => $request->title,
            'stok' => $request->stok,
            'min' => $request->min,
            'description' => $request->description,
            'price' => $request->price,
            'slug' => $slug,
        ]);
        $item->subcategories()->detach();
        $item->subcategories()->attach([$request->subcategory]);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengubah product!'
        ]);
    }
    public function product(Request $request)
    { 
        $products = Item::where('user_id', Auth::user()->id)->get();
        if($request->ajax()){ 
            return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('status', function (Item $products) {
                return view('reseller.product.status', [
                    'status' => $products->status->name
                ]);
            })
            ->addColumn('stok', function (Item $products) {
                return view('reseller.product.stok', [
                    'stok' => $products->stok
                ]);
            })
            ->addColumn('action', function (Item $products) {
                return view('reseller.product.action', [
                    'action' => $products
                ]);
            })
            ->rawColumns(['status','stok'])
            ->make(true);
        }
        return view('reseller.product', [
            'products' => $products
        ]);
    }
    public function edit($item)
    {
        $categories = Category::where('status_id', 1)->get();
        $item = Item::where('user_id', Auth::user()->id)->findOrFail($item);
        return view(
            'reseller.product.edit',
            ['item' => $item, 'categories' => $categories]
        );
    }
    public function destroy($item){
        $item = Item::where('user_id', Auth::user()->id)->findOrFail($item);
        $item->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus produk');
    }
}
