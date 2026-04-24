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


    $request->validate([
        'full_name' => 'required',
        'phone' => 'required',
        'postal_code' => 'required',
        'address' => 'required',
    ], [
        'full_name.required' => '氏名は必須です',
        'phone.required' => '電話番号は必須です',
        'postal_code.required' => '郵便番号は必須です',
        'address.required' => '住所は必須です',
    ]);

    $user = Auth::user();

   
    $user->update([
        'full_name' => $request->full_name,
        'phone' => $request->phone,
        'postal_code' => $request->postal_code,
        'address' => $request->address,
    ]);


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
