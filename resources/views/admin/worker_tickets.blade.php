@extends('layouts.app')

@section('content')
<div class="container">
   <div style="position: relative;">
        @include('components.serchform')
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mt-3" style="position: absolute; bottom: 0; right: 0;">戻る</a>
        </div>

    <h1>{{ $worker->name }}の修理伝票</h1>

    @if($tickets->isEmpty())
        <p>修理伝票はありません。</p>
    @else
        <ul class="list-unstyled">
            @foreach ($tickets as $ticket)
                <li>
                    <a href="{{ route('result.show', $ticket->id) }}" class="text-decoration-none">
                        <div class="card mb-3">
                            <div class="card-body">
                                <p class="card-text"><strong>修理伝票番号:</strong> {{ $ticket->repair_number }}</p>
                                <p class="card-text"><strong>顧客名:</strong> {{ $ticket->customer_name }}</p>
                                <p class="card-text"><strong>住所:</strong> {{ $ticket->address }}</p>
                                <p class="card-text"><strong>予定日:</strong> {{ $ticket->scheduled_date }}</p>
                                <!-- 他の修理伝票の詳細情報もここに表示する -->
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="d-flex justify-content-center">
            {{$tickets->withQueryString()->links()}}
        </div>
    @endif
</div>
@endsection