@extends('layouts.app')

@section('title','商品登録')

@section('content')
<h2>商品登録<h2>

@if($errors->any())
    <ul style="color:red;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form action ="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <label>画像</label><br>
        <input type="file" name="image">
    </div>

    <div>
        <label>商品名</label><br>
        <input type="text" name="name" value="{{ old('name') }}">
    </div>

    <div>
        <label>金額</label><br>
        <input type="text" name="amount" value="{{ old('amount') }}">
    </div>

    <div>
        <label>説明</label><br>
        <textarea name="description">{{ old('description') }}</textarea>
    </div>

    <button type="button" onClick="history.back()">戻る</button>
    <button type="sumbit">追加</button>
</form>
@endsection