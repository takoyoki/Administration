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
  
                    　　<p>伝票番号:{{ $result->repair_number }}</p>
                        <p>訪問予定日:{{ $result->scheduled_date }}</p>
                        <p>伝票状態:{{ $result->status }}</p>
                        <p>依頼様名:{{ $result->customer_name }}</p>
                        <p>電話番号:{{ $result->phone_number }}</p>
                        <p>住所:{{ $result->address }}</p>
                        <p>伝票メモ:{{ $result->memo }}</p>
                        <p>依頼内容:{{ $result->service_request }}</p>
                        <p>判定実施内容:{{ $result->repair_assessment_and_implementation }}</p>
                        
                        <p>料金:{{ $result->amount }}</p>
                        <p>受付日:{{ $result->created_at }}</p>
    
    
    
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