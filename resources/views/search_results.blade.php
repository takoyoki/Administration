@extends('layouts.app')

@section('content')
    <div class="container">
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
                                    <li>{{ $result->name }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection