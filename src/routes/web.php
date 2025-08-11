<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;


// カテゴリー一覧
Route::get('/categories', [CategoryController::class, 'index']);

// お問い合わせフォーム（ユーザー向け）
Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
Route::post('/contacts/confirm', [ContactController::class, 'confirm'])->name('contacts.confirm');
Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');

// 管理画面（ログイン必須）
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/contacts', [AdminController::class, 'index'])->name('admin.contacts.index'); // 一覧 & 検索
    Route::get('/contacts/export', [AdminController::class, 'export'])->name('admin.contacts.export'); // CSVエクスポート
    Route::get('/contacts/{id}', [AdminController::class, 'show'])->name('admin.contacts.show'); // 詳細表示（Ajax）
    Route::delete('/contacts/{id}', [AdminController::class, 'destroy'])->name('admin.contacts.destroy'); // 削除（Ajax）
});
