@extends('layouts.app')

@section('title','商品詳細')

@section('content')
    @if ($product=>image)
    <img src="{{ url('storage/' . $product->image) }}" width="300">
    @endif

    <h2>{{ $product->name }}</h2>
    <p>{{ $product->amount }}</p>
    <p>{{ $product->description }}</p>
    <form action="{{ route('cart.add', $product->id) }}" method="POST">
        @csrf
        <button type="sumbit">カートに追加</button>
    </form>
    
    <a href="{{ route('products.index') }}">一覧へ戻る</a>

@endsection