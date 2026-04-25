<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@travelio.com',
                'password' => 'Admin@123',
                'role' => 'admin',
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => 'password',
                'role' => 'user',
            ],
            [
                'name' => 'Sarah Lee',
                'email' => 'sarah@example.com',
                'password' => 'password',
                'role' => 'user',
            ],
            [
                'name' => 'Michael Tan',
                'email' => 'michael@example.com',
                'password' => 'password',
                'role' => 'user',
            ],
            [
                'name' => 'Emma Wong',
                'email' => 'emma@example.com',
                'password' => 'password',
                'role' => 'user',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'role' => $user['role'],
                ]
            );
        }
    }
}