@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>登録内容変更</h2>

    <form action="{{ route('mypage.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>名前</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>

        <div class="mb-3">
            <label>メールアドレス</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>

        <div class="mb-3">
            <label>氏名</label>
            <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $user->full_name) }}">
        </div>

        <div class="mb-3">
            <label>電話番号</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
        </div>

    <div class="mb-3">
        <label>郵便番号</label>
        <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $user->postal_code) }}">
    </div>

    <div class="mb-3">
        <label>住所</label>
        <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
    </div>

        <button type="submit" class="btn btn-success">変更する</button>
    </form>
</div>
@endsection