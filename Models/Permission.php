<?php

namespace Vendor\UltimateStarterKit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'module',
        'feature',
        'action',
        'description',
    ];

    /**
     * Get all roles that have this permission.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }

    /**
     * Get all users that have this permission directly assigned.
     */
    public function users(): BelongsToMany
    {
        $userModel = config('auth.providers.users.model', \App\Models\User::class);
        return $this->belongsToMany($userModel, 'user_permission');
    }

    /**
     * Scope a query to only include permissions for a specific module.
     */
    public function scopeByModule(Builder $query, string $module): Builder
    {
        return $query->where('module', $module);
    }

    /**
     * Scope a query to only include permissions for a specific feature.
     */
    public function scopeByFeature(Builder $query, string $feature): Builder
    {
        return $query->where('feature', $feature);
    }

    /**
     * Scope a query to only include permissions for a specific action.
     */
    public function scopeByAction(Builder $query, string $action): Builder
    {
        return $query->where('action', $action);
    }

    /**
     * Get formatted module label.
     */
    public function getModuleLabelAttribute(): string
    {
        $modules = config('ultimate.modules', []);
        return $modules[$this->module] ?? ucfirst($this->module);
    }

    /**
     * Get formatted feature label.
     */
    public function getFeatureLabelAttribute(): string
    {
        return ucfirst(str_replace('_', ' ', $this->feature));
    }

    /**
     * Get formatted action label.
     */
    public function getActionLabelAttribute(): string
    {
        $actionLabels = [
            'index' => 'List',
            'create' => 'Create',
            'store' => 'Create',
            'show' => 'View',
            'edit' => 'Edit',
            'update' => 'Update',
            'destroy' => 'Delete',
        ];

        return $actionLabels[$this->action] ?? ucfirst($this->action);
    }
}

