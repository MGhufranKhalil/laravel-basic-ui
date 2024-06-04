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
        Permission::create(['name' => 'create', 'company_id' => 0]);
        Permission::create(['name' => 'edit', 'company_id' => 0]);
        Permission::create(['name' => 'update', 'company_id' => 0]);
        Permission::create(['name' => 'view', 'company_id' => 0]);
        Permission::create(['name' => 'delete', 'company_id' => 0]);


        $superAdmin = Role::create(['name' => 'super-admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $admin = Role::create(['name' => 'manager']);
        $admin->givePermissionTo(Permission::all());

        $employee = Role::create(['name' => 'employee']);
        $employee->givePermissionTo(['view']);

    }
}
