@extends('layouts.app')

@section('title', '商品リスト')
@section('content')
    <h2>商品リスト</h2>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif


@if($products->isEmpty())
    <p>商品がありません</p>
@else
    @foreach($products as $product)
        <div style="border:1px solid #ccc; padding:12px; margin-bottom:12px;">
        <p><img src="{{ url('storage/' , $product->image) }}" width="150"></P>
        <h3>{{ $product->name }}</h3>
        <p>{{ $product->amount }}</p>
        <p>{{ $product->description }}</p>


        <a href="{{ route('admin.products.edit', $product->id) }}">編集</a>

        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="margin-top:10px;">
            @csrf
            <button type="submit" onclick="return confirm('削除しますか？')">削除</button>
        </form>
        </div>
    @endforeach
@endif    

    <a href="{{ route('admin.products.create') }}">商品登録</a>

    <a href="{{ route('admin.dashboard') }}">戻る</a>

@endsection