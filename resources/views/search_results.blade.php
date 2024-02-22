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
                            <ul>
                                @foreach ($results as $result)
                                    <li>{{ $result->repair_number }}</li>
                                   
                                    <li>{{ $result->customer_name }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                {{$results->withQueryString()->links()}}
                
                
                <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection