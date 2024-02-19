@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Worker Dashboard</div>

                    <div class="card-body">
                        <!-- 検索フォーム -->
                        <form action="{{ route('worker.search') }}" method="GET" class="form-inline mb-3">
                            <div class="form-group mr-2">
                                <input type="text" name="query" class="form-control" placeholder="検索">
                            </div>
                            <button type="submit" class="btn btn-primary">検索</button>
                        </form>

                        <!-- ここに他のコンテンツを追加 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection