@extends('layouts.app')

@section('content')
    <div class="container">
         @include('components.serchform')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $scheduled_date }} の修理伝票一覧</div>

                   <div class="card-body">
                       @if ($serviceOrders->isEmpty())
                           <p>修理伝票はありません</p>
                       @else
                           <ul>
                               @foreach($serviceOrders as $serviceOrder)
                               <li>
                                   
                                 <a href="{{ route('result.show', $serviceOrder->id) }}">
                                        
                                   <p>Repair Number: {{ $serviceOrder->repair_number }}</p>
                                   <p>Customer Name: {{ $serviceOrder->customer_name }}</p>
                                   <p>Address: {{ $serviceOrder->address }}</p>
                                   <p>Scheduled Date: {{ $serviceOrder->scheduled_date }}</p>
                               </li>
                               @endforeach
                           </ul>
                           
                           <!-- ページネーションリンクを表示 -->
                          
                            {{$serviceOrders->withQueryString()->links()}}
                       @endif
                   </div>
                   
                   <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">戻る</a>
                   
                </div>
            </div>
        </div>
    </div>
@endsection