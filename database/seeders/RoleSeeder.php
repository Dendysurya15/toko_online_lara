<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'tambah produk']);
        Permission::create(['name' => 'edit produk']);
        Permission::create(['name' => 'delete produk']);
        Permission::create(['name' => 'show produk']);
        Permission::create(['name' => 'order & checkout produk']);
        Permission::create(['name' => 'tambah cart produk']);

        $role = Role::create(['name' => 'pembeli'])->givePermissionTo(['show produk', 'order & checkout produk', 'tambah cart produk']);
        $role = Role::create(['name' => 'admin'])->givePermissionTo(['tambah produk', 'edit produk', 'delete produk', 'show produk']);
    }
}
