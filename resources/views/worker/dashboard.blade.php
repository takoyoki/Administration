@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Worker Dashboard</div>

                      @include('components.serchform')
                    </div>
                    
                    <div class="card-body">
    @if ($repairTickets->isEmpty())
        <p>No results found.</p>
    @else
        <div class="row">
            @foreach ($repairTickets as $repairTicket)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('worker.result-show', $repairTicket->id) }}">
                                <p>Repair Number: {{ $repairTicket->repair_number }}</p>
                                <p>Customer Name: {{ $repairTicket->customer_name }}</p>
                                <p>Address: {{ $repairTicket->address }}</p>
                                <p>Scheduled Date: {{ $repairTicket->scheduled_date }}</p>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

                </div>
            </div>
        </div>
    </div>
@endsection