@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
  <div class="confirm__heading">
    <h2>お問い合わせ内容確認</h2>
  </div>

  <form class="form" action="{{ route('contacts.store') }}" method="post">
    @csrf
    <div class="confirm-table">
      <table class="confirm-table__inner">
        <!-- お名前 -->
        <tr class="confirm-table__row">
          <th class="confirm-table__header">お名前</th>
          <td class="confirm-table__text">
            <input type="text" name="last_name" value="{{ $contact['last_name'] }}" readonly />
            <input type="text" name="first_name" value="{{ $contact['first_name'] }}" readonly />
          </td>
        </tr>

        <!-- 性別 -->
        <tr class="confirm-table__row">
          <th class="confirm-table__header">性別</th>
          <td class="confirm-table__text">
            @php
              $gender_jp = match($contact['gender'] ?? '') {
                'male' => '男性',
                'female' => '女性',
                'other' => 'その他',
                default => '未選択',
              };
            @endphp
            <input type="text" name="gender" value="{{ $gender_jp }}" readonly />
          </td>
        </tr>

        <!-- メールアドレス -->
        <tr class="confirm-table__row">
          <th class="confirm-table__header">メールアドレス</th>
          <td class="confirm-table__text">
            <input type="email" name="email" value="{{ $contact['email'] }}" readonly />
          </td>
        </tr>

        <!-- 電話番号 -->
        <tr class="confirm-table__row">
          <th class="confirm-table__header">電話番号</th>
          <td class="confirm-table__text">
            <input type="tel" name="tel_1" value="{{ $contact['tel_1'] ?? '' }}" readonly />
            <input type="tel" name="tel_2" value="{{ $contact['tel_2'] ?? '' }}" readonly />
            <input type="tel" name="tel_3" value="{{ $contact['tel_3'] ?? '' }}" readonly />
        </tr>

       
       
       
        <!-- 住所 -->
        <tr class="confirm-table__row">
          <th class="confirm-table__header">住所</th>
          <td class="confirm-table__text">
            <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
          </td>
        </tr>

        <!-- 建物名 -->
        <tr class="confirm-table__row">
          <th class="confirm-table__header">建物名</th>
          <td class="confirm-table__text">
            <input type="text" name="building" value="{{ $contact['building'] ?? '' }}" readonly />
          </td>
        </tr>

        <!-- お問い合わせの種類 -->
        <tr class="confirm-table__row">
          <th class="confirm-table__header">お問い合わせの種類</th>
          <td class="confirm-table__text">
            <input type="text" name="category_name" value="{{ $contact['category_name'] ?? '' }}" readonly />
          </td>
        </tr>

        <!-- お問い合わせ内容 -->
        <tr class="confirm-table__row">
          <th class="confirm-table__header">お問い合わせ内容</th>
          <td class="confirm-table__text">
      <!-- ここに class="confirm-table__textarea" を追加 -->
        <textarea name="content" class="confirm-table__textarea" readonly>{{ $contact['content'] }}</textarea>
  </td>
        </tr>
      </table>
    </div>


    <!-- hidden input をフォームに追加 フォーム内のどこでもOK 、テーブルの外で送信ボタンの直前に置くのが一般的-->
    <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" />


    <div class="form__button">
      <button class="form__button-submit" type="submit">送信</button>
    </div>
  </form>
</div>
@endsection
