@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1>未承認ユーザー一覧</h1>
        <table class="table table-striped">
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
                                @method('PUT')
                                <button type="submit" class="btn btn-success">承認する</button>
                            </form>

                            <form action="{{ route('admin.reject', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">拒否する</button>
                            </form>
                        </td>
                    </tr>
               @endforeach
            </tbody>
        </table>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">戻る</a>
    </div>
@endsection