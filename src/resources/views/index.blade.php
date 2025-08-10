@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
  <div class="contact-form__heading">
    <h2>お問い合わせ</h2>
  </div>

  <form class="form" action="{{ route('contacts.confirm') }}" method="post">
    @csrf

    {{-- 姓 --}}
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">姓</span>
        <span class="form__label--required">必須</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="text" name="last_name" placeholder="姓を入力してください" value="{{ old('last_name') }}">
        </div>
        <div class="form__error">
          @error('last_name')
            {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    {{-- 名 --}}
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">名</span>
        <span class="form__label--required">必須</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="text" name="first_name" placeholder="名を入力してください" value="{{ old('first_name') }}">
        </div>
        <div class="form__error">
          @error('first_name')
            {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    {{-- 性別 --}}
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">性別</span>
        <span class="form__label--required">必須</span>
      </div>
      <div class="form__group-content">
        <label><input type="radio" name="gender" value="male" {{ old('gender','male') === 'male' ? 'checked' : '' }}> 男性</label>
        <label><input type="radio" name="gender" value="female" {{ old('gender') === 'female' ? 'checked' : '' }}> 女性</label>
        <label><input type="radio" name="gender" value="other" {{ old('gender') === 'other' ? 'checked' : '' }}> その他</label>
        <div class="form__error">
          @error('gender')
            {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    {{-- メールアドレス --}}
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">メールアドレス</span>
        <span class="form__label--required">必須</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="email" name="email" placeholder="メールアドレスを入力してください" value="{{ old('email') }}">
        </div>
        <div class="form__error">
          @error('email')
            {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    {{-- 電話番号 --}}
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">電話番号</span>
        <span class="form__label--required">必須</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="tel" name="tel" placeholder="電話番号を入力してください（ハイフンなし）" value="{{ old('tel') }}">
        </div>
        <div class="form__error">
          @error('tel')
            {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    {{-- 住所 --}}
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">住所</span>
        <span class="form__label--required">必須</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="text" name="address" placeholder="住所を入力してください" value="{{ old('address') }}">
        </div>
        <div class="form__error">
          @error('address')
            {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    {{-- 建物名 --}}
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">建物名</span>
        <span class="form__label--optional">任意</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="text" name="building" placeholder="建物名を入力してください" value="{{ old('building') }}">
        </div>
      </div>
    </div>

    {{-- お問い合わせの種類 --}}
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">お問い合わせの種類</span>
        <span class="form__label--required">必須</span>
      </div>
      <div class="form__group-content">
        <select name="category_id">
          <option value="">選択してください</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
        <div class="form__error">
          @error('category_id')
            {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    {{-- お問い合わせ内容 --}}
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">お問い合わせ内容</span>
        <span class="form__label--required">必須</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--textarea">
          <textarea name="content" placeholder="お問い合わせ内容を入力してください（120文字以内）">{{ old('content') }}</textarea>
        </div>
        <div class="form__error">
          @error('content')
            {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    <div class="form__button">
      <button class="form__button-submit" type="submit">確認画面</button>
    </div>

  </form>
</div>

@endsection
