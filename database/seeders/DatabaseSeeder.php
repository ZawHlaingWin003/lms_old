<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $role_names = ['admin', 'teacher', 'student'];
        
        foreach ($role_names as $key => $value) {
            Role::create([
                'role_name' => $value
            ]);
        }

        \App\Models\User::factory()->create([
            'username' => 'Admin',
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => 1
        ]);

        \App\Models\User::factory()->create([
            'username' => 'Teacher',
            'name' => 'Teacher User',
            'email' => 'teacher@example.com',
            'password' => bcrypt('password'),
            'role_id' => 2
        ]);

        \App\Models\User::factory()->create([
            'username' => 'Student',
            'name' => 'Student User',
            'email' => 'student@example.com',
            'password' => bcrypt('password'),
            'role_id' => 3
        ]);
    }
}
