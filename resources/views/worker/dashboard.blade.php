@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-body">
                    @include('components.serchform')
                </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Worker Dashboard</div>
                
                <div class="row mt-3">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="card-body">
                    <h2 class="mb-4">伝票一覧</h2>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <a href="{{ route('service_orders.status', '修理完了') }}" class="btn btn-primary btn-lg btn-block">修理完了</a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <a href="{{ route('service_orders.status', '見積待ち') }}" class="btn btn-primary btn-lg btn-block">見積待ち</a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <a href="{{ route('service_orders.status', '様子見') }}" class="btn btn-primary btn-lg btn-block">様子見</a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <a href="{{ route('service_orders.status', 'その他') }}" class="btn btn-primary btn-lg btn-block">その他</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <div class="row mt-3">
    <div class="col-md-12">
        <a href="{{ route('worker.edit', Auth::user()->id) }}" class="btn btn-primary">ユーザー情報を編集</a>
    </div>
</div>
    
                
            </div>
        </div>
    </div>

    

    <div class="row mt-3">
        <div class="col-md-12">
            @component('components.worker-calendar', ['events' => $events, 'eventCounts' => $eventCounts])
            @endcomponent 
        </div>
    </div>
</div>
@endsection