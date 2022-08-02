<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        // create permissions for companies
        Permission::create(['name' => 'edit-company']);
        Permission::create(['name' => 'delete-company']);
        Permission::create(['name' => 'create-company']);
        Permission::create(['name' => 'view-company']);

        // create permissions for employees
        Permission::create(['name' => 'edit-employee']);
        Permission::create(['name' => 'delete-employee']);
        Permission::create(['name' => 'create-employee']);
        Permission::create(['name' => 'view-employees']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(['create-company', 'create-employee', 'view-company', 'view-employees']);

        $role = Role::create(['name' => 'company']);
        $role->givePermissionTo(['view-employees', 'create-employee']);

        $role = Role::create(['name' => 'employee']);
        $role->givePermissionTo('view-company');

    }
}
