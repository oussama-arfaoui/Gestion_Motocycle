<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    public function up(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $newPermissions = [
            'Manage Flux',
            'Show Flux',
            'Create Flux',
            'Edit Flux',
            'Delete Flux',
        ];

        foreach ($newPermissions as $permName) {
            Permission::firstOrCreate([
                'name'       => $permName,
                'guard_name' => 'web',
            ]);
        }

        $ownerRole = Role::where('name', 'Owner')->where('guard_name', 'web')->first();
        if ($ownerRole) {
            $ownerRole->givePermissionTo($newPermissions);
        }
    }

    public function down(): void
    {
        $permissions = ['Manage Flux', 'Show Flux', 'Create Flux', 'Edit Flux', 'Delete Flux'];
        foreach ($permissions as $permName) {
            $p = Permission::where('name', $permName)->first();
            if ($p) {
                $p->delete();
            }
        }
    }
};
