@extends('layouts.app')

@section('title','商品詳細')

@section('content')
    @if ($product->image)
    <img src="{{ url('storage/' . $product->image) }}" width="300">
    @endif

    <h2>{{ $product->name }}</h2>
    <p>{{ $product->amount }}</p>
    <p>{{ $product->description }}</p>
    <form action="{{ route('cart.add', $product->id) }}" method="POST">
        @csrf
        <button type="sumbit">カートに追加</button>
    </form>
    <form action="{{ route('favorites.store', $product->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-outline-danger">
        お気に入り
    </button>
</form>

    <hr>

    <h2>レビュー</h2>

    @if ($product->reviews && $product->reviews->count())
        @foreach ($product->reviews as $review)
            <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
                <h4>{{ $review->title }}</h4>
                <p>{{ $review->comment }}</p>
            </div>
        @endforeach
    @else
        <p>まだレビューはありません。</p>
    @endif

    <a href="{{ route('reviews.create', $product->id) }}">レビュー投稿へ</a>
    
    <br>
    <a href="{{ route('products.index') }}">一覧へ戻る</a>

@endsection