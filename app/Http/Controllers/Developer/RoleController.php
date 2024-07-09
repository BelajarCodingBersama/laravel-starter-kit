<?php

namespace App\Http\Controllers\Developer;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\Models\User;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller implements HasMiddleware
{
    private $roleRepo, $permissionRepo;

    public function __construct(RoleRepository $roleRepo, PermissionRepository $permissionRepo)
    {
        $this->roleRepo = $roleRepo;
        $this->permissionRepo = $permissionRepo;
    }

    public static function middleware()
    {
        return [
            new Middleware('permission:view all roles', only:['index']),
            new Middleware('permission:create role', only:['create','store']),
            new Middleware('permission:add permissions to role', only:['addPermissionsPage','addPermissions']),
            new Middleware('permission:delete role', only:['destroy'])
        ];
    }

    public function index()
    {
        $roles = $this->roleRepo->get([
            'left_join' => [
                [
                    'role_has_permissions',
                    'roles.id',
                    '=',
                    'role_has_permissions.role_id'
                ],
                [
                    'permissions',
                    'role_has_permissions.permission_id',
                    '=',
                    'permissions.id'
                ]
            ],
            'select' => [
                'roles.id',
                'roles.name',
                "GROUP_CONCAT(permissions.name SEPARATOR ', ') as permission_names"
            ],
            'group_by' => ['roles.id', 'roles.name']
        ]);

        return view('pages.roles.index', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        return view('pages.roles.create');
    }

    public function store(RoleStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $role = new Role();
            $data = $request->only(['name']);

            $this->roleRepo->save($role->fill($data));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return ResponseHelper::error('Something went wrong, ' . $th->getMessage());
        }

        return ResponseHelper::success('Successfully create new role.', 'roles.index');
    }

    public function addPermissionsPage(Role $role)
    {
        $permissions = $this->permissionRepo->get([
            'select' => 'id, name',
            'order' => 'id ASC'
        ]);

        $roleHasPermissions = $role->permissions->pluck('id')->toArray();

        return view('pages.roles.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'roleHasPermissions' => $roleHasPermissions
        ]);
    }

    public function addPermissions(Request $request, Role $role)
    {
        if ($request->permission_IDs == null) {
            return ResponseHelper::error('Please choose at least one permission.');
        }

        try {
            DB::beginTransaction();

            $request->merge(['permission_IDs' => array_map('intval', $request->permission_IDs)]);

            $role->syncPermissions($request->permission_IDs);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return ResponseHelper::error('Something went wrong, ' . $th->getMessage());
        }

        return ResponseHelper::success('Successfully add permissions.', 'roles.index');
    }

    public function destroy(Role $role)
    {
        $users = User::role($role->name)->count();

        if (!empty($users)) {
            return ResponseHelper::error("Can't delete this role, cause the role is used.");
        }

        try {
            DB::beginTransaction();

            $role->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return ResponseHelper::error('Something went wrong, ' . $th->getMessage());
        }

        return ResponseHelper::success('Successfully delete role.', 'roles.index');
    }
}
