@extends('layouts.app')

@section('content')
    <div class="container">
         @include('components.serchform')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Admin Dashboard</div>

<div class="container mt-3">
    <div class="card p-3">
        <div class="card-body">
            <h2 class="mb-4">伝票一覧</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        
                            <a href="{{ route('admin.orders', '修理完了') }}" class="btn btn-primary btn-lg btn-block">修理完了</a>
                        
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                       
                            <a href="{{ route('admin.orders', '見積待ち') }}" class="btn btn-primary btn-lg btn-block">見積待ち</a>
                        
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        
                            <a href="{{ route('admin.orders', '様子見') }}" class="btn btn-primary btn-lg btn-block">様子見</a>
                        
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        
                            <a href="{{ route('admin.orders', 'その他') }}" class="btn btn-primary btn-lg btn-block">その他</a>
                        
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <a href="{{ route('admin.create-service-order') }}" class="btn btn-primary">伝票作成</a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <form action="{{ route('show_worker_tickets') }}" method="GET">
                        <label for="worker_id">各作業員伝票:</label>
                        <select name="worker_id" id="worker_id">
                            @foreach ($workers as $worker)
                                <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">選択</button>
                    </form>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <a href="{{ route('admin.approved') }}" class="btn btn-primary">未承認ユーザー一覧</a>
                </div>
            </div>
        </div>
    </div>
</div>
        
        @component('components.calendar', ['events' => $events, 'eventCounts' => $eventCounts])
    @endcomponent 
        
    </div>
@endsection

