<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    private $model;

    /**
     * Create a new class instance.
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function get($params = [])
    {
        $users = $this->model
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

        if (!empty($params['perPage'])) {
            return $users->paginate($params['perPage']);
        }

        return $users->get();
    }
    
    public function save(User $user)
    {
        $user->save();

        return $user;
    }
}
