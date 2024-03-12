@extends('layouts.app')

@section('content')
    <div class="container">
         @include('components.serchform')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">伝票作成</div>
                    <div class="card-body">
                        <form action="{{ route('admin.store-service-order') }}" method="post">
                            @csrf
                           <div class="form-group">
                                 <label for="repair_number">Repair Number:</label>
                                 <input type="text" class="form-control" name="repair_number" id="repair_number" value="{{ $nextRepairNumber }}" readonly>
                           </div>

                            <div class="form-group">
                                <label for="scheduled_date">Scheduled Date:</label>
                                <input type="date" class="form-control" name="scheduled_date" id="scheduled_date" value="{{ old('scheduled_date') }}">
                                <p class="title__error" style="color:red">{{ $errors->first('scheduled_date') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="修理完了">修理完了</option>
                                    <option value="見積待ち">見積待ち</option>
                                    <option value="様子見">様子見</option>
                                    <option value="その他">その他</option>
                                </select>
                            </div>
                             
                            <div class="form-group">
                                <label for="customer_name">Customer Name:</label>
                                <input type="text" class="form-control" name="customer_name" id="customer_name" value="{{ old('customer_name') }}">
                                <p class="title__error" style="color:red">{{ $errors->first('customer_name') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="phone_number">Phone Number:</label>
                                <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
                                <p class="title__error" style="color:red">{{ $errors->first('phone_number') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="address">Address:</label>
                                <textarea class="form-control" name="address" id="address" value="{{ old('address') }}"></textarea>
                                <p class="title__error" style="color:red">{{ $errors->first('address') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="memo">Memo:</label>
                                <textarea class="form-control" name="memo" id="memo" value="{{ old('memo') }}"></textarea>
                                <p class="title__error" style="color:red">{{ $errors->first('memo') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="amount">Amount:</label>
                                <input type="text" class="form-control" name="amount" id="amount" value="{{ old('amount') }}">
                                <p class="title__error" style="color:red">{{ $errors->first('amount') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="worker_id">作業員を選択:</label>
                                <select class="form-control" name="worker_id" id="worker_id">
                                    @foreach ($workers as $worker)
                                        <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">伝票作成</button>
                        </form>
                    </div>
                </div>
                 <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">戻る</a>
            </div>
        </div>
    </div>
@endsection