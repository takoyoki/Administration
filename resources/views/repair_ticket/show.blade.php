<!-- resources/views/repair_ticket/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Repair Ticket Details</div>

                    <div class="card-body">
                        <p><strong>Repair Ticket ID:</strong> {{ $repairTicket->id }}</p>
                        <!-- 修理伝票の詳細を表示 -->

                        <hr>

                        <h4>Assign to Worker</h4>
                        <form action="{{ route('admin.assign', ['id' => $repairTicket->id]) }}" method="POST">
                            @csrf
                            <select name="worker_id">
                                @foreach($workers as $worker)
                                    <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-success">Assign</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection