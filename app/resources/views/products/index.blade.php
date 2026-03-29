<h1>商品一覧</h1>

@foreach($products as $product)
    <p>{{$product->name}}</p>
@endforeach