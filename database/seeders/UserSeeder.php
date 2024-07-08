<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('secret')
            ],
            [
                'name' => 'Customer',
                'username' => 'customer',
                'email' => 'customer@mail.com',
                'password' => bcrypt('secret')
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
