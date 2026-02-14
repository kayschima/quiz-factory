<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = Role::create(['name' => 'user']);
        $editor = Role::create(['name' => 'editor']);
        $admin = Role::create(['name' => 'admin']);
        $superadmin = Role::create(['name' => 'superadmin']);

        Permission::create(['name' => 'show questions'])->assignRole([$user, $editor, $admin, $superadmin]);
        Permission::create(['name' => 'create questions'])->assignRole([$user, $editor, $admin, $superadmin]);
        Permission::create(['name' => 'edit questions'])->assignRole([$editor, $admin, $superadmin]);
        Permission::create(['name' => 'delete questions'])->assignRole([$editor, $admin, $superadmin]);
        Permission::create(['name' => 'delete users'])->assignRole([$admin, $superadmin]);
    }
}
