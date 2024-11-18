<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'A',
            'email' => 'a@a.com',
            'password' => 'a',
        ]);
        
        User::factory()->create([
            'name' => 'B',
            'email' => 'b@b.com',
            'password' => 'b',
        ]);

        $this->call([
            AdminUserSeeder::class,]);
    }
}
