<h1>商品登録</h1>

<form method="POST" action="/products">
    @csrf
    <input type="text" name="name">
    <button type="sumbit">登録</button>
</form>