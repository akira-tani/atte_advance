@extends('layouts.basic2')

@section('main')
<link rel="stylesheet" href="css/stamp.css">
<div class="stamp-container">
  <h1 class="stamp-title">{{Auth::user()->name}}さんお疲れ様です！</h1>
  @if(session('message'))
  <div class="message">
    {{session('message')}}
  </div>
  @endif
  <div class="stamp-work">
    @if(!$work_start)
      <form action="/work-start" method="post" class="stamp-work-inner">
        @csrf
        <button class="stamp-item">勤務開始</button>
      </form>
    @else
      <form action="/work-start" method="post" class="stamp-work-inner">
        @csrf
        <button class="stamp-item" disabled>勤務開始</button>
      </form>
    @endif
    @if($work_start && !$work_end)
      <form action="/work-end" method="post" class="stamp-work-inner">
        @csrf
        <button class="stamp-item">勤務終了</button>
      </form>
    @else
      <form action="/work-end" method="post" class="stamp-work-inner">
        @csrf
        <button class="stamp-item" disabled>勤務終了</button>
      </form>
    @endif
  </div>
  <div class="stamp-rest">
    @if(($work_start && !$work_end && !$rest_start) || ($work_start && !$work_end && $rest_end))
      <form action="/rest-start" method="post" class="stamp-rest-inner">
        @csrf
        <button class="stamp-item">休憩開始</button>
      </form>
    @else
      <form action="/rest-start" method="post" class="stamp-rest-inner">
        @csrf
        <button class="stamp-item" disabled>休憩開始</button>
      </form>
    @endif
    @if($work_start && !$work_end && $rest_start && !$rest_end)
      <form action="/rest-end" method="post" class="stamp-rest-inner">
        @csrf
        <button class="stamp-item">休憩終了</button>
      </form>
    @else
      <form action="/rest-end" method="post" class="stamp-rest-inner">
        @csrf
        <button class="stamp-item" disabled>休憩終了</button>
      </form>
    @endif
  </div>
</div>


@endsection