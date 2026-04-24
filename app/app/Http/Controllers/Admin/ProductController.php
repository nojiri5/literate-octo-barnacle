<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Supprot\Facades\Storage;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $imagePath=null;

        if ($request->hasFile('image')){
            $imagePath=$request->file('image')->store('products','public');
        }

        Product::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'image' => $imagePath,
            'amount' =>$request->amount,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::findOrFail($id);
        return view('admin.products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if($request->hasFile('image')){

        if ($product->image && Storage::disk('public')->exists($product->image)){
            Storage::disk('public')->delete('$product->image');
        }
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

            $product->name = $request->name;
            $product->amount = $request->amount;
            $product->image = $request->image;
            $product->description = $request->description;

            $product->save();
        

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product= Product::findOrFail($id);

         if ($product->image && Storage::disk('public')->exists($product->image)){
            Storage::disk('public')->delete('$product->image');
        }
        
        $product->delete();

        return redirect()->route('admin.products.index');
    }

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            if (!auth()->user()->is_admin) {
            abort(403);
            }
            return $next($request);
        });
    }

}
