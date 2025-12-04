<?php

namespace Vendor\UltimateStarterKit\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vendor\UltimateStarterKit\Models\Role;
use Vendor\UltimateStarterKit\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of roles.
     */
    public function index()
    {
        $roles = Role::with('permissions')->paginate(15);
        return view('ultimate::roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        $permissions = Permission::orderBy('module')
            ->orderBy('feature')
            ->orderBy('action')
            ->get()
            ->groupBy('module');

        return view('ultimate::roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'slug' => ['required', 'string', 'max:255', 'unique:roles,slug'],
            'description' => ['nullable', 'string'],
            'permissions' => ['array'],
            'permissions.*' => ['exists:permissions,id'],
        ]);

        $role = Role::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'description' => $validated['description'] ?? null,
            'is_super_admin' => false,
        ]);

        if (isset($validated['permissions'])) {
            $role->assignPermissions($validated['permissions']);
        }

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Show the form for editing a role.
     */
    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::orderBy('module')
            ->orderBy('feature')
            ->orderBy('action')
            ->get()
            ->groupBy('module');
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('ultimate::roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified role.
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $id],
            'slug' => ['required', 'string', 'max:255', 'unique:roles,slug,' . $id],
            'description' => ['nullable', 'string'],
            'permissions' => ['array'],
            'permissions.*' => ['exists:permissions,id'],
        ]);

        $role->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'description' => $validated['description'] ?? null,
        ]);

        if (isset($validated['permissions'])) {
            $role->assignPermissions($validated['permissions']);
        } else {
            $role->permissions()->detach();
        }

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified role.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        // Prevent deleting super admin role
        if ($role->is_super_admin) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'Cannot delete Super Admin role.');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}

