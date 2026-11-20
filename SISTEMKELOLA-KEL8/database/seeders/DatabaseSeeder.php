<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            ['name' => 'Dhira',  'email' => 'dhira@admingmail.com'],
            ['name' => 'Firsya', 'email' => 'firsya@admingmail.com'],
            ['name' => 'Naufal', 'email' => 'naufal@admingmail.com'],
            ['name' => 'Cannava', 'email' => 'cannava@admingmail.com'],
        ];

        foreach ($admins as $admin) {
            $user = User::firstOrNew(['email' => $admin['email']]);
            $user->name = $admin['name'];
            $user->password = Hash::make('kelompok8');
            $user->role = 'admin';
            $user->save();
        }
    }
}