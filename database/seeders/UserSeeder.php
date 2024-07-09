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
                'name' => 'Developer',
                'username' => 'developer',
                'email' => 'developer@mail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('secret')
            ],
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@mail.com',
                'email_verified_at' => now(),
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

        $developer = User::find(1);
        $developer->assignRole(['developer','admin','customer']);

        $admin = User::find(2);
        $admin->assignRole(['admin']);

        $customer = User::find(3);
        $customer->assignRole(['customer']);
    }
}
