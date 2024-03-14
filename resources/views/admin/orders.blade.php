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
                                        <p class="mb-1">伝票番号: {{ $order->repair_number }}</p>
                                        <p class="mb-1">依頼様名: {{ $order->customer_name }}</p>
                                        <p class="mb-1">住所: {{ $order->address }}</p>
                                        <p class="mb-0">訪問予定日: {{ $order->scheduled_date }}</p>
                                        <!-- 割り当てられた作業員の名前を表示 -->
                                        @if(isset($order->worker_id))
                                        @php
                                        $assignedWorker = App\Models\Worker::find($order->worker_id);
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

                        <!-- ページネーションリンクを表示 -->
                        {{$orders->withQueryString()->links()}}
                    </div>

                    

                </div>
            </div>
        </div>
    </div>
@endsection