@extends('layouts.basic2')

@section('main')
<link rel="stylesheet" href="css/user.css">
<div class="user-container">
  <div class="user-outer">
    <h1 class="user-title">ユーザー情報</h1>
  </div>
  <div class="user-inner">
    <table>
      <tr>
        <th>id</th>
        <th>名前</th>
        <th>メールアドレス</th>
        <th></th>
      </tr>
      @foreach ($users as $user)
        <form action="/user_attendance" method="post">
          @csrf
          <tr>
            <td><input type="hidden" name="id" value="{{ $user->id }}">{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td><button class="user-btn" type="submit">勤怠情報</button></td>
          </tr>
        </form>
      @endforeach
    </table>
    <div id="pagination">
      {{ $users->links('pagination::bootstrap-4') }}
    </div>
  </div>
</div>
@endsection