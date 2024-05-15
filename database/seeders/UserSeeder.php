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
        $superadmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@mgk.com',
            'password' => bcrypt('password123'),
        ]);
        $superadmin->assignRole('super-admin');

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@mgk.com',
            'password' => bcrypt('password123'),
        ]);
        $admin->assignRole('admin');

        $manager = User::create([
            'name' => 'Manager',
            'email' => 'manager@mgk.com',
            'password' => bcrypt('password123'),
        ]);
        $manager->assignRole('manager');

        $employee = User::create([
            'name' => 'employee',
            'email' => 'employee@mgk.com',
            'password' => bcrypt('password123'),
        ]);
        $employee->assignRole('employee');
    }
}
