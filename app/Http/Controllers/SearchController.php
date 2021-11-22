<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index($keyword){
        $items = Item::where('name','like',"%".$keyword."%")->paginate(12);
        $categories = Category::where('status_id', 1)->get();
        return view('search',[
            'items' => $items,
            'keyword' => $keyword,
            'categories' => $categories
        ]);
    }
}
