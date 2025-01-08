<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'admin']); // Rol administrador
        Role::create(['name' => 'user']);  // Rol usuario normal
    }
}
