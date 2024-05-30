<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::query()->create([
            'role_name' => 'Admin',
            'desc' => 'Bisa akses semua fitur'
        ]);

        $roles = Role::query()->limit(1)->first();

        $data = [
            'name' => 'Test User',
            'username' => 'zahariz',
            'password' => Hash::make('rahasia'),
            'role_id' => $roles->id
        ];

        $user = new User($data);
        $user->save();
    }
}
