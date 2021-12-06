<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Category,
    Item,
    Setting,
    Feature
};
class WelcomeController extends Controller
{
    public function index()
    {
        $items = Item::inRandomOrder()->limit(5)->get();
        $features = Feature::limit(4)->get();
        $new_item = Item::orderBy('created_at', 'ASC')->limit(8)->get();
        $recomended_categories = Category::limit(4)->get();       
        $setting = Setting::first();
        return view('welcome', [
            'items' => $items,
            'newitem' => $new_item,
            'setting' => $setting,
            'features' => $features,
            'recomended_categories' => $recomended_categories
        ]);
    }
    public function search(Request $request){
        return redirect('/search/'.$request->search);
    }
}
