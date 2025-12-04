<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'Laravel') }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased">
    <div 
        class="group/sidebar-wrapper has-data-[variant=inset]:bg-sidebar flex min-h-svh w-full"
        data-slot="sidebar-wrapper"
        style="--sidebar-width: 16rem; --sidebar-width-icon: 3rem;"
    >
        <!-- Sidebar -->
        <aside 
            class="group peer text-sidebar-foreground hidden md:block"
            data-state="expanded"
            data-collapsible=""
            data-variant="inset"
            data-side="left"
            data-slot="sidebar"
        >
            <!-- Sidebar Gap -->
            <div
                data-slot="sidebar-gap"
                class="relative w-[var(--sidebar-width)] bg-transparent transition-[width] duration-200 ease-linear group-data-[collapsible=offcanvas]:w-0 group-data-[side=right]:rotate-180 group-data-[collapsible=icon]:w-[calc(var(--sidebar-width-icon)+1rem)]"
            ></div>
            
            <!-- Sidebar Container -->
            <div
                data-slot="sidebar-container"
                class="fixed inset-y-0 z-10 hidden h-svh w-[var(--sidebar-width)] transition-[left,right,width] duration-200 ease-linear md:flex left-0 group-data-[collapsible=offcanvas]:left-[calc(var(--sidebar-width)*-1)] p-2 group-data-[collapsible=icon]:w-[calc(var(--sidebar-width-icon)+1rem+2px)]"
            >
                <div
                    data-sidebar="sidebar"
                    data-slot="sidebar-inner"
                    class="bg-sidebar group-data-[variant=floating]:border-sidebar-border flex h-full w-full flex-col group-data-[variant=floating]:rounded-lg group-data-[variant=floating]:border group-data-[variant=floating]:shadow-sm"
                >
                    <!-- Sidebar Header -->
                    <div class="flex flex-col gap-2 p-2" data-slot="sidebar-header">
                        <ul class="flex w-full min-w-0 flex-col gap-1" data-slot="sidebar-menu">
                            <li class="group/menu-item relative" data-slot="sidebar-menu-item">
                                <a 
                                    href="{{ route('admin.dashboard') }}"
                                    class="peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-md p-1.5 text-left text-sm outline-hidden ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 group-has-data-[sidebar=menu-action]/menu-item:pr-8 aria-disabled:pointer-events-none aria-disabled:opacity-50 data-[active=true]:bg-sidebar-accent data-[active=true]:font-medium data-[active=true]:text-sidebar-accent-foreground data-[state=open]:hover:bg-sidebar-accent data-[state=open]:hover:text-sidebar-accent-foreground group-data-[collapsible=icon]:size-8! group-data-[collapsible=icon]:p-2! [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0"
                                    data-slot="sidebar-menu-button"
                                    data-size="default"
                                >
                                    <svg class="size-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    <span class="text-base font-semibold group-data-[collapsible=icon]:hidden">StarterKit</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Sidebar Content -->
                    <div class="flex min-h-0 flex-1 flex-col gap-2 overflow-auto group-data-[collapsible=icon]:overflow-hidden" data-slot="sidebar-content">
                        <!-- Quick Create Section -->
                        <div class="relative flex w-full min-w-0 flex-col p-2" data-slot="sidebar-group">
                            <div class="w-full text-sm" data-slot="sidebar-group-content">
                                <ul class="flex w-full min-w-0 flex-col gap-1" data-slot="sidebar-menu">
                                    <li class="group/menu-item relative flex items-center gap-2" data-slot="sidebar-menu-item">
                                        <button
                                            class="peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-left text-sm outline-hidden ring-sidebar-ring transition-[width,height,padding] bg-primary text-primary-foreground hover:bg-primary/90 hover:text-primary-foreground active:bg-primary/90 active:text-primary-foreground min-w-8 duration-200 ease-linear group-data-[collapsible=icon]:size-8! group-data-[collapsible=icon]:p-2! [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0"
                                            data-slot="sidebar-menu-button"
                                        >
                                            <svg class="size-4 shrink-0" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
                                            </svg>
                                            <span class="group-data-[collapsible=icon]:hidden">Quick Create</span>
                                        </button>
                                        <button
                                            class="size-8 inline-flex items-center justify-center rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] border bg-background shadow-xs hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 group-data-[collapsible=icon]:opacity-0"
                                            data-slot="button"
                                        >
                                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="sr-only">Inbox</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Main Navigation -->
                        <div class="relative flex w-full min-w-0 flex-col p-2" data-slot="sidebar-group">
                            <div class="w-full text-sm" data-slot="sidebar-group-content">
                                <ul class="flex w-full min-w-0 flex-col gap-1" data-slot="sidebar-menu">
                                    @php
                                        $user = auth()->user();
                                        $permissions = [];
                                        if (method_exists($user, 'roles')) {
                                            foreach ($user->roles as $role) {
                                                $permissions = array_merge($permissions, $role->permissions->pluck('name')->toArray());
                                            }
                                        }
                                        $permissions = array_unique($permissions);
                                    @endphp

                                    <li class="group/menu-item relative" data-slot="sidebar-menu-item">
                                        <a 
                                            href="{{ route('admin.dashboard') }}"
                                            class="peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-left text-sm outline-hidden ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 group-has-data-[sidebar=menu-action]/menu-item:pr-8 aria-disabled:pointer-events-none aria-disabled:opacity-50 {{ request()->routeIs('admin.dashboard') ? 'bg-black text-white font-medium' : '' }} group-data-[collapsible=icon]:size-8! group-data-[collapsible=icon]:p-2! [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0"
                                            data-slot="sidebar-menu-button"
                                            data-active="{{ request()->routeIs('admin.dashboard') ? 'true' : 'false' }}"
                                        >
                                            <svg class="size-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                            </svg>
                                            <span class="group-data-[collapsible=icon]:hidden">Dashboard</span>
                                        </a>
                                    </li>

                                    @if(method_exists($user, 'hasPermission') && ($user->hasPermission('admin.users.index') || $user->isSuperAdmin()))
                                    <li class="group/menu-item relative" data-slot="sidebar-menu-item">
                                        <a 
                                            href="{{ route('admin.users.index') }}"
                                            class="peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-left text-sm outline-hidden ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 group-has-data-[sidebar=menu-action]/menu-item:pr-8 aria-disabled:pointer-events-none aria-disabled:opacity-50 {{ request()->routeIs('admin.users.*') ? 'bg-black text-white font-medium' : '' }} group-data-[collapsible=icon]:size-8! group-data-[collapsible=icon]:p-2! [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0"
                                            data-slot="sidebar-menu-button"
                                            data-active="{{ request()->routeIs('admin.users.*') ? 'true' : 'false' }}"
                                        >
                                            <svg class="size-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                            </svg>
                                            <span class="group-data-[collapsible=icon]:hidden">Users</span>
                                        </a>
                                    </li>
                                    @endif

                                    @if(method_exists($user, 'hasPermission') && ($user->hasPermission('admin.roles.index') || $user->isSuperAdmin()))
                                    <li class="group/menu-item relative" data-slot="sidebar-menu-item">
                                        <a 
                                            href="{{ route('admin.roles.index') }}"
                                            class="peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-left text-sm outline-hidden ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 group-has-data-[sidebar=menu-action]/menu-item:pr-8 aria-disabled:pointer-events-none aria-disabled:opacity-50 {{ request()->routeIs('admin.roles.*') ? 'bg-black text-white font-medium' : '' }} group-data-[collapsible=icon]:size-8! group-data-[collapsible=icon]:p-2! [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0"
                                            data-slot="sidebar-menu-button"
                                            data-active="{{ request()->routeIs('admin.roles.*') ? 'true' : 'false' }}"
                                        >
                                            <svg class="size-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h-2A4 4 0 0111 16V8a4 4 0 014-4h2a4 4 0 014 4v8a4 4 0 01-4 4z"></path>
                                            </svg>
                                            <span class="group-data-[collapsible=icon]:hidden">Roles</span>
                                        </a>
                                    </li>
                                    @endif

                                    @if(method_exists($user, 'hasPermission') && ($user->hasPermission('admin.permissions.index') || $user->isSuperAdmin()))
                                    <li class="group/menu-item relative" data-slot="sidebar-menu-item">
                                        <a 
                                            href="{{ route('admin.permissions.index') }}"
                                            class="peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-left text-sm outline-hidden ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 group-has-data-[sidebar=menu-action]/menu-item:pr-8 aria-disabled:pointer-events-none aria-disabled:opacity-50 {{ request()->routeIs('admin.permissions.*') ? 'bg-black text-white font-medium' : '' }} group-data-[collapsible=icon]:size-8! group-data-[collapsible=icon]:p-2! [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0"
                                            data-slot="sidebar-menu-button"
                                            data-active="{{ request()->routeIs('admin.permissions.*') ? 'true' : 'false' }}"
                                        >
                                            <svg class="size-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V9a2 2 0 012-2h2z"></path>
                                            </svg>
                                            <span class="group-data-[collapsible=icon]:hidden">Permissions</span>
                                        </a>
                                    </li>
                                    @endif

                                </ul>
                            </div>
                        </div>

                        <!-- Secondary Navigation -->
                        <div class="relative flex w-full min-w-0 flex-col p-2 mt-auto" data-slot="sidebar-group">
                            <div class="w-full text-sm" data-slot="sidebar-group-content">
                                <ul class="flex w-full min-w-0 flex-col gap-1" data-slot="sidebar-menu">
                                    <li class="group/menu-item relative" data-slot="sidebar-menu-item">
                                        <a 
                                            href="{{ route('admin.profile.edit') }}"
                                            class="peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-left text-sm outline-hidden ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 group-has-data-[sidebar=menu-action]/menu-item:pr-8 aria-disabled:pointer-events-none aria-disabled:opacity-50 {{ request()->routeIs('admin.profile.*') ? 'bg-black text-white font-medium' : '' }} group-data-[collapsible=icon]:size-8! group-data-[collapsible=icon]:p-2! [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0"
                                            data-slot="sidebar-menu-button"
                                        >
                                            <svg class="size-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <span class="group-data-[collapsible=icon]:hidden">Profile</span>
                                        </a>
                                    </li>
                                    <li class="group/menu-item relative" data-slot="sidebar-menu-item">
                                        <a 
                                            href="{{ route('admin.settings.index') }}"
                                            class="peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-left text-sm outline-hidden ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 group-has-data-[sidebar=menu-action]/menu-item:pr-8 aria-disabled:pointer-events-none aria-disabled:opacity-50 {{ request()->routeIs('admin.settings.*') ? 'bg-black text-white font-medium' : '' }} group-data-[collapsible=icon]:size-8! group-data-[collapsible=icon]:p-2! [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0"
                                            data-slot="sidebar-menu-button"
                                        >
                                            <svg class="size-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="group-data-[collapsible=icon]:hidden">Settings</span>
                                        </a>
                                    </li>
                                    <li class="group/menu-item relative" data-slot="sidebar-menu-item">
                                        <a 
                                            href="https://github.com/help" 
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-left text-sm outline-hidden ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 group-has-data-[sidebar=menu-action]/menu-item:pr-8 aria-disabled:pointer-events-none aria-disabled:opacity-50 group-data-[collapsible=icon]:size-8! group-data-[collapsible=icon]:p-2! [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0"
                                            data-slot="sidebar-menu-button"
                                        >
                                            <svg class="size-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="group-data-[collapsible=icon]:hidden">Get Help</span>
                                        </a>
                                    </li>
                                    <li class="group/menu-item relative" data-slot="sidebar-menu-item">
                                        <button
                                            onclick="document.getElementById('search-modal').classList.remove('hidden')"
                                            class="peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-left text-sm outline-hidden ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 group-has-data-[sidebar=menu-action]/menu-item:pr-8 aria-disabled:pointer-events-none aria-disabled:opacity-50 group-data-[collapsible=icon]:size-8! group-data-[collapsible=icon]:p-2! [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0"
                                            data-slot="sidebar-menu-button"
                                        >
                                            <svg class="size-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                            <span class="group-data-[collapsible=icon]:hidden">Search</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Footer -->
                    <div class="flex flex-col gap-2 p-2" data-slot="sidebar-footer">
                        <ul class="flex w-full min-w-0 flex-col gap-1" data-slot="sidebar-menu">
                            <li class="group/menu-item relative" data-slot="sidebar-menu-item">
                                <div class="relative">
                                    <button
                                        onclick="document.getElementById('user-menu').classList.toggle('hidden')"
                                        class="peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-md p-3 text-left text-sm outline-hidden ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 group-has-data-[sidebar=menu-action]/menu-item:pr-8 aria-disabled:pointer-events-none aria-disabled:opacity-50 data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground group-data-[collapsible=icon]:size-8! group-data-[collapsible=icon]:p-2! [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0"
                                        data-slot="sidebar-menu-button"
                                        data-size="lg"
                                    >
                                        <div class="h-8 w-8 rounded-lg bg-sidebar-primary flex items-center justify-center text-sidebar-primary-foreground text-sm font-medium shrink-0">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                        </div>
                                        <div class="grid flex-1 text-left text-sm leading-tight min-w-0">
                                            <span class="truncate font-medium">{{ auth()->user()->name }}</span>
                                            <span class="text-muted-foreground truncate text-xs">{{ auth()->user()->email }}</span>
                                        </div>
                                        <svg class="ml-auto size-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                        </svg>
                                    </button>
                                    <div id="user-menu" class="hidden absolute bottom-full left-0 mb-2 w-full bg-popover text-popover-foreground rounded-lg border shadow-md p-1 z-50">
                                        <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-2 rounded-sm px-2 py-1.5 text-sm hover:bg-accent hover:text-accent-foreground">
                                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            Account
                                        </a>
                                        <a href="{{ route('admin.profile.password.edit') }}" class="flex items-center gap-2 rounded-sm px-2 py-1.5 text-sm hover:bg-accent hover:text-accent-foreground">
                                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                            </svg>
                                            Change Password
                                        </a>
                                        <div class="border-t my-1"></div>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="w-full flex items-center gap-2 rounded-sm px-2 py-1.5 text-sm hover:bg-accent hover:text-accent-foreground text-destructive">
                                                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                                </svg>
                                                Log out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main 
            class="bg-background relative flex w-full flex-1 flex-col md:peer-data-[variant=inset]:m-2 md:peer-data-[variant=inset]:ml-0 md:peer-data-[variant=inset]:rounded-xl md:peer-data-[variant=inset]:shadow-sm md:peer-data-[variant=inset]:peer-data-[state=collapsed]:ml-2"
            data-slot="sidebar-inset"
        >
            <!-- Header -->
            <header class="flex h-12 shrink-0 items-center gap-2 border-b transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12" style="--header-height: 3rem;">
                <div class="flex w-full items-center gap-1 px-4 lg:gap-2 lg:px-6">
                    <button
                        class="size-7 inline-flex items-center justify-center rounded-md outline-hidden ring-sidebar-ring transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:ring-2 -ml-1"
                        data-sidebar="trigger"
                        data-slot="sidebar-trigger"
                    >
                        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <span class="sr-only">Toggle Sidebar</span>
                    </button>
                    <div class="mx-2 h-4 w-px bg-border" data-orientation="vertical"></div>
                    <h1 class="text-base font-medium">@yield('title', 'Dashboard')</h1>
                    <div class="ml-auto flex items-center gap-2">
                        <a 
                            href="https://github.com" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="inline-flex items-center justify-center rounded-md text-sm font-medium outline-hidden ring-sidebar-ring transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:ring-2 h-8 px-3 dark:text-foreground"
                            data-slot="button"
                        >
                            GitHub
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button 
                                type="submit"
                                class="inline-flex items-center justify-center rounded-md text-sm font-medium outline-hidden ring-sidebar-ring transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:ring-2 h-8 px-3"
                                data-slot="button"
                            >
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="flex flex-1 flex-col">
                <div class="@container/main flex flex-1 flex-col gap-2">
                    <div class="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
                        @if(session('success'))
                            <div class="mx-4 lg:mx-6 mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mx-4 lg:mx-6 mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                                {{ session('error') }}
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Search Modal -->
    <div id="search-modal" class="hidden fixed inset-0 z-50 flex items-start justify-center pt-20 bg-black/50" onclick="if(event.target === this) document.getElementById('search-modal').classList.add('hidden')">
        <div class="bg-background rounded-lg border shadow-lg w-full max-w-2xl mx-4" onclick="event.stopPropagation()">
            <div class="p-4 border-b">
                <div class="flex items-center gap-2">
                    <svg class="size-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input 
                        type="text" 
                        placeholder="Search..." 
                        class="flex-1 outline-none bg-transparent text-base"
                        autofocus
                    >
                    <button 
                        onclick="document.getElementById('search-modal').classList.add('hidden')"
                        class="text-muted-foreground hover:text-foreground"
                    >
                        <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="p-4">
                <p class="text-sm text-muted-foreground">Start typing to search...</p>
            </div>
        </div>
    </div>

    <script>
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const userMenu = document.getElementById('user-menu');
            if (userMenu && !userMenu.contains(event.target) && !event.target.closest('[onclick*="user-menu"]')) {
                userMenu.classList.add('hidden');
            }
        });

        // Close search modal on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const searchModal = document.getElementById('search-modal');
                if (searchModal && !searchModal.classList.contains('hidden')) {
                    searchModal.classList.add('hidden');
                }
            }
        });

        // Sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector('[data-slot="sidebar-wrapper"]');
            const sidebarTrigger = document.querySelector('[data-sidebar="trigger"]');
            const sidebar = document.querySelector('[data-slot="sidebar"]');
            
            let isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
            
            function toggleSidebar() {
                isCollapsed = !isCollapsed;
                localStorage.setItem('sidebar-collapsed', isCollapsed);
                
                if (isCollapsed) {
                    sidebar.setAttribute('data-collapsible', 'icon');
                    sidebar.setAttribute('data-state', 'collapsed');
                } else {
                    sidebar.setAttribute('data-collapsible', '');
                    sidebar.setAttribute('data-state', 'expanded');
                }
            }
            
            if (isCollapsed) {
                sidebar.setAttribute('data-collapsible', 'icon');
                sidebar.setAttribute('data-state', 'collapsed');
            }
            
            if (sidebarTrigger) {
                sidebarTrigger.addEventListener('click', toggleSidebar);
            }
        });
    </script>
</body>
</html>
