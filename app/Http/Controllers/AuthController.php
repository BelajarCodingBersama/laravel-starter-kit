<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function registerPage()
    {
        return view('pages.auth.register');
    }

    public function loginPage()
    {
        return view('pages.auth.login');
    }

    public function register(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();

            $request->merge(['password' => bcrypt($request->password)]);

            $user = new User();
            $data = $request->only(['name', 'username', 'email', 'password']);

            $user = $this->userRepo->save($user->fill($data));

            event(new Registered($user));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return ResponseHelper::error('Something went wrong, ' . $th->getMessage());
        }

        return ResponseHelper::success('Successfully create new account.', 'auth.login-page');
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('username', $request->username_or_email)
                    ->orWhere('email', $request->username_or_email)
                    ->first();

        if (empty($user) || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'auth' => 'Email or password did not match.'
            ]);
        }

        Auth::login($user);

        return redirect()->route('auth.overview');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login-page');
    }
}
