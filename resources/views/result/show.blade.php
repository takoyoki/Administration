@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Result Details</div>

                    <div class="card-body">
                        
                            <div class="result-item">
                                <p><strong>Result ID:</strong> {{ $result->id }}</p>
                                <p><strong>Repair Number:</strong> {{ $result->repair_number }}</p>
                                <p><strong>Scheduled Date:</strong> {{ $result->scheduled_date }}</p>
                                <p><strong>Status:</strong> {{ $result->status }}</p>
                                <p><strong>Customer Name:</strong> {{ $result->customer_name }}</p>
                                <p><strong>Phone Number:</strong> {{ $result->phone_number }}</p>
                                <p><strong>Address:</strong> {{ $result->address }}</p>
                                <p><strong>Memo:</strong> {{ $result->memo }}</p>
                                <p><strong>Amount:</strong> {{ $result->amount }}</p>
                                <p><strong>Created At:</strong> {{ $result->created_at }}</p>
                                <p><strong>Updated At:</strong> {{ $result->updated_at }}</p>
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
    
                               
                               
                                <!-- 割り当てフォーム -->
                                @if(Auth::user()->role == 0) <!-- 管理者のみに表示 -->
                                <form action="{{ route('admin.assign', ['id' => $result->id]) }}" method="POST">
                                    @csrf
                                    <select name="worker_id">
                                        @foreach($workers as $worker)
                                        <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-success">Assign to Worker</button>
                                </form>
                                @endif
                               
                            </div>
                    </div>
                    <a href="{{ route('admin.search') }}" class="btn btn-primary mt-3">戻る</a>
                </div>
                
            </div>
        </div>
    </div>
@endsection