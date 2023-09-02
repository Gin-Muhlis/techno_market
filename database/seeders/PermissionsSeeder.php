<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list barangs']);
        Permission::create(['name' => 'view barangs']);
        Permission::create(['name' => 'create barangs']);
        Permission::create(['name' => 'update barangs']);
        Permission::create(['name' => 'delete barangs']);

        Permission::create(['name' => 'list detailpenjualans']);
        Permission::create(['name' => 'view detailpenjualans']);
        Permission::create(['name' => 'create detailpenjualans']);
        Permission::create(['name' => 'update detailpenjualans']);
        Permission::create(['name' => 'delete detailpenjualans']);

        Permission::create(['name' => 'list ketentuans']);
        Permission::create(['name' => 'view ketentuans']);
        Permission::create(['name' => 'create ketentuans']);
        Permission::create(['name' => 'update ketentuans']);
        Permission::create(['name' => 'delete ketentuans']);

        Permission::create(['name' => 'list kontaks']);
        Permission::create(['name' => 'view kontaks']);
        Permission::create(['name' => 'create kontaks']);
        Permission::create(['name' => 'update kontaks']);
        Permission::create(['name' => 'delete kontaks']);

        Permission::create(['name' => 'list pelanggans']);
        Permission::create(['name' => 'view pelanggans']);
        Permission::create(['name' => 'create pelanggans']);
        Permission::create(['name' => 'update pelanggans']);
        Permission::create(['name' => 'delete pelanggans']);

        Permission::create(['name' => 'list penjualans']);
        Permission::create(['name' => 'view penjualans']);
        Permission::create(['name' => 'create penjualans']);
        Permission::create(['name' => 'update penjualans']);
        Permission::create(['name' => 'delete penjualans']);

        Permission::create(['name' => 'list produks']);
        Permission::create(['name' => 'view produks']);
        Permission::create(['name' => 'create produks']);
        Permission::create(['name' => 'update produks']);
        Permission::create(['name' => 'delete produks']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admintechno@techno.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
