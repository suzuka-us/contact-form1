@extends('layouts.app')

@section('content')
<div class="login-form">
  <h2>ログイン</h2>
  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div>
      <label for="email">メールアドレス</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="user@example.com">
      @error('email')
        <div class="error">{{ $message }}</div>
      @enderror
    </div>

    <div>
      <label for="password">パスワード</label>
      <input id="password" type="password" name="password" required placeholder="パスワード">
      @error('password')
        <div class="error">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit">ログイン</button>
  </form>
  <a href="{{ route('register') }}">登録ページへ</a>
</div>
@endsection
