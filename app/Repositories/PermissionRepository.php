<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    private $model;

    /**
     * Create a new class instance.
     */
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    public function get($params = [])
    {
        $permissions = $this->model
            ->when(!empty($params['select']), function ($query) use ($params) {
                return $query->selectRaw($params['select']);
            })
            ->when(!empty($params['where']), function ($query) use ($params) {
                foreach ($params['where'] as $where) {
                    $query->where(...$where);
                }

                return;
            })
            ->when(!empty($params['order']), function ($query) use ($params) {
                return $query->orderByRaw($params['order']);
            });

        if (!empty($params['perPage'])) {
            return $permissions->paginate($params['perPage']);
        }

        return $permissions->get();
    }

    public function save(Permission $permission)
    {
        $permission->save();

        return $permission;
    }
}
