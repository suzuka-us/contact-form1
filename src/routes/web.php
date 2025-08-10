<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

// お問い合わせフォーム入力ページ
Route::get('/', function () {
    return view('index'); // resources/views/index.blade.phpを表示
});

// お問い合わせフォーム確認ページ（POSTで送られてくる想定）
Route::post('/confirm', function () {
    return view('confirm');
});

// サンクスページ（送信後の表示）
Route::post('/thanks', function () {
    return view('thanks');
});

// 管理画面
Route::get('/admin', function () {
    return view('admin');
});

// ユーザ登録ページ（GET）
Route::get('/register', function () {
    return view('register');
});

// ユーザ登録処理（POST）
Route::post('/register', function () {
    // 登録処理を書く
});

// ログインページ（GET）
Route::get('/login', function () {
    return view('login');
});

// ログイン処理（POST）
Route::post('/login', function () {
    // ログイン処理を書く
});

Route::get('/', [ContactController::class, 'index']);

Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store']);
