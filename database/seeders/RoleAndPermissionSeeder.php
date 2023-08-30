<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'manage requesters']);
        Permission::create(['name' => 'manage providers']);
        Permission::create(['name' => 'manage champions']);
        Permission::create(['name' => 'manage admins']);

        Role::create(['name' => 'super-admin'])->givePermissionTo(Permission::all());

        Role::create(['name' => 'admin'])
            ->givePermissionTo([
                'manage requesters',
                'manage providers',
                'manage champions',
            ]);

    }
}
