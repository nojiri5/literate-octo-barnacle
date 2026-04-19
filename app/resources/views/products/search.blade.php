@extends('layouts.app')

@section('title','商品検索')

@section('content')
    <h2>商品検索結果</h2>

    <form action="{{ route('products.search') }}" method="GET">
        <div>
            <input type="text" name="keyword" value="{{ $keyword ?? '' }}" placeholder="ワード検索">
        </div>

        <div>
            <label>最低金額</label><br>
            <input type="number" name="min" value="{{ $min ?? '' }}" placeholder="例: 1000">
        </div>

        <div>
            <label>最高金額</label><br>
            <input type="number" name="max" value="{{ $max ?? '' }}" placeholder="例: 5000">
        </div>

        <button type="sumbit">検索</button>
    </form>

    @if ($products->isEmpty())
        <p>該当する商品がありません</p>
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