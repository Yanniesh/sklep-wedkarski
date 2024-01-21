<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminData = [
            'nickname' => 'admin',
            'name' => 'admin',
            'email' => 'admin@admin',
            'password' => Hash::make('adminadmin'),
            'role' => 'admin',
        ];

        User::create($adminData);
        $userData = [
            'nickname' => 'user',
            'name' => 'user',
            'email' => 'user@user',
            'password' => Hash::make('useruser'),
            'role' => 'user',
        ];
        User::create($userData);
    }
}
