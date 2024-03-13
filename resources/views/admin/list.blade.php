@extends('layouts.app')

@section('content')
<div class="container">
    <div style="position: relative;">
        @include('components.serchform')
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary" style="position: absolute; bottom: 0; right: 0;">戻る</a>
    </div>

    <h1 class="mt-3">ユーザー一覧</h1>

    @foreach($users as $user)
        <div class="card my-3">
            <div class="card-body">
                <h5 class="card-title">Name: {{ $user->name }}</h5>
                <p class="card-text">Email: {{ $user->email }}</p>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary mr-2">編集</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('本当に削除しますか？');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection