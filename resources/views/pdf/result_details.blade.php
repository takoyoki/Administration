<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Details</title>
    <style>
        @font-face {
            font-family: ipag;
            src: url('{{ storage_path('fonts/ipag.ttf') }}');
        }

        body {
            font-family: ipag, sans-serif;
            padding: 20px;
        }

        .report-title {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        .report-details {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .report-details p {
            margin: 10px 0;
        }

        .assigned-worker {
            font-style: italic;
        }

        /* 追加のスタイルをここに追加 */

    </style>
</head>
<body>
    <div class="report-title">報告書</div>

    <div class="report-details">
        <p>伝票番号: {{ $result->repair_number }}</p>
        <p>訪問予定日: {{ $result->scheduled_date }}</p>
        <p>伝票状態: {{ $result->status }}</p>
        <p>依頼様名: {{ $result->customer_name }}</p>
        <p>電話番号: {{ $result->phone_number }}</p>
        <p>住所: {{ $result->address }}</p>
        
        <p>依頼内容: {{ $result->service_request }}</p>
        <p>判定実施内容: {{ $result->repair_assessment_and_implementation }}</p>
        <p>料金: {{ $result->amount }}</p>
        <p>受付日: {{ $result->created_at }}</p>

        @if(isset($result->worker_id))
            @php
                $assignedWorker = App\Models\Worker::find($result->worker_id);
            @endphp
            @if($assignedWorker)
                <p>作業員: {{ $assignedWorker->name }}</p>
            @else
                <p>作業員: Unknown</p>
            @endif
        @endif
    </div>

    <!-- 他の詳細情報を追加 -->

</body>
</html>