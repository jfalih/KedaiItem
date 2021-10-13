<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Category,
    Status,
    Image,
    Item
};
use Illuminate\Support\Str;
use Storage;
use Auth;
class ResellerController extends Controller
{
    public function penjualan()
    {
        return view('reseller.penjualan');
    }
    public function new_product()
    {
        $categories = Category::where('status_id', 1)->get();
        return view('reseller.product.add',['categories' => $categories]);
    }
    public function ajax_subcategory($category, Request $request)
    {
        if($request->ajax()){
            $category = Category::where('id', $category)->first();
            $data = $category->subcategories; 
            return response()->json($data, 200);
        }
        return abort(404);
    }
    public function store_product(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'files' => 'required',
            'files.*' => 'required|mimes:jpg,jpeg,png'
        ]);
        $check_slug = Item::where('slug', Str::slug($request->title))->count();
        if($check_slug > 0){
            $number = $check_slug+1;
            $slug = Str::slug($request->title.'-'.$number);
        } else {
            $slug = Str::slug($request->title);
        }
        $item = Item::create([
            'name' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'slug' => $slug,
            'user_id' => Auth::user()->id,
            'status_id' => Status::first()->id
        ]);
        $item_files = [];
        foreach($request->file('files') as $file){
            $path = Storage::putFile('public/reseller/'.Auth::user()->username, $file);
            array_push($item_files,[
                'name' => $path,
                'caption' => 'gambar_item_1',
                'status_id' => Status::first()->id
            ]);
        }
        $item->images()->createMany($item_files);
        return redirect()->back()->with('success', 'Berhasil menambahkan produk!');
    }
    public function product()
    {
        $items = Item::where('user_id', Auth::user()->id)->paginate(5);
        return view('reseller.product', ['items' => $items]);
    }
    public function edit($item){
        $categories = Category::where('status_id', 1)->get();
        $item = Item::where('user_id',Auth::user()->id)->findOrFail($item);
        return view('reseller.product.edit',
        ['item' => $item, 'categories' => $categories]);
    }
}