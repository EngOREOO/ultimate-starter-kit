<?php

namespace Vendor\UltimateStarterKit\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vendor\UltimateStarterKit\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of permissions.
     */
    public function index()
    {
        $permissions = Permission::orderBy('module')
            ->orderBy('feature')
            ->orderBy('action')
            ->paginate(50);

        return view('ultimate::permissions.index', compact('permissions'));
    }
}

