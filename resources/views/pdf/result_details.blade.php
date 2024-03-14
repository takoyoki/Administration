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
    <!-- 他の詳細情報を追加 -->
</body>
</html>