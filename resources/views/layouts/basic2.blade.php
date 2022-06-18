<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/basic2.css') }}">
  <title>Atte</title>
</head>
<body class="container">
  <header class="header">
    <h1 class="header-title">Atte</h1>
    <ul class="header-nav">
      <li class="header-nav-item">
        <a href="/">ホーム</a>
      </li>
      <li class="header-nav-item">
        <a href="/attendance">日付一覧</a>
      </li>
      <li class="header-nav-item">
        <form action="/logout" method="post">
          @csrf
          <button class="header-logout-btn">ログアウト</button>
        </form>
      </li>
    </ul>
  </header>
  <main class="main">
    @yield('main')
  </main>
  <footer>
    <p>Atte, Inc.</p>
  </footer>
</body>
</html>

