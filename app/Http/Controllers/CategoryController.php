<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Category,
    Item,
    Subcategory
};

class CategoryController extends Controller
{
    public function subcategories($category){
        $category = Category::findOrFail($category);
        return response()->json($category->subcategories, 200);
    }

    public function indexSubcategory($cat, $subcat){
        $category = Category::where('slug', $cat)->whereHas('subcategories', function($q) use ($subcat) {
            return $q->where('slug', $subcat);
        })->firstOrFail();
        $categories = Category::where('status_id', 1)->get();
        $subcategory = Subcategory::where('slug', $subcat)->first();
        return view('subcategories', [
            'categories' => $categories,
            'category' => $category,
            'subcategory' => $subcategory,
            'items' => $subcategory->items()->paginate(12)
        ]);
    }
}
