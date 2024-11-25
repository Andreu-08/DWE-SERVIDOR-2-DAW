<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Usuario con rol de administrador
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role_id' => 1, // Relación con el rol 'admin' en la tabla roles
        ]);

        // Usuario con rol de usuario normal
        User::create([
            'name' => 'A',
            'email' => 'a@a.com',
            'password' => bcrypt('a'),
            'role_id' => 2, // Relación con el rol 'user' en la tabla roles
        ]);

        User::create([
            'name' => 'B',
            'email' => 'b@b.com',
            'password' => bcrypt('b'),
            'role_id' => 2, // Relación con el rol 'user' en la tabla roles
        ]);
    }
}

