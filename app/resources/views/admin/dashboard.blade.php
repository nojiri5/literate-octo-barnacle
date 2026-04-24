@extends('layouts.app')

@section('content')
<div class="container mt-5 text-conter">

<h2 class="mb-5">事業者ページ</h2>

<div class="d-grid gap-4 col-6 mx-auto">
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark btn-lg">
        ユーザーリスト
    </a>

    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark btn-lg">
        商品リスト
    </a>
</div>
</div>

@endsection