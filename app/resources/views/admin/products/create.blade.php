@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">商品登録</div>
                <div class="card-body">
                    <form action="{{ route('admin.products.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="image" class="col-md-2 col-form-label text-md-right">画像</label>
                            <div class="col-md-9">
                                <input id="image" type="text" class="form-control" name="image" value="{{ old('image') }}">
                            </div>

                            <label for="name" class="col-md-2 col-form-label text-md-right">商品名</label>
                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>

                            <label for="amount" class="col-md-2 col-form-label text-md-right">価格</label>
                            <div class="col-md-9">
                                <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="body" class="col-md-2 col-form-label text-md-right">説明</label>
                            <div class="col-md-9">
                                <textarea name="body" id="body" style="resize: none; height: 200px; width: 100%">{{ old('body') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-secondary" onClick="history.back()">戻る</button>
                                <button type="submit" class="btn btn-primary ml-3" name='action' value='add'>
                                    追加
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection