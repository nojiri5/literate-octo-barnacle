@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>お気に入り一覧</h2>

    @if ($favorites->isEmpty())
        <p>お気に入りはありません。</p>
    @else
        <div class="row">
            @foreach ($favorites as $favorite)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if ($favorite->product->image)
                            <img src="{{ url('storage/' . $favorite->product->image) }}"
                                 class="card-img-top"
                                 style="height:200px; object-fit:cover;">
                        @endif

                        <div class="card-body text-center">
                            <h5>{{ $favorite->product->name }}</h5>
                            <p>¥{{ number_format($favorite->product->amount) }}</p>

                            <a href="{{ route('products.show', $favorite->product->id) }}"
                               class="btn btn-primary">
                                詳細
                            </a>

                            <form action="{{ route('favorites.destroy', $favorite->product->id) }}"
                                  method="POST"
                                  class="mt-2">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">
                                    解除
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection