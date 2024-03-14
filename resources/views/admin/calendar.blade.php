@extends('layouts.app')

@section('content')

<div class="container">
    <div style="position: relative;">
    @include('components.serchform')
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary"  style="position: absolute; bottom: 0; right: 0;">戻る</a>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $scheduled_date }} の修理伝票一覧</div>
                <div class="card-body">
                    @if ($serviceOrders->isEmpty())
                    <p class="lead">修理伝票はありません。</p>
                    @else
                    <ul class="list-group">
                        @foreach($serviceOrders as $serviceOrder)
                        <li class="list-group-item">
                            <a href="{{ route('result.show', $serviceOrder->id) }}" class="text-decoration-none">
                                <p class="mb-1">伝票番号: {{ $serviceOrder->repair_number }}</p>
                                <p class="mb-1">依頼様名: {{ $serviceOrder->customer_name }}</p>
                                <p class="mb-1">住所: {{ $serviceOrder->address }}</p>
                                <p class="mb-1">訪問予定日: {{ $serviceOrder->scheduled_date }}</p>
                                <!-- 割り当てられた作業員の名前を表示 -->
                                        @if(isset($serviceOrder->worker_id))
                                        @php
                                        $assignedWorker = App\Models\Worker::find($serviceOrder->worker_id);
                                        @endphp
                                        @if($assignedWorker)
                                        <p><strong>Assigned Worker:</strong> {{ $assignedWorker->name }}</p>
                                        @else
                                        <p><strong>Assigned Worker:</strong> Unknown</p>
                                        @endif
                                        @endif
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    
                    @endif
                </div>
                <div class="card-footer">
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection