@extends('layouts.app')

@section('content')
    <div class="container">
         @include('components.serchform')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Admin Dashboard</div>

                   
                </div>
                <div>
                    <h2><a href="{{ route('admin.orders', '修理完了') }}">修理完了</a></h2>
                    </div>
                    
                    <div>
                        <h2><a href="{{ route('admin.orders', '見積待ち') }}">見積待ち</a></h2>
                        </div>
                        
                        <div>
                            <h2><a href="{{ route('admin.orders', '様子見') }}">様子見</a></h2>
                        </div>
                        
                        <div>
                            <h2><a href="{{ route('admin.orders', 'その他') }}">その他</a></h2>
                        </div>
                        
                    <form action="{{ route('show_worker_tickets') }}" method="GET">
    <label for="worker_id">作業員を選択:</label>
    <select name="worker_id" id="worker_id">
        @foreach ($workers as $worker)
            <option value="{{ $worker->id }}">{{ $worker->name }}</option>
        @endforeach
    </select>
    <button type="submit">選択</button>
</form>
              
              
              
            </div>
        </div>
        @component('components.calendar', ['events' => $events, 'eventCounts' => $eventCounts])
    @endcomponent 
        
    </div>
@endsection

