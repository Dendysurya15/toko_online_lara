<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $adminRole = Role::where('name', 'admin')->first();
        $pembeliRole = Role::where('name', 'pembeli')->first();

        // Create admin user
        $adminUser = User::factory()->create([
            'name' => 'admin',
            'email' => 'super@gmail.com',
            'password' => Hash::make('12341234'),
        ]);

        // Assign 'admin' role to admin user
        $adminUser->assignRole($adminRole);

        // Create pembeli user
        $pembeliUser = User::factory()->create([
            'name' => 'pembeli',
            'email' => 'pembeli@gmail.com',
            'password' => Hash::make('12341234'),
        ]);

        // Assign 'pembeli' role to pembeli user
        $pembeliUser->assignRole($pembeliRole);
    }
}
