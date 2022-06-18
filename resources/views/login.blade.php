@extends('layouts.basic')

@section('main')
<link rel="stylesheet" href="css/login.css">
<div class="login-container">
  <h1 class="login-title">ログイン</h1>
  <form action="/login" method="post">
    @csrf
    <div>
      <input type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス">
      <input type="password" name="password" value="{{ old('password') }}" placeholder="パスワード">
    </div>
    <div>
      <button type="submit">ログイン</button>
    </div>
  </form>
  <div>
    <p class="login-text">アカウントをお持ちでない方はこちらから</p>
    <a href="/register">会員登録</a>
  </div>
</div>
@endsection