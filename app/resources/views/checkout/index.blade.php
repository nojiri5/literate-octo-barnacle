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

    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif

    <form action="{{ route('checkout.complete') }}" method="POST">
    @csrf

    <h4>お届け先情報</h4>

    <div class="mb-2">
        <input type="text" name="full_name" class="form-control"
               placeholder="氏名"
               value="{{ old('full_name', auth()->user()->full_name) }}">
    </div>

    <div class="mb-2">
        <input type="text" name="phone" class="form-control"
               placeholder="電話番号"
               value="{{ old('phone', auth()->user()->phone) }}">
    </div>

    <div class="mb-2">
        <input type="text" name="postal_code" class="form-control"
               placeholder="郵便番号"
               value="{{ old('postal_code', auth()->user()->postal_code) }}">
    </div>

    <div class="mb-3">
        <input type="text" name="address" class="form-control"
               placeholder="住所"
               value="{{ old('address', auth()->user()->address) }}">
    </div>

    <button type="submit" class="btn btn-success">
        購入する
    </button>
    </form>

     @endif
    <a href ="{{ route('cart.index') }}">カートに戻る</a>

@endsection