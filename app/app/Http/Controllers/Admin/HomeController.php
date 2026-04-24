<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (!auth()->user()->is_admin){
            abort(403);
        }

        return view('admin.home');
    }
}
