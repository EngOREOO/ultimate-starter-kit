<?php

namespace Vendor\UltimateStarterKit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_super_admin',
    ];

    protected $casts = [
        'is_super_admin' => 'boolean',
    ];

    /**
     * Get all permissions for the role.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    /**
     * Get all users with this role.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            config('auth.providers.users.model', \App\Models\User::class),
            'user_role'
        );
    }

    /**
     * Check if the role has a specific permission.
     */
    public function hasPermission(string $permissionName): bool
    {
        if ($this->is_super_admin) {
            return true;
        }

        return $this->permissions()->where('name', $permissionName)->exists();
    }

    /**
     * Check if the role is a super admin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->is_super_admin === true;
    }

    /**
     * Assign permissions to the role.
     */
    public function assignPermissions(array $permissionIds): void
    {
        $this->permissions()->sync($permissionIds);
    }
}

