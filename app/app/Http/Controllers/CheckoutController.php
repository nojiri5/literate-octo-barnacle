<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()-> get('cart',[]);

        if (empty($cart)) {
            return redirect()-> route('cart.index')->with('success','カートが空です');
        }

        $total= 0;

        foreach ($cart as $item){
            $total += $item['amount'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    public function complete (Request $request)
    {
    $cart = session()-> get('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart.index')->with('success', 'カートが空です');
    }

    if (!Auth::check()){
        return redirect()->route('login')->with('success','購入にはログインが必要です');
    }

    $total = 0;

    foreach ($cart as $item){
        $total += $item['amount'] * $item['quantity'];
    }

    $order = Order::create([
        'user_id'=> Auth::id(),
        'total'=> $total,
    ]);

    foreach($cart as $item){
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' =>$item['id'],
            'product_name' =>$item['name'],
            'product_image' =>$item['image'],
            'amount' => $item['amount'],
            'quantity' => $item['quantity'],
        ]);
    }

    session()->forget('cart');

    return view('checkout.complete');
    }
}
