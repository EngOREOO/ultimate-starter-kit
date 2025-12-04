@extends('ultimate::layouts.admin')

@section('title', 'Permissions')

@section('content')
<div class="px-4 lg:px-6">
    <div class="overflow-hidden rounded-lg border">
        <div class="relative w-full overflow-x-auto" data-slot="table-container">
            <table class="w-full caption-bottom text-sm" data-slot="table">
                <thead class="[&_tr]:border-b bg-muted" data-slot="table-header">
                    <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors" data-slot="table-row">
                        <th class="text-foreground h-10 px-4 text-left align-middle font-medium whitespace-nowrap [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]" data-slot="table-head">Name</th>
                        <th class="text-foreground h-10 px-4 text-left align-middle font-medium whitespace-nowrap [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]" data-slot="table-head">Module</th>
                        <th class="text-foreground h-10 px-4 text-left align-middle font-medium whitespace-nowrap [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]" data-slot="table-head">Feature</th>
                        <th class="text-foreground h-10 px-4 text-left align-middle font-medium whitespace-nowrap [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]" data-slot="table-head">Action</th>
                    </tr>
                </thead>
                <tbody class="[&_tr:last-child]:border-0" data-slot="table-body">
                    @foreach($permissions as $permission)
                    <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors" data-slot="table-row">
                        <td class="p-4 align-middle whitespace-nowrap [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]" data-slot="table-cell">
                            <div class="font-medium">{{ $permission->name }}</div>
                        </td>
                        <td class="p-4 align-middle whitespace-nowrap [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]" data-slot="table-cell">
                            <span class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0">
                                {{ $permission->module_label }}
                            </span>
                        </td>
                        <td class="p-4 align-middle whitespace-nowrap [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]" data-slot="table-cell">
                            <div class="text-muted-foreground">{{ $permission->feature_label }}</div>
                        </td>
                        <td class="p-4 align-middle whitespace-nowrap [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]" data-slot="table-cell">
                            <div class="text-muted-foreground">{{ $permission->action_label }}</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="flex items-center justify-between px-4 py-4">
            <div class="text-muted-foreground hidden flex-1 text-sm lg:flex">
                Showing {{ $permissions->firstItem() ?? 0 }} to {{ $permissions->lastItem() ?? 0 }} of {{ $permissions->total() }} results
            </div>
            <div class="flex w-full items-center gap-8 lg:w-fit">
                <div class="flex w-fit items-center justify-center text-sm font-medium">
                    Page {{ $permissions->currentPage() }} of {{ $permissions->lastPage() }}
                </div>
                <div class="ml-auto flex items-center gap-2 lg:ml-0">
                    @if($permissions->onFirstPage())
                        <button class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-input bg-background shadow-xs hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 p-0 transition-colors disabled:pointer-events-none disabled:opacity-50" disabled data-slot="button">
                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                    @else
                        <a href="{{ $permissions->previousPageUrl() }}" class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-input bg-background shadow-xs hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 p-0 transition-colors" data-slot="button">
                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                    @endif
                    @if($permissions->hasMorePages())
                        <a href="{{ $permissions->nextPageUrl() }}" class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-input bg-background shadow-xs hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 p-0 transition-colors" data-slot="button">
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
