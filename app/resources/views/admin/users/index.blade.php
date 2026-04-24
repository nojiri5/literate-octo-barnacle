@extends('layouts.app')

@section('title','ユーザーリスト')

@section('content')
<div class="container mt-4">
    <h2>ユーザーリスト</h2>

    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>メール</th>
            <th>登録日</th>
        </tr>

        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
        </tr>
        @endforeach
    </table>
</div>

<a href="{{ route('admin.dashboard') }}">戻る</a>

@endsection