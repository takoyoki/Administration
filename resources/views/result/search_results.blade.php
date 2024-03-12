@extends('layouts.app')

@section('content')
    <div class="container">
        @include('components.serchform')
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
                                                <p class="mb-1">Repair Number: {{ $result->repair_number }}</p>
                                                <p class="mb-1">Customer Name: {{ $result->customer_name }}</p>
                                                <p class="mb-1">Address: {{ $result->address }}</p>
                                                <p class="mb-0">Scheduled Date: {{ $result->scheduled_date }}</p>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                {{$results->withQueryString()->links()}}
                
                @auth
                    @if(auth()->user()->role == '0')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mt-3">戻る</a>
                    @else
                        <a href="{{ route('worker.dashboard') }}" class="btn btn-primary mt-3">戻る</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
@endsection