@extends('layouts.app')

@section('content')

<div class="container">
    <div class="position-relative">
        @include('components.serchform')
        <a href="{{ route('worker.dashboard') }}" class="btn btn-primary" style="position: absolute; bottom: 0; right: 0;">戻る</a>
    </div>
    
    <h1 class="mt-3">ユーザー情報</h1>

    <form action="{{ route('worker.editUser', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">名前</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        </div>
        
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
        </div>
        
        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>

@endsection