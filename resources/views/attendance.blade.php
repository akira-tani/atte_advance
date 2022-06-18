@extends('layouts.basic2')

@section('main')
<link rel="stylesheet" href="css/attendance.css">
<div class="attendance-container">
  <div class="attendance-date">
    <form action="/attendance" class="date-button" method="post">
      @csrf
      <input type="hidden" name="date" value="{{ $date }}">
      <button type="submit" name="change_date" value="back"><</button>
    </form>
    <h1 class="attendance-date-title">{{ $date }}</h1>
    <form action="/attendance" class="date-button" method="post">
      @csrf
      <input type="hidden" name="date" value="{{ $date }}">
      <button type="submit" name="change_date" value="next">></button>
    </form>
  </div>
  <div class="attendance-outer">
    <table>
      <tr>
        <th>名前</th>
        <th>勤務開始</th>
        <th>勤務終了</th>
        <th>休憩時間</th>
        <th>勤務時間</th>
      </tr>
      @foreach ($work_times as $work_time)
      <tr>
        <td>{{ $work_time->user->name }}</td>
        <td>{{ $work_time->work_start }}</td>
        <td>{{ $work_time->work_end }}</td>
        <td>{{ $work_time->getRest() }}</td>
        <td>{{ $work_time->getWork() }}</td>
      </tr>
      @endforeach
    </table>
    <div id="pagination">
      {{ $work_times->appends($date)->links('pagination::bootstrap-4') }}
    </div>
    <script src="{{ asset('js/attendance.js') }}"></script>
  </div>
</div>
@endsection