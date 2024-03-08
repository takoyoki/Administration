@extends('layouts.app')

@section('content')
 @include('components.serchform')
    <h1>{{ $worker->name }}の修理伝票</h1>
    @if($tickets->isEmpty())
        <p>修理伝票はありません。</p>
    @else
        <ul>
            @foreach ($tickets as $ticket)
                <li>
                    <a href="{{ route('result.show', $ticket->id) }}">
                        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; cursor: pointer;">
                            <p><strong>修理伝票番号:</strong> {{ $ticket->repair_number }}</p>
                            <p><strong>顧客名:</strong> {{ $ticket->customer_name }}</p>
                            <p><strong>住所:</strong> {{ $ticket->address }}</p>
                            <p><strong>予定日:</strong> {{ $ticket->scheduled_date }}</p>
                            <!-- 他の修理伝票の詳細情報もここに表示する -->
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
         {{$tickets->withQueryString()->links()}}
    @endif
    
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mb-3">戻る</a>
    
@endsection