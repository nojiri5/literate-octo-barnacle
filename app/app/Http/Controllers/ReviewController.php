<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\OrderItem;
use Illuminate\Support\Facades\Auth;
use App\Product;

class ReviewController extends Controller
{
    public function create($productId)
    {
        $product = Product::findOrFail($productId);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'レビュー投稿にはログインが必要です');
        }

        $hasPurchased = OrderItem::where('product_id', $productId)
            ->whereHas('order', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->exists();

        if (!$hasPurchased) {
            return redirect()->route('products.show', $productId)
                ->with('error', '購入した商品だけレビューできます');
        }

        return view('reviews.create', compact('product'));
    }


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

        return redirect() ->route('products.show',$productId)->with('success', 'レビュー投稿しました');
    }
}
