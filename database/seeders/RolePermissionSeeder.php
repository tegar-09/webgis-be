<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Hapus cache permission
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat permissions
        Permission::create(['name' => 'manage all']);
        Permission::create(['name' => 'report kejadian']);
        Permission::create(['name' => 'add penanganan']);

        // Buat roles dan tambahkan permissions
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $relawan = Role::create(['name' => 'relawan']);
        $relawan->givePermissionTo('report kejadian');

        $trc = Role::create(['name' => 'trc']);
        $trc->givePermissionTo('add penanganan');
    }
}
