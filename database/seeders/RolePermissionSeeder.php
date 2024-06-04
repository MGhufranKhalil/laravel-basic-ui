<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'update']);
        Permission::create(['name' => 'view']);
        Permission::create(['name' => 'delete']);


        $superAdmin = Role::create(['name' => 'super-admin', 'company_id' => 0]);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::create(['name' => 'admin', 'company_id' => 0]);
        $admin->givePermissionTo(Permission::all());

        $admin = Role::create(['name' => 'manager', 'company_id' => 0]);
        $admin->givePermissionTo(Permission::all());

        $employee = Role::create(['name' => 'employee', 'company_id' => 0]);
        $employee->givePermissionTo(['view']);

    }
}
