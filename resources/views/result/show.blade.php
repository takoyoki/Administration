

@extends('layouts.app')

@section('content')
<div class="container">
   <div style="position: relative;">
    @include('components.serchform')
    <a href="#" onclick="goBack()" class="btn btn-primary mt-3" style="position: absolute; bottom: 0; right: 0;">戻る</a>
   </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                        @if(Auth::user()->role == 0) <!-- 管理者のみに表示 -->
                        <button class="btn btn-primary edit-btn mb-2">Edit</button>
                        @endif

                        <!-- Edit Form -->
                        <form class="edit-form" action="{{ route('admin.update', ['id' => $result->id]) }}" method="POST" style="display: none;">
                            @csrf
                            <div class="form-group">
                                <label for="scheduled_date">Scheduled Date:</label>
                                <input type="text" class="form-control" id="scheduled_date" name="scheduled_date" value="{{ $result->scheduled_date }}">
                                <p class="title__error" style="color:red">{{ $errors->first('scheduled_date') }}</p>
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
                                                <label for="customer_name">Customer Name:</label>
                                                <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $result->customer_name }}">
                                                <p class="title__error" style="color:red">{{ $errors->first('customer_name') }}</p>
                                          </div>

                                          <div class="form-group">
                                                <label for="phone_number">Phone Number:</label>
                                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $result->phone_number }}">
                                                <p class="title__error" style="color:red">{{ $errors->first('phone_numbe') }}</p>
                                          </div>

                                          <div class="form-group">
                                                <label for="address">Address:</label>
                                                <textarea class="form-control" id="address" name="address" rows="4">{{ $result->address }}</textarea>
                                                <p class="title__error" style="color:red">{{ $errors->first('address') }}</p>
                                          </div>

                                          <div class="form-group">
                                                <label for="memo">Memo:</label>
                                                <textarea class="form-control" id="memo" name="memo" rows="4">{{ $result->memo }}</textarea>
                                                <p class="title__error" style="color:red">{{ $errors->first('memo') }}</p>
                                          </div>

                                          <div class="form-group">
                                                <label for="amount">Amount:</label>
                                                <input type="text" class="form-control" id="amount" name="amount" value="{{ $result->amount }}">
                                                <p class="title__error" style="color:red">{{ $errors->first('amount') }}</p>
                                          </div>
                                     

                            <button type="submit" class="btn btn-success">Save</button>
                        </form>

                        <!-- 割り当てフォーム -->
                        @if(Auth::user()->role == 0) <!-- 管理者のみに表示 -->
                        <form action="{{ route('admin.assign', ['id' => $result->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <select class="form-control" name="worker_id">
                                    @foreach($workers as $worker)
                                    <option value="{{ $worker->id }}" {{ $result->worker_id==$worker->id ? 'selected' : '' }}>{{ $worker->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Assign to Worker</button>
                        </form>
                        @endif

                        <!-- PDF作成ボタン -->
                        <form target='_blank'action="{{ route('generatePdf', ['result' => $result]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary mt-3">PDFを作成する</button>
                        </form>

                       <!-- 伝票削除削除ボタン -->
                    </div>
                        <form action="{{ route('service_orders.destroy', $result->id) }}" method="POST" id="delete-form-{{ $result->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger delete-btn" data-id="{{ $result->id }}">伝票削除</button>
                        </form>
                </div>
            </div>
        </div>
         
    </div>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>

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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const serviceOrderId = this.getAttribute('data-id');
                if (confirm('この伝票を削除しますか？')) {
                    document.getElementById('delete-form-' + serviceOrderId).submit();
                }
            });
        });
    });
</script>

@endsection