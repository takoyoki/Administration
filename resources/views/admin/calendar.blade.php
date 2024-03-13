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
                                <p class="mb-1">Repair Number: {{ $serviceOrder->repair_number }}</p>
                                <p class="mb-1">Customer Name: {{ $serviceOrder->customer_name }}</p>
                                <p class="mb-1">Address: {{ $serviceOrder->address }}</p>
                                <p class="mb-1">Scheduled Date: {{ $serviceOrder->scheduled_date }}</p>
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