@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Admin Dashboard</div>

                    @include('components.serchform')
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
              
            </div>
        </div>
    </div>
@endsection