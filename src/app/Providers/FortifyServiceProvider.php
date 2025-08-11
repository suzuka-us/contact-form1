use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

public function boot()
{
    Fortify::loginView(function () {
        return view('auth.login');
    });

    Fortify::authenticateUsing(function (Request $request) {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'password.required' => 'パスワードを入力してください',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            return $user;
        }

        throw ValidationException::withMessages([
            'email' => ['認証情報が正しくありません。'],
        ]);
    });
}
