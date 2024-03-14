@extends('layouts.app')

@section('content')
<div class="container">
    <div style="position: relative;">
        @include('components.serchform')
        <a href="{{ route('worker.dashboard') }}" class="btn btn-primary" style="position: absolute; bottom: 0; right: 0;">戻る</a>
    </div>
    
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $scheduled_date }} の修理伝票一覧</div>

                <div class="card-body">
                    @if ($serviceOrders->isEmpty())
                        <p>修理伝票はありません</p>
                    @else
                        <ul class="list-unstyled">
                            @foreach($serviceOrders as $serviceOrder)
                            <li class="mb-3">
                                <a href="{{ route('worker_result_show', $serviceOrder->id) }}" class="text-decoration-none">
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-text">伝票番号: {{ $serviceOrder->repair_number }}</p>
                                            <p class="card-text">依頼様名: {{ $serviceOrder->customer_name }}</p>
                                            <p class="card-text">住所: {{ $serviceOrder->address }}</p>
                                            <p class="card-text">訪問予定日: {{ $serviceOrder->scheduled_date }}</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>

                      
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection