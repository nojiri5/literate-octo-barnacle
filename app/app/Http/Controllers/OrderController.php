<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function history()
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }

        $orders = Order::with('items')
        ->where('user_id',Auth::id())
        ->latest()
        ->get();

        return view('orders.history', compact('orders'));
    }
}
