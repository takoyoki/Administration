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
  @extends('layouts.app')


    <div class="container">
        <h1>作業員のダッシュボード</h1>
        
        <!-- 修理完了のコンテナ -->
        <div class="status-container">
            <a href="{{ route('service_orders.status', '修理完了') }}">
                <h3>修理完了</h3>
            </a>
        </div>

        <!-- 見積待ちのコンテナ -->
        <div class="status-container">
            <a href="{{ route('service_orders.status', '見積待ち') }}">
                <h3>見積待ち</h3>
            </a>
        </div>

        <!-- 様子見のコンテナ -->
        <div class="status-container">
            <a href="{{ route('service_orders.status', '様子見') }}">
                <h3>様子見</h3>
            </a>
        </div>

        <!-- その他のコンテナ -->
        <div class="status-container">
            <a href="{{ route('service_orders.status', 'その他') }}">
                <h3>その他</h3>
            </a>
        </div>
    </div>

    @endif
</div>
{{$repairTickets->withQueryString()->links()}}

                </div>
            </div>
        </div>
    </div>
@endsection