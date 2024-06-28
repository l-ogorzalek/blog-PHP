<?php

// database/seeders/UsersTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role_id' => 3,
        ]);

        User::create([
            'name' => 'Test Author',
            'email' => 'author@example.com',
            'password' => Hash::make('password'),
            'role_id' => 2,
        ]);

        // Tworzenie dodatkowych użytkowników
        User::factory()->count(3)->create();
    }
}
