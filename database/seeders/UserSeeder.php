<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@mgk.com',
            'password' => bcrypt('password123'),
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@mgk.com',
            'password' => bcrypt('password123'),
        ]);

        User::create([
            'name' => 'Manager',
            'email' => 'manager@mgk.com',
            'password' => bcrypt('password123'),
        ]);

        User::create([
            'name' => 'employee',
            'email' => 'employee@mgk.com',
            'password' => bcrypt('password123'),
        ]);
    }
}
