<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository
{
    private $model;
    /**
     * Create a new class instance.
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    public function get($params = [])
    {
        $roles = $this->model
            ->when(!empty($params['left_join']), function ($query) use ($params) {
                foreach ($params['left_join'] as $join) {
                    $query->leftJoin(...$join);
                }

                return;
            })
            ->when(!empty($params['select']), function ($query) use ($params) {
                return $query->selectRaw(implode(", ", $params['select']));
            })
            ->when(!empty($params['group_by']), function ($query) use ($params) {
                return $query->groupBy($params['group_by']);
            })
            ->when(!empty($params['where']), function ($query) use ($params) {
                foreach ($params['where'] as $where) {
                    $query->where(...$where);
                }

                return;
            });

        return $roles->get();
    }

    public function save(Role $role)
    {
        $role->save();

        return $role;
    }
}
