@extends('layouts.app')

@section('content')
    <h2>購入履歴</h2>

    @if ($orders->isEmpty())
    <p>購入履歴はありません</p>
    @else
        @foreach ($orders as $order)
        <div style="border:2px solid #999; padding:10px; margin-bottom:20px;">
            <p>購入日時: {{ $order-> created_at }}</p>
            <p>合計金額: {{ $order-> total }}</p>

            @foreach($order->items as $item)
            <div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
                <h3>{{ $item->product_name }}</h3>

                @if ($item->product_image)
                <img src="{{ url('storage/' . $item->product_image) }}" width="120">
                @endif

                <p>金額: {{ $item->price }}</p>
                <p>数量: {{ $item->quantity }}</p>
            </div>
            @endforeach
        </div>
        @endforeach
    @endif

    <a href="{{ route('products.index') }}">一覧へ戻る</a>
    
@endsection