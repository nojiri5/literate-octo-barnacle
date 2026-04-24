@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>マイページ</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <p>名前：{{ $user->name }}</p>
    <p>メールアドレス：{{ $user->email }}</p>
    <p>氏名：{{ $user->full_name }}</p>
    <p>電話番号：{{ $user->phone }}</p>
    <p>郵便番号：{{ $user->postal_code }}</p>
    <p>住所：{{ $user->address }}</p>

    <a href="{{ route('mypage.edit') }}" class="btn btn-primary">
        登録内容を変更
    </a>
</div>
@endsection