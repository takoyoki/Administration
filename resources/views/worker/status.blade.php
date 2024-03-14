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
                <div class="card-header">{{ ucfirst($status) }} の修理伝票一覧</div>

                <div class="card-body">
                    @if ($tickets->isEmpty())
                        <p>該当する伝票がありません。</p>
                    @else
                        <ul class="list-unstyled">
                            @foreach ($tickets as $ticket)
                                <li class="mb-3">
                                    <a href="{{ route('worker_result_show', $ticket->id) }}" class="text-decoration-none">
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="card-text">伝票番号: {{ $ticket->repair_number }}</p>
                                                <p class="card-text">依頼様名: {{ $ticket->customer_name }}</p>
                                                <p class="card-text">住所: {{ $ticket->address }}</p>
                                                <p class="card-text">訪問予定日: {{ $ticket->scheduled_date }}</p>
                                                <!-- 他に表示したい情報があれば追加 -->
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <!-- ページネーションリンクを表示 -->
                    <div class="d-flex justify-content-center">
                        {{$tickets->withQueryString()->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection