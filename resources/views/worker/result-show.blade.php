@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Result Details</div>

                    <div class="card-body">
                        
                            <div class="result-item">
                               
                                <p><strong>Repair Number:</strong> {{ $result->repair_number }}</p>
                                <p><strong>Scheduled Date:</strong> {{ $result->scheduled_date }}</p>
                                <p><strong>Status:</strong> {{ $result->status }}</p>
                                <p><strong>Customer Name:</strong> {{ $result->customer_name }}</p>
                                <p><strong>Phone Number:</strong> {{ $result->phone_number }}</p>
                                <p><strong>Address:</strong> {{ $result->address }}</p>
                                <p><strong>Memo:</strong> {{ $result->memo }}</p>
                                <p><strong>Amount:</strong> {{ $result->amount }}</p>
                                <p><strong>Created At:</strong> {{ $result->created_at }}</p>
                                <p><strong>Updated At:</strong> {{ $result->updated_at }}</p>
                                 <!-- 割り当てられた作業員の名前を表示 -->
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
                                 
                                 <button class="btn btn-primary edit-btn">Edit</button>
                                 
                                 <!-- Edit Form -->
                                 <form class="edit-form" action="{{ route('worker.update', ['id' => $result->id]) }}" method="POST" style="display: none;">
                                     @csrf
                                     
                                     <div class="form-group">
                                         <label for="scheduled_date">Scheduled Date:</label>
                                         <input type="text" class="form-control" id="scheduled_date" name="scheduled_date" value="{{ $result->scheduled_date }}">
                                     </div>

<div class="form-group">
    <label for="status">Status:</label>
    <select class="form-control" id="status" name="status">
        <option value="修理完了" {{ $result->status == "修理完了" ? 'selected' : '' }}>修理完了</option>
        <option value="見積待ち" {{ $result->status == "見積待ち" ? 'selected' : '' }}>見積待ち</option>
        <option value="様子見" {{ $result->status == "様子見" ? 'selected' : '' }}>様子見</option>
        <option value="その他" {{ $result->status == "その他" ? 'selected' : '' }}>その他</option>
    </select>
</div>


        <div class="form-group">
            <label for="memo">Memo:</label>
            <textarea class="form-control" id="memo" name="memo" rows="4">{{ $result->memo }}</textarea>
        </div>

<div class="form-group">
    <label for="amount">Amount:</label>
    <input type="text" class="form-control" id="amount" name="amount" value="{{ $result->amount }}">
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
                 <a href="#" onclick="goBack()" class="btn btn-primary mt-3">戻る</a>

<script>
    function goBack() {
        window.history.back();
    }
</script>
                </div>
                
                 </div>
        </div>
    </div>
@endsection