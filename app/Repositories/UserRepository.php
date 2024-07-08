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
    
    public function save(User $user)
    {
        $user->save();

        return $user;
    }
}
