<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function overview()
    {
        $userName = auth()->user()->name;

        return view('pages.account.overview', [
            'userName' => $userName
        ]);
    }

    public function profile()
    {
        return view('pages.account.profile', [
            'profile' => auth()->user()
        ]);
    }

    public function updateProfile(ProfileUpdateRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->only(['name', 'username']);

            $this->userRepo->save(User::find(auth()->id())->fill($data));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return ResponseHelper::error('Something went wrong, ' . $th->getMessage());
        }

        return ResponseHelper::success('Successfully update profile.', 'account.profile');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $request->merge(['password' => bcrypt($request->new_password)]);
        
        try {
            DB::beginTransaction();

            $data = $request->only(['password']);

            $this->userRepo->save(User::find(auth()->id())->fill($data));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return ResponseHelper::error('Something went wrong, ' . $th->getMessage());
        }

        return ResponseHelper::success('Successfully change your password.', 'account.profile');
    }
}
