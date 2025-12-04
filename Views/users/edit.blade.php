@extends('ultimate::layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="px-4 lg:px-6">
    <div 
        data-slot="card"
        class="bg-card text-card-foreground flex flex-col gap-6 rounded-xl border py-6 shadow-sm {{ $isSuperAdmin ? 'max-w-4xl' : 'max-w-2xl' }}"
    >
        <div 
            data-slot="card-header"
            class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-2 px-6"
        >
            <div data-slot="card-title" class="leading-none font-semibold text-2xl">Edit User</div>
        </div>

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="px-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <div class="flex flex-col gap-2">
                    <label for="name" class="flex items-center gap-2 text-sm leading-none font-medium select-none">
                        Name
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name', $user->name) }}" 
                        required
                        class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                        data-slot="input"
                    >
                    @error('name')
                        <p class="text-sm text-destructive">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex flex-col gap-2">
                    <label for="email" class="flex items-center gap-2 text-sm leading-none font-medium select-none">
                        Email
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', $user->email) }}" 
                        required
                        class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                        data-slot="input"
                    >
                    @error('email')
                        <p class="text-sm text-destructive">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex flex-col gap-2">
                    <label for="password" class="flex items-center gap-2 text-sm leading-none font-medium select-none">
                        New Password (leave blank to keep current)
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                        data-slot="input"
                    >
                    @error('password')
                        <p class="text-sm text-destructive">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex flex-col gap-2">
                    <label for="password_confirmation" class="flex items-center gap-2 text-sm leading-none font-medium select-none">
                        Confirm New Password
                    </label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation"
                        class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                        data-slot="input"
                    >
                </div>
                
                <div class="flex flex-col gap-2">
                    <label class="flex items-center gap-2 text-sm leading-none font-medium select-none">
                        Roles
                    </label>
                    <div class="space-y-2">
                        @foreach($roles as $role)
                        <label class="flex items-center gap-2">
                            <input 
                                type="checkbox" 
                                name="roles[]" 
                                value="{{ $role->id }}" 
                                {{ in_array($role->id, $userRoles) ? 'checked' : '' }}
                                class="peer border-input dark:bg-input/30 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground dark:data-[state=checked]:bg-primary data-[state=checked]:border-primary focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive size-4 shrink-0 rounded-[4px] border shadow-xs transition-shadow outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50"
                                data-slot="checkbox"
                            >
                            <span class="text-sm">{{ $role->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                @if($isSuperAdmin)
                <div class="flex flex-col gap-2">
                    <label class="flex items-center gap-2 text-sm leading-none font-medium select-none">
                        Direct Permissions
                        <span class="text-xs text-muted-foreground font-normal">(Super Admin Only)</span>
                    </label>
                    <div class="border rounded-md p-4 max-h-96 overflow-y-auto">
                        @foreach($permissions as $module => $modulePermissions)
                        <div class="mb-6">
                            <h4 class="font-semibold mb-2">{{ config("ultimate.modules.{$module}", ucfirst($module)) }}</h4>
                            @foreach($modulePermissions->groupBy('feature') as $feature => $featurePermissions)
                            <div class="ml-4 mb-3">
                                <h5 class="text-sm font-medium text-muted-foreground mb-1">{{ ucfirst($feature) }}</h5>
                                <div class="ml-4 space-y-1">
                                    @foreach($featurePermissions as $permission)
                                    <label class="flex items-center gap-2">
                                        <input 
                                            type="checkbox" 
                                            name="permissions[]" 
                                            value="{{ $permission->id }}" 
                                            {{ in_array($permission->id, $userDirectPermissions) ? 'checked' : '' }}
                                            class="peer border-input dark:bg-input/30 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground dark:data-[state=checked]:bg-primary data-[state=checked]:border-primary focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive size-4 shrink-0 rounded-[4px] border shadow-xs transition-shadow outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50"
                                            data-slot="checkbox"
                                        >
                                        <span class="text-sm text-muted-foreground">{{ $permission->action_label }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            <div 
                data-slot="card-footer"
                class="flex items-center justify-end gap-2 px-6 mt-6"
            >
                <a 
                    href="{{ route('admin.users.index') }}" 
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] border bg-background shadow-xs hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 h-9 px-4 py-2"
                    data-slot="button"
                >
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2"
                    data-slot="button"
                >
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
