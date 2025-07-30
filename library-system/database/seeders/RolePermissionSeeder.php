<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            'manage books',
            'manage categories',
            'register students',
            'borrow book',
            'return book',
            'view borrow history',
            'view out-of-stock books',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Create roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $librarian = Role::firstOrCreate(['name' => 'librarian']);
        $student = Role::firstOrCreate(['name' => 'student']);

        // Assign permissions to roles
        $admin->givePermissionTo(Permission::all());

        $librarian->givePermissionTo([
            'manage books',
            'manage categories',
            'register students',
            'borrow book',
            'return book',
            'view borrow history',
            'view out-of-stock books',
        ]);

        $student->givePermissionTo([
            'borrow book',
            'return book',
        ]);
    
    }
}
