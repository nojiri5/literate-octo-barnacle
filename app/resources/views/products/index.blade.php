@extends('layouts.app')

@section('title','商品一覧')

@section('content')
    <h2>商品一覧</h2>

    <form action="{{ route('products.search') }}" method="GET" class="row g-2 mb-4 align-items-center">
        <div class ="col-md-4">
            <input type="text" name="keyword" class="form-control" placeholder="ワード検索" value="{{ $keyword ?? ''}}" >
        </div>

        <div class="col-md-3">
        <select name="min" class="form-select">
            <option value="">最低金額</option>
            <option value="0" {{ ($min ?? '') == '0' ? 'selected' : '' }}>0</option>
            <option value="1000" {{ ($min ?? '') == '1000' ? 'selected' : '' }}>1000</option>
            <option value="3000" {{ ($min ?? '') == '3000' ? 'selected' : '' }}>3000</option>
            <option value="5000" {{ ($min ?? '') == '5000' ? 'selected' : '' }}>5000</option>
            <option value="1000" {{ ($min ?? '') == '1000' ? 'selected' : '' }}>10000</option>
        </select>
        </div>

        <div class ="col-md-1 text-center pt-2">~</div>

        <div class="col-md-3">
        <select name="max" class="form-select">
            <option value="">最高金額</option>
            <option value="1000" {{ ($max ?? '') == '1000' ? 'selected' : '' }}>1000</option>
            <option value="3000" {{ ($max ?? '') == '3000' ? 'selected' : '' }}>3000</option>
            <option value="5000" {{ ($max ?? '') == '5000' ? 'selected' : '' }}>5000</option>
            <option value="10000" {{ ($max ?? '') == '10000' ? 'selected' : '' }}>10000</option>
            <option value="10000" {{ ($max ?? '') == '10000' ? 'selected' : '' }}>15000</option>
        </select> 
    </div>

        <div class="col-md-2">
            <button type="sumbit" class="btn btn-primary w-100">検索</button>
        </div>
    </form>

    @if ($products->isEmpty())
        <p>商品がありません</p>
    @else
    
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        @foreach ($products as $product)
        
        <div class="col mb-5">
                <div class="card h-100">
                <!-- Product image-->
                <img class="card-img-top" src="{{ url('storage/' , $product->image) }}" style="height:200px; object-fit: cover;">
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                    <!-- Product name-->
                        <h2 class="fw-bolder"><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></h5>
                        <!-- Product price-->
                        <p>¥{{ number_format($product->amount) }}</p>
                    </div>
                </div>  
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="sumbit">カートに追加</button>
                    </form></div>

                    <div class="text-center"><form action="{{ route('favorites.store', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                    お気に入り
                    </button>
                    </form></div>
                </div>
                </div>
            </div>
            @endforeach


        </div>
    </div>
        
    @endif
            
@endsection