<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())
            ->with('product')
            ->get();

        return view('favorites.index', compact('favorites'));
    }

    public function store($productId)
    {
        Favorite::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $productId,
        ]);

        return redirect()->back()->with('success', 'お気に入りに追加しました');
    }

    public function destroy($productId)
    {
        Favorite::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->delete();

        return redirect()->back()->with('success', 'お気に入りを解除しました');
    }
}
