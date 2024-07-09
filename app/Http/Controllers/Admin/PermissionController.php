<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionStoreRequest;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller implements HasMiddleware
{
    private $permissionRepo;

    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepo = $permissionRepo;
    }

    public static function middleware()
    {
        return [
            new Middleware('permission:view all permissions', only:['index']),
            new Middleware('permission:create permission', only:['create','store']),
            new Middleware('permission:delete permission', only:['destroy'])
        ];
    }

    public function index(Request $request)
    {
        $permissions = $this->permissionRepo->get([
            'select' => 'id, name',
            'where' => [
                ['name', 'LIKE', "%$request->name%"]
            ],
            'order' => 'id ASC',
            'perPage' => 10
        ]);

        return view('pages.permissions.index', [
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        return view('pages.permissions.create');
    }

    public function store(PermissionStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $permission = new Permission();
            $data = $request->only(['name']);

            $this->permissionRepo->save($permission->fill($data));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return ResponseHelper::error('Something went wrong, ' . $th->getMessage());
        }

        return ResponseHelper::success('Successfully create new permission.', 'permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $roles = Role::permission($permission->name)->count();

        if (!empty($roles)) {
            return ResponseHelper::error("Can't delete this permission, cause the permission is used.");
        }

        try {
            DB::beginTransaction();

            $permission->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return ResponseHelper::error('Something went wrong, ' . $th->getMessage());
        }

        return ResponseHelper::success('Successfully delete permission.', 'permissions.index');
    }
}