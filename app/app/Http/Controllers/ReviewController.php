<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\OrderItem;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        if (!Auth::check()){
            return redirect()-> route('login');
        }

        //購入済みチェック
        $hasPurchased = OrderItem::where('product_id', $productId)
        ->whereHas('order',function ($query){
            $query->where('user_id', Auth::id());
            })->exists();

        if (!$hasPurchased){
            return redirect()->back();
        }

        $request->validate([
            'title' => 'required|max:200',
            'comment' => 'required',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'title' => $request->title,
            'comment' => $request->comment,
        ]);

        return redirect() ->back()->with('success', 'レビュー投稿しました');
    }
}
