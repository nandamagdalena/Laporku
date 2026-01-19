<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ADMIN
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone_number' => '081234567890',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // USER
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'phone_number' => '089876543210',
            'role' => 'user',
            'password' => Hash::make('password'),
        ]);
    }
}
