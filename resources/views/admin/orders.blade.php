@extends('layouts.app')

@section('content')
    <div class="container">
         @include('components.serchform')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $status }} の修理伝票一覧</div>

                   <div class="card-body">
                       <ul>
                           @foreach($orders as $order)
                           <li>
                               
                             <a href="{{ route('result.show', $order->id) }}">
                                    
                               <p>Repair Number: {{ $order->repair_number }}</p>
                               <p>Customer Name: {{ $order->customer_name }}</p>
                               <p>Address: {{ $order->address }}</p>
                               <p>Scheduled Date: {{ $order->scheduled_date }}</p>
                           </li>
                           @endforeach
                       </ul>
                       
                       <!-- ページネーションリンクを表示 -->
                      
                        {{$orders->withQueryString()->links()}}
                   </div>
                   
                   <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">戻る</a>
                   
                </div>
            </div>
        </div>
    </div>
@endsection