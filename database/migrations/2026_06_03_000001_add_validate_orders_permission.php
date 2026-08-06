<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * The roles form (resources/views/roles/*.blade.php) and the order list
 * (resources/views/chassis_orders/index.blade.php) both reference the
 * permission name "Validate Orders" (plural). A previous migration only
 * created "Validate Order" (singular), so on fresh/live environments the
 * "Validate Orders" permission does not exist, the role checkbox never
 * renders, and the Valider/Rejeter buttons are hidden for everyone.
 *
 * This migration creates the correctly-named "Validate Orders" permission
 * and grants it to the Owner role.
 */
return new class extends Migration
{
    public function up(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::firstOrCreate([
            'name'       => 'Validate Orders',
            'guard_name' => 'web',
        ]);

        $ownerRole = Role::where('name', 'Owner')->where('guard_name', 'web')->first();
        if ($ownerRole) {
            $ownerRole->givePermissionTo('Validate Orders');
        }

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }

    public function down(): void
    {
        $permission = Permission::where('name', 'Validate Orders')
            ->where('guard_name', 'web')
            ->first();

        if ($permission) {
            $permission->delete();
        }
    }
};
