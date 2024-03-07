<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Result Details</title>
    <style>
    
    @font-face{
    font-family: ipag;
    font-style: normal;
    font-weight: normal;
    src:url('{{ storage_path('fonts/ipag.ttf')}}');
        
    }
    body {
        font-family: ipag;
        
    }
        
        /* PDF向けのスタイルを追加 */
        /* 例:
        body {
            font-family: Arial, sans-serif;
        }
        */
    </style>
</head>
<body>
    <h1>Result Details</h1>
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
    <!-- 他の詳細情報を追加 -->
</body>
</html>