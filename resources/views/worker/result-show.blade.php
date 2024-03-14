@extends('layouts.app')

@section('content')
<div class="container">
    <div style="position: relative;">
        @include('components.serchform')
        <a href="#" onclick="goBack()" class="btn btn-primary mt-3" style="position: absolute; bottom: 0; right: 0;">戻る</a>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Result Details</div>
                <div class="card-body">
                    <div class="result-item">
                        <p><strong>伝票番号:</strong> {{ $result->repair_number }}</p>
                        <p><strong>訪問予定日:</strong> {{ $result->scheduled_date }}</p>
                        <p><strong>伝票状態:</strong> {{ $result->status }}</p>
                        <p><strong>依頼様名:</strong> {{ $result->customer_name }}</p>
                        <p><strong>電話番号:</strong> {{ $result->phone_number }}</p>
                        <p><strong>住所:</strong> {{ $result->address }}</p>
                        <p><strong>伝票メモ:</strong> {{ $result->memo }}</p>
                        <p><strong>依頼内容:</strong> {{ $result->service_request }}</p>
                        <p><strong>判定実施内容:</strong> {{ $result->repair_assessment_and_implementation }}</p>
                        <p><strong>料金:</strong> {{ $result->amount }}</p>
                        <p><strong>受付日:</strong> {{ $result->created_at }}</p>
                        
                        @if(isset($result->worker_id))
                            @php
                            $assignedWorker = App\Models\Worker::find($result->worker_id);
                            @endphp
                            @if($assignedWorker)
                                <p><strong>Assigned Worker:</strong> {{ $assignedWorker->name }}</p>
                            @else
                                <p><strong>Assigned Worker:</strong> Unknown</p>
                            @endif
                        @endif

                        <!-- Edit Button -->
                        <button class="btn btn-primary edit-btn">編集</button>

                        <!-- Edit Form -->
                        <form class="edit-form" action="{{ route('worker.update', ['id' => $result->id]) }}" method="POST" style="display: none;">
                            @csrf
                            <div class="form-group">
                                <label for="scheduled_date">訪問予定日:</label>
                                <input type="text" class="form-control" id="scheduled_date" name="scheduled_date" value="{{ old('scheduled_date', $result->scheduled_date) }}">
                                <p class="title__error" style="color:red">{{ $errors->first('scheduled_date') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="status">伝票状態:</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="修理完了" {{ $result->status == "修理完了" ? 'selected' : '' }}>修理完了</option>
                                    <option value="見積待ち" {{ $result->status == "見積待ち" ? 'selected' : '' }}>見積待ち</option>
                                    <option value="様子見" {{ $result->status == "様子見" ? 'selected' : '' }}>様子見</option>
                                    <option value="その他" {{ $result->status == "その他" ? 'selected' : '' }}>その他</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="memo">伝票メモ:</label>
                               <textarea class="form-control" id="memo" name="memo" rows="4">{{ old('memo',  $result->memo) }}</textarea>
                                <p class="title__error" style="color:red">{{ $errors->first('memo') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="service_request">依頼内容:</label>
                               <textarea class="form-control" id="service_request" name="service_request" rows="4">{{ old('service_request', $result->service_request) }}</textarea>
                                <p class="title__error" style="color:red">{{ $errors->first('service_request') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="repair_assessment_and_implementation">判定実施内容:</label>
                                <textarea class="form-control" id="repair_assessment_and_implementation" name="repair_assessment_and_implementation" rows="4">{{ old('repair_assessment_and_implementation',$result->repair_assessment_and_implementation) }}</textarea>
                                <p class="title__error" style="color:red">{{ $errors->first('repair_assessment_and_implementation') }}</p>
                            </div>
                            
                            <div class="form-group">
                                <label for="amount">料金:</label>
                                <input type="text" class="form-control" id="amount" name="amount" value="{{ old('amount', $result->amount) }}">
                                <p class="title__error" style="color:red">{{ $errors->first('amount') }}</p>
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>

                        <!-- JavaScript to toggle edit form display -->
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.querySelectorAll('.edit-btn').forEach(function(btn) {
                                    btn.addEventListener('click', function() {
                                        var form = this.nextElementSibling;
                                        if (form.classList.contains('edit-form')) {
                                            form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
                                        }
                                    });
                                });
                            });
                        </script>

                        <!-- PDF作成ボタン -->
                        <form target='_blank'action="{{ route('generatePdf', ['result' => $result]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">PDFを作成する</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function goBack() {
        window.history.back();
    }
</script>