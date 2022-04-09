<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Category,
    Item,
    Subcategory
};
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
class CategoryController extends Controller
{
    public function index(Request $request,$slug){
        $category = Category::where('slug', $slug)->firstOrFail();
        $subcategory = Subcategory::when($request->has('subcategories'), function($q) use($request){
            $q->whereIn('id', $request->subcategories);
        })
        ->whereHas('categories', function($q) use($category){
            $q->where('category_id', $category->id);
        })->get();
        $items = [];
        foreach($subcategory as $subcat){
            $new_item = Item::whereHas('subcategories', function($q) use($subcat){
                $q->where('sub_id', $subcat->id);
            })
            ->when($request->has('sort'), function($q) use ($request){
                if($request->sort == "priceMax"){
                    $q->orderBy('price','DESC');
                } else if($request->sort == "priceMin"){
                    $q->orderBy('price','ASC');
                } else {
                    $q->orderBy('sold','DESC');
                }
            })
            ->when($request->has('priceMax') && $request->has('priceMin'), function($q) use($request){
                $q->where([
                    ['price', '>' ,$request->priceMin],
                    ['price', '<', $request->priceMax]
                ]);
            })->get();
            if($new_item !== null){
                foreach($new_item as $new){
                    $items[] = $new;
                }
            }
        }
        $total = count($items);
        $perPage = $request->has('show') ? $request->show : 12;
        $currentPage = $request->input('page') ?? 1;
        $startingPoint = ($currentPage * $perPage) - $perPage;
        $items = array_slice($items, $startingPoint, $perPage, true);
        $items = new Paginator($items, $total, $perPage, $currentPage,[
            'path' => $request->url(),
            'query' => $request->query()
        ]);
        return view('category', [
            'category' => $category,
            'items' => $items
        ]);
    }
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
