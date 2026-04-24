@extends('layouts.app')


@section('content')
    <h2>レビュー投稿</h2>

    @if ($errors->any())
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('reviews.store', $product->id) }}" method="POST">
        @csrf

        <div>
            <input type ="text" name="title" placeholder="タイトル">
        </div>

        <div>
            <textarea name="comment" placeholder="コメント"></textarea>
        </div>

        <button type="sumbit">投稿</button>
    </form>

     <br>
    <a href="{{ route('products.show', $product->id) }}">商品詳細へ戻る</a>
@endsection