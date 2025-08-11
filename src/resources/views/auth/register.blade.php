@extends('layouts.app')

@section('content')
<div class="register-form">
  <h2>ユーザー登録</h2>
  <form method="POST" action="{{ route('register') }}">
    @csrf

    <div>
      <label for="name">お名前</label>
      <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus />
      @error('name')
      <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="email">メールアドレス</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required />
      @error('email')
      <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="password">パスワード</label>
      <input id="password" type="password" name="password" required autocomplete="new-password" />
      @error('password')
      <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="password_confirmation">パスワード確認</label>
      <input id="password_confirmation" type="password" name="password_confirmation" required />
    </div>

    <button type="submit">登録</button>
  </form>
</div>
@endsection
