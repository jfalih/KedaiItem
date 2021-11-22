<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Purchase,
    User,
    Item
};
class DashboardController extends Controller
{
    public function index()
    {
        $reseller = User::whereHas('roles', function($q){
            $q->where('name', 'reseller');
        })->get(); 
        $ten_item = Item::limit(10)->Orderby('sold','desc')->get();       
        $purchases = Purchase::limit(5)->Orderby('created_at','desc')->get();
        return view('admin.dashboard',[
            'resellers' => $reseller,
            'purchases' => $purchases,
            'ten_item' => $ten_item
        ]);
    }
}
