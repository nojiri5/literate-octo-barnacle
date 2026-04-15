@extends('layouts.app')

@section('content')

<h2>購入内容確認</h2>

@if (empty($cart))
<p>カートは空です</p>
@else

    @foreach($cart as $item)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <h3>{{ $item['name'] }}</h3>

        @if ($item['image'])
        <img src="{{  url('storage/' .$item['image']) }}" width="150">
        @endif

        <p>価格: {{ $item['amount'] }}</p>
        <p>数量: {{ $item['quantity'] }}</p>
        <p>小計: {{ $item['amount'] * $item['quantity'] }}</p>
    </div>
    @endforeach
    <h3>合計金額: {{ $total }}</h3>

    <form action="{{ route('checkout.complete') }}" method="POST">
        @csrf
        <button type="sumbit">購入する</button>
    </form>

    <a href ="{{ route('cart.index') }}">カートに戻る</a>
    @endif

@endsection