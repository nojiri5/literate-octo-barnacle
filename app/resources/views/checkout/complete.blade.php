@extends('layouts.app')

@section('content')
    <h2>購入完了</h2>
    <p>ご購入ありがとうございました。</p>

    <a href="{{ route('products.index') }}">商品一覧へ戻る</a>
    
@endsection