<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * The roles form (resources/views/roles/create.blade.php and edit.blade.php)
 * builds permission names as "{Action} Orders" (plural), e.g. "Edit Orders",
 * "Delete Orders". Earlier migrations created some of these permissions with
 * a singular "Order" suffix instead ("Edit Order", "Delete Order"), so the
 * checkboxes never appeared on the Roles page and the corresponding
 * permission checks in ChassisOrderController never matched.
 *
 * This migration creates the correctly-named plural permissions (including
 * the new "Edit Orders" permission used by the pencil/edit action) and
 * grants them to the Owner role.
 */
return new class extends Migration
{
    public function up(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'Manage Orders',
            'Show Orders',
            'Edit Orders',
            'Delete Orders',
            'Validate Orders',
        ];

        foreach ($permissions as $permName) {
            Permission::firstOrCreate([
                'name'       => $permName,
                'guard_name' => 'web',
            ]);
        }

        $ownerRole = Role::where('name', 'Owner')->where('guard_name', 'web')->first();
        if ($ownerRole) {
            $ownerRole->givePermissionTo($permissions);
        }

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }

    public function down(): void
    {
        $permission = Permission::where('name', 'Edit Orders')
            ->where('guard_name', 'web')
            ->first();

        if ($permission) {
            $permission->delete();
        }
    }
};
