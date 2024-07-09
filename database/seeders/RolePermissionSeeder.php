<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Developer'],
            ['name' => 'Admin'],
            ['name' => 'Customer']
        ];

        $permissions = [
            ['name' => 'view all roles'],
            ['name' => 'create role'],
            ['name' => 'add permissions to role'],
            ['name' => 'delete role'],

            ['name' => 'view all permissions'],
            ['name' => 'create permission'],
            ['name' => 'delete permission'],

            ['name' => 'view all users'],
            ['name' => 'add roles to user'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        $developer = Role::find(1);
        $developer->givePermissionTo([1,2,3,4,5,6,7,8,9]);

        $admin = Role::find(2);
        $admin->givePermissionTo([8,9]);
    }
}
