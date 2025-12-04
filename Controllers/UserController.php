<?php

namespace Vendor\UltimateStarterKit\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Vendor\UltimateStarterKit\Models\Role;
use Vendor\UltimateStarterKit\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $userModel = config('auth.providers.users.model', \App\Models\User::class);
        $users = $userModel::with('roles')
            ->paginate(15);

        return view('ultimate::users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = Role::all();
        
        // Get permissions grouped by module for super admin
        $permissions = Permission::all()->groupBy('module');
        $isSuperAdmin = auth()->user()->isSuperAdmin();
        
        return view('ultimate::users.create', compact('roles', 'permissions', 'isSuperAdmin'));
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'roles' => ['array'],
            'roles.*' => ['exists:roles,id'],
            'permissions' => ['array'],
            'permissions.*' => ['exists:permissions,id'],
        ]);

        $userModel = config('auth.providers.users.model', \App\Models\User::class);
        $user = $userModel::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if (isset($validated['roles']) && !empty($validated['roles'])) {
            if (method_exists($user, 'syncRoles')) {
                $user->syncRoles($validated['roles']);
            } else {
                $user->roles()->sync($validated['roles']);
            }
        }

        // Handle direct permission assignments (only for super admins)
        if (auth()->user()->isSuperAdmin() && isset($validated['permissions']) && !empty($validated['permissions'])) {
            if (method_exists($user, 'syncPermissions')) {
                $user->syncPermissions($validated['permissions']);
            } else {
                $user->directPermissions()->sync($validated['permissions']);
            }
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing a user.
     */
    public function edit($id)
    {
        $userModel = config('auth.providers.users.model', \App\Models\User::class);
        $user = $userModel::findOrFail($id);
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();

        // Get permissions grouped by module for super admin
        $permissions = Permission::all()->groupBy('module');
        $userDirectPermissions = $user->directPermissions->pluck('id')->toArray();
        $isSuperAdmin = auth()->user()->isSuperAdmin();

        return view('ultimate::users.edit', compact('user', 'roles', 'userRoles', 'permissions', 'userDirectPermissions', 'isSuperAdmin'));
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, $id)
    {
        $userModel = config('auth.providers.users.model', \App\Models\User::class);
        $user = $userModel::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'roles' => ['array'],
            'roles.*' => ['exists:roles,id'],
            'permissions' => ['array'],
            'permissions.*' => ['exists:permissions,id'],
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if (!empty($validated['password'])) {
            $user->update([
                'password' => Hash::make($validated['password']),
            ]);
        }

        if (isset($validated['roles'])) {
            if (method_exists($user, 'syncRoles')) {
                $user->syncRoles($validated['roles']);
            } else {
                $user->roles()->sync($validated['roles']);
            }
        }

        // Handle direct permission assignments (only for super admins)
        if (auth()->user()->isSuperAdmin() && isset($validated['permissions'])) {
            if (method_exists($user, 'syncPermissions')) {
                $user->syncPermissions($validated['permissions']);
            } else {
                $user->directPermissions()->sync($validated['permissions']);
            }
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user.
     */
    public function destroy($id)
    {
        $userModel = config('auth.providers.users.model', \App\Models\User::class);
        $user = $userModel::findOrFail($id);

        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}

