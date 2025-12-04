<?php

namespace Vendor\UltimateStarterKit\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Vendor\UltimateStarterKit\Models\Role;
use Illuminate\Support\Facades\DB;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::firstOrCreate(
            ['slug' => 'super-admin'],
            [
                'name' => config('ultimate.super_admin_role', 'Super Admin'),
                'description' => 'Has access to everything',
                'is_super_admin' => true,
            ]
        );

        // Note: User creation is handled in InstallCommand
    }
}

