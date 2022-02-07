<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){
        $keyword = $request->keyword;
        $category = $request->categories;
        if($request->has('category')){
            $items = Item::whereHas('subcategories.categories', function(Builder $q) use($category){
                $q->whereIn('categories.id', $category);
            })->where('name','like',"%".$keyword."%")->paginate(12);
        } else {
            $items = Item::where('name','like',"%".$keyword."%")->paginate(12);
        }
        $categories = Category::where('status_id', 1)->get();
        $subcategories = Subcategory::where('status_id', 1)->get();
        return view('search',[
            'items' => $items,
            'max_price' => $items->max('price'),
            'min_price' => $items->min('price'),
            'keyword' => $keyword,
            'category' => $category ? $category : [] ,
            'categories' => $categories,
            'subcategories' => $subcategories
        ]);
    }
}
