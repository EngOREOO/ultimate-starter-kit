<?php

use Illuminate\Support\Facades\Route;
use Vendor\UltimateStarterKit\Controllers\DashboardController;
use Vendor\UltimateStarterKit\Controllers\ProfileController;
use Vendor\UltimateStarterKit\Controllers\UserController;
use Vendor\UltimateStarterKit\Controllers\RoleController;
use Vendor\UltimateStarterKit\Controllers\PermissionController;
use Vendor\UltimateStarterKit\Controllers\SettingController;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Profile
Route::prefix('profile')->name('profile.')->group(function () {
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::put('/update', [ProfileController::class, 'update'])->name('update');
    Route::get('/password', [ProfileController::class, 'editPassword'])->name('password.edit');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

// Users
Route::resource('users', UserController::class)->names([
    'index' => 'users.index',
    'create' => 'users.create',
    'store' => 'users.store',
    'edit' => 'users.edit',
    'update' => 'users.update',
    'destroy' => 'users.destroy',
]);

// Roles
Route::resource('roles', RoleController::class)->names([
    'index' => 'roles.index',
    'create' => 'roles.create',
    'store' => 'roles.store',
    'edit' => 'roles.edit',
    'update' => 'roles.update',
    'destroy' => 'roles.destroy',
]);

// Permissions
Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');

// Settings
Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

