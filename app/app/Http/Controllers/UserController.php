<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
{
    $user = Auth::user();
    return view('mypage.show', compact('user'));
}

public function edit()
{
    $user = Auth::user();
    return view('mypage.edit', compact('user'));
}

public function update(Request $request)
{
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email',
        'full_name' => 'required',
        'phone' => 'required',
        'postal_code' => 'required',
        'address' => 'required',
    ]);

    $user = Auth::user();

    $user->name = $request->name;
    $user->email = $request->email;
    $user->full_name = $request->full_name;
    $user->phone = $request->phone;
    $user->postal_code = $request->postal_code;
    $user->address = $request->address;
    $user->save();

    return redirect()->route('mypage')->with('success', '更新しました');
}
}
