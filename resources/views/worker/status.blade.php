@extends('layouts.app')

@section('content')
    <div class="container">
         @include('components.serchform')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ ucfirst($status) }} の修理伝票一覧</div>

                    <div class="card-body">
                        @if ($tickets->isEmpty())
                            <p>該当する伝票がありません。</p>
                        @else
                            <ul>
                                @foreach ($tickets as $ticket)
                                    <li>
                                        <a href="{{ route('worker_result_show', $ticket->id) }}">
                                            <p>修理伝票番号: {{ $ticket->repair_number }}</p>
                                            <p>顧客名: {{ $ticket->customer_name }}</p>
                                            <p>住所: {{ $ticket->address }}</p>
                                            <p>予定日: {{ $ticket->scheduled_date }}</p>
                                            <!-- 他に表示したい情報があれば追加 -->
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <!-- ページネーションリンクを表示 -->
                       
                        {{$tickets->withQueryString()->links()}}
                    </div>
                   
                    <a href="{{ route('worker.dashboard') }}" class="btn btn-primary">戻る</a>
                   
                </div>
            </div>
        </div>
    </div>
@endsection