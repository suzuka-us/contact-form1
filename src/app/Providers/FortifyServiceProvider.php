<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // ログイン画面
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // 登録画面
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // ログイン処理（バリデーション＋認証）
        Fortify::authenticateUsing(function (Request $request) {
            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ], [
                'email.required' => 'メールアドレスを入力してください',
                'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
                'password.required' => 'パスワードを入力してください',
            ]);

            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            throw ValidationException::withMessages([
                'email' => ['認証情報が正しくありません。'],
            ]);
        });

        // 新規登録処理は外部クラスに委譲（下記クラスを作成してください）
        Fortify::createUsersUsing(\App\Actions\Fortify\CreateNewUser::class);
    }
}
