<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart',[]);
        return view('cart.index', compact('cart'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart',[]);
        
        if (isset($cart[$id])){
            $cart[$id][quantity]++;
        }else{
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'amount' => $product->amount,
                'image' => $product->image,
                'quantity' =>1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success','カートに追加しました');
    }
    
    public function remove($id)
    {
        $cart = session()->get('cart',[]);

        if (isset($cart[$id])){
            unset($cart[$id]);
            session()->put('cart',$cart);
        }
        return redirect()->route('cart.index');
    }
}
