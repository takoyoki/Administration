@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>未承認ユーザー一覧</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ユーザー名</th>
                    <th>メールアドレス</th>
                    <th>承認状態</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
               @foreach($unapprovedUsers as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->is_approved ? '承認済み' : '未承認' }}</td>
        <td>
            <form action="{{ route('admin.approve', $user->id) }}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <button type="submit" class="btn btn-primary">承認する</button>
</form>

<form action="{{ route('admin.reject', $user->id) }}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" class="btn btn-danger">拒否する</button>
</form>
        </td>
    </tr>
@endforeach
            </tbody>
        </table>
    </div>
@endsection