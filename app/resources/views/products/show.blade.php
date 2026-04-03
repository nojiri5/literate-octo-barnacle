@extends('layouts.app')

@section('title','商品詳細')

@section('content')
    <h2>{{ $product->name }}</h2>
    <p>価格:{{ $product->amount }}</p>
    <p>{{ $product->description }}</p>

    <a href="{{ route('products.index') }}">一覧へ戻る</a>

@endsection