<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories');
    }
    public function subcategories($category){
        $category = Category::findOrFail($category);
        return response()->json($category->subcategories, 200);
    }
}
