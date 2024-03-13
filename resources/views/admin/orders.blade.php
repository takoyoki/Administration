@extends('layouts.app')

@section('content')
    <div class="container">
        <div style="position: relative;">
        @include('components.serchform')
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mt-3" style="position: absolute; bottom: 0; right: 0;">戻る</a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $status }} の修理伝票一覧</div>

                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach($orders as $order)
                                <li class="mb-3 border-bottom pb-3">
                                    <a href="{{ route('result.show', $order->id) }}" class="text-decoration-none">
                                        <p class="mb-1">Repair Number: {{ $order->repair_number }}</p>
                                        <p class="mb-1">Customer Name: {{ $order->customer_name }}</p>
                                        <p class="mb-1">Address: {{ $order->address }}</p>
                                        <p class="mb-0">Scheduled Date: {{ $order->scheduled_date }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <!-- ページネーションリンクを表示 -->
                        {{$orders->withQueryString()->links()}}
                    </div>

                    

                </div>
            </div>
        </div>
    </div>
@endsection