<?php

namespace Vendor\UltimateStarterKit\Traits;

use Vendor\UltimateStarterKit\Models\Role;
use Vendor\UltimateStarterKit\Models\Permission;

trait HasRoles
{
    /**
     * Get all roles for the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    /**
     * Get all permissions directly assigned to the user.
     */
    public function directPermissions()
    {
        return $this->belongsToMany(Permission::class, 'user_permission');
    }

    /**
     * Get all permissions for the user (through roles and direct assignments).
     */
    public function getPermissionsAttribute()
    {
        // Get permissions through roles
        $rolePermissionIds = \Illuminate\Support\Facades\DB::table('user_role')
            ->join('role_permission', 'user_role.role_id', '=', 'role_permission.role_id')
            ->where('user_role.user_id', $this->id)
            ->pluck('role_permission.permission_id')
            ->unique()
            ->toArray();

        // Get direct permissions
        $directPermissionIds = \Illuminate\Support\Facades\DB::table('user_permission')
            ->where('user_permission.user_id', $this->id)
            ->pluck('user_permission.permission_id')
            ->toArray();

        // Merge and get unique permission IDs
        $allPermissionIds = array_unique(array_merge($rolePermissionIds, $directPermissionIds));

        return Permission::whereIn('id', $allPermissionIds)->get();
    }

    /**
     * Check if the user has a specific role.
     */
    public function hasRole(string|array $role): bool
    {
        if (is_string($role)) {
            $role = [$role];
        }

        return $this->roles()->whereIn('slug', $role)->exists();
    }

    /**
     * Check if the user has a specific permission.
     */
    public function hasPermission(string $permission): bool
    {
        // Check if user is super admin
        if ($this->isSuperAdmin()) {
            return true;
        }

        // Check direct permissions first
        $hasDirectPermission = \Illuminate\Support\Facades\DB::table('user_permission')
            ->join('permissions', 'user_permission.permission_id', '=', 'permissions.id')
            ->where('user_permission.user_id', $this->id)
            ->where('permissions.name', $permission)
            ->exists();

        if ($hasDirectPermission) {
            return true;
        }

        // Check permissions through roles
        return \Illuminate\Support\Facades\DB::table('user_role')
            ->join('role_permission', 'user_role.role_id', '=', 'role_permission.role_id')
            ->join('permissions', 'role_permission.permission_id', '=', 'permissions.id')
            ->where('user_role.user_id', $this->id)
            ->where('permissions.name', $permission)
            ->exists();
    }

    /**
     * Check if the user has any of the given permissions.
     */
    public function hasAnyPermission(array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if the user has all of the given permissions.
     */
    public function hasAllPermissions(array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if (!$this->hasPermission($permission)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check if the user is a super admin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->roles()
            ->where('is_super_admin', true)
            ->exists();
    }

    /**
     * Assign a role to the user.
     */
    public function assignRole(string|Role $role): void
    {
        if (is_string($role)) {
            $role = Role::where('slug', $role)->firstOrFail();
        }

        if (!$this->roles()->where('roles.id', $role->id)->exists()) {
            $this->roles()->attach($role->id);
        }
    }

    /**
     * Remove a role from the user.
     */
    public function removeRole(string|Role $role): void
    {
        if (is_string($role)) {
            $role = Role::where('slug', $role)->firstOrFail();
        }

        $this->roles()->detach($role->id);
    }

    /**
     * Sync roles for the user.
     */
    public function syncRoles(array $roles): void
    {
        $roleIds = collect($roles)->map(function ($role) {
            if ($role instanceof Role) {
                return $role->id;
            }
            return Role::where('slug', $role)->firstOrFail()->id;
        })->toArray();

        $this->roles()->sync($roleIds);
    }

    /**
     * Assign a permission directly to the user.
     */
    public function assignPermission(string|Permission $permission): void
    {
        if (is_string($permission)) {
            $permission = Permission::where('name', $permission)->firstOrFail();
        }

        if (!$this->directPermissions()->where('permissions.id', $permission->id)->exists()) {
            $this->directPermissions()->attach($permission->id);
        }
    }

    /**
     * Remove a permission directly from the user.
     */
    public function removePermission(string|Permission $permission): void
    {
        if (is_string($permission)) {
            $permission = Permission::where('name', $permission)->firstOrFail();
        }

        $this->directPermissions()->detach($permission->id);
    }

    /**
     * Sync direct permissions for the user.
     */
    public function syncPermissions(array $permissions): void
    {
        $permissionIds = collect($permissions)->map(function ($permission) {
            if ($permission instanceof Permission) {
                return $permission->id;
            }
            return Permission::where('name', $permission)->firstOrFail()->id;
        })->toArray();

        $this->directPermissions()->sync($permissionIds);
    }
}

