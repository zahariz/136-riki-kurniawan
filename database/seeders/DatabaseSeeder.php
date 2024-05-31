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
            'desc' => 'Akses full fitur'
        ]);
        Role::query()->create([
            'role_name' => 'User',
            'desc' => 'Akses terbatas'
        ]);

        $rolesAdmin = Role::query()->where('role_name', 'Admin')->first();
        $rolesUser = Role::query()->where('role_name', 'User')->first();

        $data = [
            'name' => 'Orang Ganteng dan Intelek',
            'username' => 'zahariz',
            'password' => Hash::make('rahasia'),
            'role_id' => $rolesAdmin->id
        ];
        $user = new User($data);
        $user->save();

        $dataUser = [
            'name' => 'Orang Ganteng',
            'username' => 'fulans',
            'password' => Hash::make('rahasia'),
            'role_id' => $rolesUser->id
        ];
        $user = new User($dataUser);
        $user->save();
    }
}
