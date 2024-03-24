<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Superadmin
        $admin = Role::create([
            'name' => 'superadmin',
        ]);

        // Admin
        $admin = Role::create([
            'name' => 'admin',
        ]);

        // Marketing
        $admin = Role::create([
            'name' => 'marketing',
        ]);

        // User
        $admin = Role::create([
            'name' => 'user',
        ]);
    }
}
