@extends('layouts.app')

@section('content')
    <div class="container">
        <div style="position: relative;">
        @include('components.serchform')
         @auth
                    @if(auth()->user()->role == '0')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mt-3" style="position: absolute; bottom: 0; right: 0;">戻る</a>
                    @else
                        <a href="{{ route('worker.dashboard') }}" class="btn btn-primary mt-3" style="position: absolute; bottom: 0; right: 0;">戻る</a>
                    @endif
                @endauth
        </div>            
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Search Results</div>

                    <div class="card-body">
                        @if ($results->isEmpty())
                            <p>No results found.</p>
                        @else
                            <ul class="list-unstyled">
                                @foreach ($results as $result)
                                    <li class="mb-3">
                                        <a href="{{ route('result.show', $result->id) }}" class="text-decoration-none">
                                            <div class="border p-3">
                                                <p class="mb-1">伝票番号: {{ $result->repair_number }}</p>
                                                <p class="mb-1">依頼様名: {{ $result->customer_name }}</p>
                                                <p class="mb-1">住所: {{ $result->address }}</p>
                                                <p class="mb-1">伝票状態: {{ $result->status }}</p>
                                                <p class="mb-0">訪問予定日: {{ $result->scheduled_date }}</p>
                                                
                                                 <!-- 割り当てられた作業員の名前を表示 -->
                        @if(isset($result->worker_id))
                        @php
                        $assignedWorker = App\Models\Worker::find($result->worker_id);
                        @endphp
                        @if($assignedWorker)
                        <p><strong>Assigned Worker:</strong> {{ $assignedWorker->name }}</p>
                        @else
                        <p><strong>Assigned Worker:</strong> Unknown</p>
                        @endif
                        @endif
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                {{$results->withQueryString()->links()}}
                
               
            </div>
        </div>
    </div>
@endsection