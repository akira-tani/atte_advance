@extends('layouts.basic')

@section('main')
<link rel="stylesheet" href="css/register.css">
<div class="register-container">
  <h1 class="register-title">会員登録</h1>
  <form action="/register" method="post">
    @csrf
    <div class="regster-form-box">
      @if (count($errors) > 0)
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
      </ul>
      @endif
      <input type="text" name="name" value="{{ old('name') }}" placeholder="名前">
      <input type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス">
      <input type="password" name="password" value="{{ old('password') }}" placeholder="パスワード">
      <input type="password" name="password_confirmation" value="{{ old('password-confirmation') }}"  placeholder="確認用パスワード">
      <div>
        <button type="submit">会員登録</button>
      </div>
      <div>
        <p class="register-text">アカウントをお持ちの方はこちらから</p>
        <a href="/login">ログイン</a>
      </div>
    </div>
  </form>
</div>
@endsection