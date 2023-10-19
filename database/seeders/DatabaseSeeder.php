<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $adminRole = Role::create([
            'name' => 'admin',
            'description' => 'Administrator Role',
        ]);

        $user = User::factory()->create([
            'name' => 'Suhail Sakhizadh',
            'email' => 'suhail_909@outlook.com',
            'password' => bcrypt('1s2s3s4s'),
        ]);

        $user->roles()->attach($adminRole->id);
    }
}
