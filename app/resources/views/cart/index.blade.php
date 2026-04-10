@extends('layouts.app')

@section('title','カート')

@section('content')
    <h2>カート画面</h2>

    @if (session('success'))
        <p style ="color: green;">{{ session('success') }}</p>
    @endif
    
    @if(empty($cart))
        <p>カートは空です</p>
    @else
    @php 
        $total = 0;
    @endphp

    @foreach($cart as $item)
    @php 
        $subtotal = $item['amount'] * $item['quantity'];
        $total += $subtotal;
    @endphp

    <div style="border:1px solid #ccc; padding:12px; margin-bottom:12px;">
        <h3>{{ $item['name'] }}</h3>

        @if ($item['image'])
            <img src="{{ url('storage/' . $item['image']) }}" width="150">
        @endif

        <P>{{ $item['amount'] }}</p>
        <p>数量:{{ $item['quantity'] }}</p>
        <p>小計:{{ $subtotal }}</p>

        <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
            @csrf 
            <button type="submit">削除</button>
        </form>
    </div>
    @endforeach

    <h3>合計金額: {{$total}}</h3>
    @endif

    <a href="{{ route('products.index') }}">一覧へ戻る</a>

@endsection