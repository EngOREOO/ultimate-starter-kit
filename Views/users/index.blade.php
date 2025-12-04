@extends('ultimate::layouts.admin')

@section('title', 'Users')

@section('content')
<div class="px-4 lg:px-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold">Users</h2>
        <a 
            href="{{ route('admin.users.create') }}" 
            class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2"
            data-slot="button"
        >
            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create User
        </a>
    </div>

    <div class="overflow-hidden rounded-lg border">
        <div class="relative w-full overflow-x-auto" data-slot="table-container">
            <table class="w-full caption-bottom text-sm" data-slot="table">
                <thead class="[&_tr]:border-b bg-muted" data-slot="table-header">
                    <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors" data-slot="table-row">
                        <th class="text-foreground h-10 px-4 text-left align-middle font-medium whitespace-nowrap [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]" data-slot="table-head">Name</th>
                        <th class="text-foreground h-10 px-4 text-left align-middle font-medium whitespace-nowrap [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]" data-slot="table-head">Email</th>
                        <th class="text-foreground h-10 px-4 text-left align-middle font-medium whitespace-nowrap [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]" data-slot="table-head">Roles</th>
                        <th class="text-foreground h-10 px-4 text-left align-middle font-medium whitespace-nowrap [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]" data-slot="table-head">Actions</th>
                    </tr>
                </thead>
                <tbody class="[&_tr:last-child]:border-0" data-slot="table-body">
                    @foreach($users as $user)
                    <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors" data-slot="table-row">
                        <td class="p-4 align-middle whitespace-nowrap [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]" data-slot="table-cell">
                            <div class="font-medium">{{ $user->name }}</div>
                        </td>
                        <td class="p-4 align-middle whitespace-nowrap [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]" data-slot="table-cell">
                            <div class="text-muted-foreground">{{ $user->email }}</div>
                        </td>
                        <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]" data-slot="table-cell">
                            <div class="flex flex-wrap gap-1">
                                @forelse($user->roles as $role)
                                    <span class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0">
                                        {{ $role->name }}
                                    </span>
                                @empty
                                    <span class="text-muted-foreground text-sm">No Role</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="p-4 align-middle whitespace-nowrap [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]" data-slot="table-cell">
                            <div class="flex items-center gap-2">
                                <a 
                                    href="{{ route('admin.users.edit', $user->id) }}" 
                                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] hover:bg-accent hover:text-accent-foreground dark:hover:bg-accent/50 h-8 px-3 text-muted-foreground"
                                    data-slot="button"
                                >
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] hover:bg-accent hover:text-accent-foreground dark:hover:bg-accent/50 h-8 px-3 text-destructive"
                                        data-slot="button"
                                    >
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="flex items-center justify-between px-4 py-4">
            <div class="text-muted-foreground hidden flex-1 text-sm lg:flex">
                Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} results
            </div>
            <div class="flex w-full items-center gap-8 lg:w-fit">
                <div class="flex w-fit items-center justify-center text-sm font-medium">
                    Page {{ $users->currentPage() }} of {{ $users->lastPage() }}
                </div>
                <div class="ml-auto flex items-center gap-2 lg:ml-0">
                    @if($users->onFirstPage())
                        <button class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-input bg-background shadow-xs hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 p-0 transition-colors disabled:pointer-events-none disabled:opacity-50" disabled data-slot="button">
                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-input bg-background shadow-xs hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 p-0 transition-colors" data-slot="button">
                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                    @endif
                    @if($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-input bg-background shadow-xs hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 p-0 transition-colors" data-slot="button">
                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @else
                        <button class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-input bg-background shadow-xs hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 p-0 transition-colors disabled:pointer-events-none disabled:opacity-50" disabled data-slot="button">
                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
