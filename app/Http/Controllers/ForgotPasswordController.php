<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('pages.password.forgot');
    }

    public function handler(ForgotPasswordRequest $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['errors' => __($status)]);
    }

    public function resetPage($token)
    {
        return view('pages.password.reset', [
            'token' => $token
        ]);
    }

    public function resetHandler(ResetPasswordRequest $request)
    {
        $data = $request->only(['email', 'password', 'password_confirmation', 'token']);

        $status = Password::reset($data, function (User $user, string $password) {
            $user->forceFill([
                'password' => bcrypt($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        });

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('auth.login-page')->with(['status' => __($status)])
            : back()->withErrors(['errors' => __($status)]);
    }
}
