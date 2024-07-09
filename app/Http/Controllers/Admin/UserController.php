<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class UserController extends Controller implements HasMiddleware
{
    private $userRepository, $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public static function middleware()
    {
        return [
            new Middleware('permission:view all users', only:['index']),
            new Middleware('permission:add roles to user', only:['addRolesPage','addRoles'])
        ];
    }

    public function index(Request $request)
    {
        $auth = User::find(auth()->id());
        $where = [
            ['users.name', 'LIKE', "%$request->name%"]
        ];

        $userHasntRole = User::role('developer')->pluck('id');
        
        if (!$auth->hasRole('Developer')) {
            array_push($where, ['users.id', '!=', $userHasntRole->toArray()]);
        }

        $users = $this->userRepository->get([
            'left_join' => [
                [
                    'model_has_roles',
                    'users.id',
                    '=',
                    'model_has_roles.model_id'
                ],
                [
                    'roles',
                    'model_has_roles.role_id',
                    '=',
                    'roles.id'
                ]
            ],
            'select' => [
                'users.id',
                'users.name',
                'users.username',
                'users.email',
                "GROUP_CONCAT(roles.name SEPARATOR ', ') as role_names"
            ],
            'group_by' => [
                'users.id',
                'users.name',
                'users.username',
                'users.email'
            ],
            'where' => $where,
            'perPage' => 10
        ]);

        return view('pages.users.index', [
            'users' => $users
        ]);
    }

    public function addRolesPage(User $user)
    {
        $auth = User::find(auth()->id());
        $where = [];
        
        if (!$auth->hasRole('Developer')) {
            array_push($where, ['name', '!=', 'Developer']);
        }

        $roles = $this->roleRepository->get([
            'select' => ['id', 'name'],
            'where' => $where
        ]);
            
        $userHasRoles = $user->getRoleNames()->toArray();

        return view('pages.users.change-role', [
            'user' => $user,
            'userHasRoles' => $userHasRoles,
            'roles' => $roles
        ]);
    }

    public function addRoles(Request $request, User $user)
    {
        if ($request->role_IDs == null) {
            return ResponseHelper::error('Please choose at least one roles.');
        }

        try {
            DB::beginTransaction();
            
            $request->merge(['role_IDs' => array_map('intval', $request->role_IDs)]);

            $user->syncRoles($request->role_IDs);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return ResponseHelper::error('Something went wrong, ' . $th->getMessage());
        }

        return ResponseHelper::success('Successfully add roles.', 'users.index');
    }
}