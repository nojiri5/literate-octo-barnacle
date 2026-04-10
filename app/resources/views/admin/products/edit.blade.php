@extends('layouts.app')

@section('title','商品編集')

@section('content')
    <h2>商品編集</h2>

    @if (errors->any())
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label>画像</label><br>
            <input type="file" name="image" value="{{ old('image', $product->image) }}">
        </div>

        <div>
            <label>商品名</label><br>
            <input type="text" name="name" value="{{ old('name', $product->name) }}">
        </div>

        <div>
            <label>価格</label><br>
            <input type="text" name="amount" value="{{ old('amount', $product->amount) }}">
        </div>

        <div>
            <label>説明</label><br>
            <textarea name="description"> {{ old('description', $product->description) }}</textarea>
        </div>

        <button type="sumbit">変更</button>
    </form>

@endsection