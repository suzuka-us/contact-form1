<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
  @yield('css')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        Contact Form
      </a>
      <nav class="header__nav">
        <ul class="header__nav-list">
          <li><a href="{{ route('login') }}" class="header__nav-link">ログイン</a></li>
          <li><a href="{{ route('register') }}" class="header__nav-link">登録</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    @yield('content')
  </main>
</bod
