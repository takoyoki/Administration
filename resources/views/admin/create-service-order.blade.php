@extends('layouts.app')

@section('content')
  
    <div class="container">
        <div style="position: relative;">
         @include('components.serchform')
         <a href="{{ route('admin.dashboard') }}" class="btn btn-primary" style="position: absolute; bottom: 0; right: 0;">戻る</a>
         </div>
      
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">伝票作成</div>
                    <div class="card-body">
                        <form action="{{ route('admin.store-service-order') }}" method="post">
                            @csrf
                           <div class="form-group">
                                 <label for="repair_number">伝票番号:</label>
                                 <input type="text" class="form-control" name="repair_number" id="repair_number" value="{{ $nextRepairNumber }}" readonly>
                           </div>

                            <div class="form-group">
                                <label for="scheduled_date">訪問予定日:</label>
                                <input type="date" class="form-control" name="scheduled_date" id="scheduled_date" value="{{ old('scheduled_date') }}">
                                <p class="title__error" style="color:red">{{ $errors->first('scheduled_date') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="status">伝票状態:</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="修理完了">修理完了</option>
                                    <option value="見積待ち">見積待ち</option>
                                    <option value="様子見">様子見</option>
                                    <option value="その他">その他</option>
                                </select>
                            </div>
                             
                            <div class="form-group">
                                <label for="customer_name">依頼様名:</label>
                                <input type="text" class="form-control" name="customer_name" id="customer_name" value="{{ old('customer_name') }}">
                                <p class="title__error" style="color:red">{{ $errors->first('customer_name') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="phone_number">電話番号:</label>
                                <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
                                <p class="title__error" style="color:red">{{ $errors->first('phone_number') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="address">住所:</label>
                                <textarea class="form-control" name="address" id="address">{{ old('address') }}</textarea>
                                <p class="title__error" style="color:red">{{ $errors->first('address') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="memo">依頼内容:</label>
                                <textarea class="form-control" name="memo" id="memo">{{ old('memo') }}</textarea>
                                <p class="title__error" style="color:red">{{ $errors->first('memo') }}</p>
                            </div>
                            
                             <div class="form-group">
                                <label for="service_request">依頼内容:</label>
                                <textarea class="form-control" name="service_request" id="service_request">{{ old('service_request') }}</textarea>
                                <p class="title__error" style="color:red">{{ $errors->first('service_request') }}</p>
                            </div>
                            
                             <div class="form-group">
                                <label for="repair_assessment_and_implementation">判定実施内容:</label>
                                <textarea class="form-control" name="repair_assessment_and_implementation" id="repair_assessment_and_implementation" value="{{ old('repair_assessment_and_implementation') }}"></textarea>
                                <p class="title__error" style="color:red">{{ $errors->first('repair_assessment_and_implementation') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="amount">料金:</label>
                                <input type="text" class="form-control" name="amount" id="amount" value="{{ old('amount', 0) }}">
                                <p class="title__error" style="color:red">{{ $errors->first('amount') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="worker_id">作業員を選択:</label>
                                <select class="form-control" name="worker_id" id="worker_id">
                                     <option value=""> -- 作業員を選択してください -- </option> <!-- 空白の選択肢 -->
                                    @foreach ($workers as $worker)
                                        <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">伝票作成</button>
                        </form>
                    </div>
                </div>
                 
            </div>
        </div>
    </div>
@endsection