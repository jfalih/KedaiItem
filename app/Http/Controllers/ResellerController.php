<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Category,
    Status,
    Purchase,
    Item
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ResellerController extends Controller
{
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
        $request->validate([
            'category' => 'required',
            'subcategory' => 'required',
            'title' => 'required',
            'price' => 'required',
            'stok' => 'required|min:1',
            'min' => 'required|min:1',
            'description' => 'required',
            'files' => 'required',
            'files.*' => 'required|mimes:jpg,jpeg,png'
        ]);
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
        foreach ($request->file('files') as $file) {
            $path = Storage::putFile('public/reseller/' . Auth::user()->username, $file);
            array_push($item_files, [
                'name' => 'public'.$path,
                'status_id' => Status::first()->id
            ]);
        }
        $item->subcategories()->attach($request->subcategory);
        $item->images()->createMany($item_files);
        return redirect()->back()->with('success', 'Berhasil menambahkan produk!');
    }
    public function update($id, Request $request)
    {
        $request->validate([
            'category' => 'required',
            'subcategory' => 'required',
            'title' => 'required',
            'price' => 'required',
            'stok' => 'required|min:1',
            'min' => 'required|min:1',
            'description' => 'required',
            'files.*' => 'required|mimes:jpg,jpeg,png'
        ],[
            'required' => ':attribute harus diisi.'
        ]);
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
        $item_files = [];
        if($request->file('files')){
            foreach ($request->file('files') as $file) {
                $path = Storage::putFile('public/reseller/' . Auth::user()->username, $file);
                array_push($item_files, [
                    'name' => 'public'.$path,
                    'status_id' => Status::first()->id
                ]);
            }
            $item->images()->detach();
            $item->images()->createMany($item_files);
        }
        return redirect()->back()->with('success', 'Berhasil mengedit produk!');
    }
    public function product(Request $request)
    {
        $categories = Category::where('status_id', 1)->get();
        $items = Item::where('user_id', Auth::user()->id)->when($request->nama_barang !== null, function($q) use($request){
            $q->where('name', 'like',"%{$request->nama_barang}%");
        })->when($request->stok !== null, function($q) use($request){
            $q->where('stok', $request->stok);
        })->when($request->min !== null, function($q) use($request){
            $q->where('min', $request->min);    
        })->paginate(5);
        return view('reseller.product', [
            'items' => $items,
            'categories' => $categories
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
