

@props(['events'])



<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
  initialView: 'dayGridMonth', // この行の末尾にカンマを追加
  events: {!! json_encode($events) !!}, // JSON形式のデータを直接埋め込む
  dateClick: function(info) {
    window.location.href = "{{ route('calendar.service_orders') }}?date=" + info.dateStr;
  },
 dayCellContent: function(arg) {
            var cellContent = '<div class="fc-daygrid-day-number">' + arg.dayNumberText + '</div>';
            var date = arg.date.getFullYear() + '-' + ('0' + (arg.date.getMonth() + 1)).slice(-2) + '-' + ('0' + arg.date.getDate()).slice(-2);
            var eventCounts = {!! json_encode($eventCounts) !!};
            var count = eventCounts[date] ? eventCounts[date] : 0;
            if (count > 0) {
                cellContent += '<div style="position: absolute; top: 150%; left: 0%; transform: translate(-50%, -50%); background-color: red; border-radius: 50%; width: 20px; height: 20px; text-align: center; line-height: 20px;">' + count + '</div>';
            }
            return { html: cellContent };
          }
        });

        calendar.render();

        // datesRender イベントを使用してカレンダーの表示が変更された時にデータを取得し、カレンダーを更新する
        calendarEl.addEventListener('datesRender', function() {
          console.log('datesRender event triggered'); // デバッグ用のログメッセージ
          var start = calendar.view.activeStart;
          var end = calendar.view.activeEnd;
          var startStr = start.getFullYear() + '-' + ('0' + (start.getMonth() + 1)).slice(-2) + '-' + ('0' + start.getDate()).slice(-2);
          var endStr = end.getFullYear() + '-' + ('0' + (end.getMonth() + 1)).slice(-2) + '-' + ('0' + end.getDate()).slice(-2);

          // 新しい月のデータを取得してeventsオプションを更新する処理
          $.ajax({
            url: '/getEventData',
            type: 'GET',
            data: {
              start: startStr,
              end: endStr
            },
            success: function(response) {
              // サーバーから取得したデータをeventsオプションに設定し、カレンダーを再描画する
              calendar.setOption('events', response);
            },
            error: function(xhr, status, error) {
              console.error('Error fetching events data: ' + error);
            }
          });
        });
      });

    </script>
  </head>
  <body>
    <div id='calendar'></div>
  </body>
</html>