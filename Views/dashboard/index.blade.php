@extends('ultimate::layouts.admin')

@section('title', 'Dashboard')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 gap-4 px-4 lg:px-6 @xl/main:grid-cols-2 @5xl/main:grid-cols-4">
    <!-- Total Users Card -->
    <div 
        data-slot="card"
        class="bg-card text-card-foreground flex flex-col gap-6 rounded-xl border py-6 shadow-sm @container/card"
    >
        <div 
            data-slot="card-header"
            class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-2 px-6 has-data-[slot=card-action]:grid-cols-[1fr_auto]"
        >
            <div data-slot="card-description" class="text-muted-foreground text-sm">Total Users</div>
            <div data-slot="card-title" class="leading-none font-semibold text-2xl tabular-nums @[250px]/card:text-3xl">
                {{ \App\Models\User::count() }}
            </div>
            <div 
                data-slot="card-action"
                class="col-start-2 row-span-2 row-start-1 self-start justify-self-end"
            >
                <span class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 gap-1">
                    <svg class="size-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    Active
                </span>
            </div>
        </div>
        <div 
            data-slot="card-footer"
            class="flex items-center px-6"
        >
            <div class="flex flex-col items-start gap-1.5 text-sm">
                <div class="line-clamp-1 flex gap-2 font-medium">
                    All registered users
                </div>
                <div class="text-muted-foreground">
                    Manage users from Users section
                </div>
            </div>
        </div>
    </div>

    <!-- Total Roles Card -->
    <div 
        data-slot="card"
        class="bg-card text-card-foreground flex flex-col gap-6 rounded-xl border py-6 shadow-sm @container/card"
    >
        <div 
            data-slot="card-header"
            class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-2 px-6 has-data-[slot=card-action]:grid-cols-[1fr_auto]"
        >
            <div data-slot="card-description" class="text-muted-foreground text-sm">Total Roles</div>
            <div data-slot="card-title" class="leading-none font-semibold text-2xl tabular-nums @[250px]/card:text-3xl">
                {{ \Vendor\UltimateStarterKit\Models\Role::count() }}
            </div>
            <div 
                data-slot="card-action"
                class="col-start-2 row-span-2 row-start-1 self-start justify-self-end"
            >
                <span class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 gap-1">
                    <svg class="size-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    Secure
                </span>
            </div>
        </div>
        <div 
            data-slot="card-footer"
            class="flex items-center px-6"
        >
            <div class="flex flex-col items-start gap-1.5 text-sm">
                <div class="line-clamp-1 flex gap-2 font-medium">
                    Role-based access control
                </div>
                <div class="text-muted-foreground">
                    Configure roles and permissions
                </div>
            </div>
        </div>
    </div>

    <!-- Total Permissions Card -->
    <div 
        data-slot="card"
        class="bg-card text-card-foreground flex flex-col gap-6 rounded-xl border py-6 shadow-sm @container/card"
    >
        <div 
            data-slot="card-header"
            class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-2 px-6 has-data-[slot=card-action]:grid-cols-[1fr_auto]"
        >
            <div data-slot="card-description" class="text-muted-foreground text-sm">Total Permissions</div>
            <div data-slot="card-title" class="leading-none font-semibold text-2xl tabular-nums @[250px]/card:text-3xl">
                {{ \Vendor\UltimateStarterKit\Models\Permission::count() }}
            </div>
            <div 
                data-slot="card-action"
                class="col-start-2 row-span-2 row-start-1 self-start justify-self-end"
            >
                <span class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 gap-1">
                    <svg class="size-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    Protected
                </span>
            </div>
        </div>
        <div 
            data-slot="card-footer"
            class="flex items-center px-6"
        >
            <div class="flex flex-col items-start gap-1.5 text-sm">
                <div class="line-clamp-1 flex gap-2 font-medium">
                    Fine-grained access control
                </div>
                <div class="text-muted-foreground">
                    View all permissions
                </div>
            </div>
        </div>
    </div>

    <!-- Active Sessions Card -->
    <div 
        data-slot="card"
        class="bg-card text-card-foreground flex flex-col gap-6 rounded-xl border py-6 shadow-sm @container/card"
    >
        <div 
            data-slot="card-header"
            class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-2 px-6 has-data-[slot=card-action]:grid-cols-[1fr_auto]"
        >
            <div data-slot="card-description" class="text-muted-foreground text-sm">Active Sessions</div>
            <div data-slot="card-title" class="leading-none font-semibold text-2xl tabular-nums @[250px]/card:text-3xl">
                1
            </div>
            <div 
                data-slot="card-action"
                class="col-start-2 row-span-2 row-start-1 self-start justify-self-end"
            >
                <span class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 gap-1">
                    <svg class="size-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Online
                </span>
            </div>
        </div>
        <div 
            data-slot="card-footer"
            class="flex items-center px-6"
        >
            <div class="flex flex-col items-start gap-1.5 text-sm">
                <div class="line-clamp-1 flex gap-2 font-medium">
                    You are currently logged in
                </div>
                <div class="text-muted-foreground">
                    Session management
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="px-4 lg:px-6 mt-6">
    <div 
        data-slot="card"
        class="bg-card text-card-foreground flex flex-col gap-6 rounded-xl border py-6 shadow-sm"
    >
        <div 
            data-slot="card-header"
            class="px-6"
        >
            <div data-slot="card-title" class="leading-none font-semibold text-xl">Quick Actions</div>
            <div data-slot="card-description" class="text-muted-foreground text-sm mt-1">
                Common tasks and shortcuts
            </div>
        </div>
        <div 
            data-slot="card-content"
            class="px-6"
        >
            <div class="grid grid-cols-1 gap-4 @md/main:grid-cols-2 @lg/main:grid-cols-4">
                @if(method_exists(auth()->user(), 'hasPermission') && (auth()->user()->hasPermission('admin.users.create') || auth()->user()->isSuperAdmin()))
                <a 
                    href="{{ route('admin.users.create') }}" 
                    class="flex items-center gap-3 p-4 rounded-lg border hover:bg-accent hover:text-accent-foreground transition-colors"
                >
                    <div class="h-10 w-10 rounded-lg bg-primary/10 flex items-center justify-center">
                        <svg class="size-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium">Create User</div>
                        <div class="text-sm text-muted-foreground">Add a new user</div>
                    </div>
                </a>
                @endif

                @if(method_exists(auth()->user(), 'hasPermission') && (auth()->user()->hasPermission('admin.roles.create') || auth()->user()->isSuperAdmin()))
                <a 
                    href="{{ route('admin.roles.create') }}" 
                    class="flex items-center gap-3 p-4 rounded-lg border hover:bg-accent hover:text-accent-foreground transition-colors"
                >
                    <div class="h-10 w-10 rounded-lg bg-primary/10 flex items-center justify-center">
                        <svg class="size-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium">Create Role</div>
                        <div class="text-sm text-muted-foreground">Define a new role</div>
                    </div>
                </a>
                @endif

                <a 
                    href="{{ route('admin.profile.edit') }}" 
                    class="flex items-center gap-3 p-4 rounded-lg border hover:bg-accent hover:text-accent-foreground transition-colors"
                >
                    <div class="h-10 w-10 rounded-lg bg-primary/10 flex items-center justify-center">
                        <svg class="size-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium">Edit Profile</div>
                        <div class="text-sm text-muted-foreground">Update your information</div>
                    </div>
                </a>

                <a 
                    href="{{ route('admin.settings.index') }}" 
                    class="flex items-center gap-3 p-4 rounded-lg border hover:bg-accent hover:text-accent-foreground transition-colors"
                >
                    <div class="h-10 w-10 rounded-lg bg-primary/10 flex items-center justify-center">
                        <svg class="size-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium">Settings</div>
                        <div class="text-sm text-muted-foreground">Configure application</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="px-4 lg:px-6 mt-6">
    <div 
        data-slot="card"
        class="bg-card text-card-foreground flex flex-col gap-6 rounded-xl border py-6 shadow-sm"
    >
        <div 
            data-slot="card-header"
            class="px-6"
        >
            <div data-slot="card-title" class="leading-none font-semibold text-xl">Recent Activity</div>
            <div data-slot="card-description" class="text-muted-foreground text-sm mt-1">
                Latest system events and updates
            </div>
        </div>
        <div 
            data-slot="card-content"
            class="px-6"
        >
            <div class="space-y-4">
                <div class="flex items-start gap-4 p-4 rounded-lg border">
                    <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="size-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="font-medium">System Initialized</div>
                        <div class="text-sm text-muted-foreground">Ultimate Starter Kit has been successfully installed and configured.</div>
                        <div class="text-xs text-muted-foreground mt-1">{{ now()->format('M d, Y') }}</div>
                    </div>
                </div>
                <div class="flex items-start gap-4 p-4 rounded-lg border">
                    <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="size-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="font-medium">User Management Ready</div>
                        <div class="text-sm text-muted-foreground">You can now manage users, roles, and permissions from the admin panel.</div>
                        <div class="text-xs text-muted-foreground mt-1">{{ now()->subDays(1)->format('M d, Y') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
