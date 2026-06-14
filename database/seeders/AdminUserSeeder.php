<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@site.com'], // جلوگیری از تکراری شدن
            [
                'name' => 'Admin',
                'phone' => '09120000000',
                'password' => Hash::make('12345678'),
                'role' => 'admin', // اگر ستون role داری
            ]
        );
    }
}