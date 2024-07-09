<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index(Request $request)
    {
        $where = [
            ['name', 'LIKE', "%$request->name%"]
        ];

        $users = $this->userRepo->get([
            'select' => [
                'id',
                'name',
                'username',
                'email'
            ],
            'where' => $where,
            'perPage' => 10
        ]);

        return view('pages.users.index', [
            'users' => $users
        ]);
    }
}
