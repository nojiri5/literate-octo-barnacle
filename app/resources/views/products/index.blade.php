@extends('layouts.app')

@section('title','商品一覧')

@section('content')
    <h2>商品一覧</h2>

    <form action="{{ route('products.search') }}" method="GET">
        <input type="text" name="keyword" placeholder="ワード検索">

        <button type="sumbit">検索</button>
    </form>

    @if ($products->isEmpty())
        <p>商品がありません</p>
    @else
    @foreach ($products as $product)
        <div style="border:1px solid #ccc; padding:12px; margin-bottom:12px;">
            <p><img src="{{ url('storage/' , $product->image) }}" width="150"></P>
            <h3><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></h3>
            <p>価格: {{ $product->amount }}</p>
            <p>{{ $product->description }}</p>
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="sumbit">カートに追加</button>
            </form>
        </div>    
    @endforeach
    @endif
            
@endsection