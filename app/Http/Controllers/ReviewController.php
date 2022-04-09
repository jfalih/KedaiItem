<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\{
    Review,
    Purchase
};
class ReviewController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index($id){
        $purchase = Purchase::findOrFail($id);
        return redirect()->route('pembelian')->with('review', $purchase);
    }
    public function add($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'review' => 'required|min:10|max:255',
            'rating' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $has_review = Review::where([
            ['user_id', '=', Auth::user()->id],
            ['item_id', '=', $id]
        ])->exists();
        if($has_review){
            return back()->with('error', 'Kamu sudah pernah memberikan review!');
        } else {
            $review = Review::create([
                'rating' => $request->rating,
                'comment' => $request->review,
                'user_id' => Auth::user()->id,
                'item_id' => $id
            ]);
            if($review) { 
                return back()->with('success', 'Berhasil menambahkan review!');
            } else {
                return back()->with('error', 'Server error 422!');
            }
        }
    }
}
