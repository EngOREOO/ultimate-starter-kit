@extends('ultimate::layouts.admin')

@section('title', 'Edit Profile')

@section('content')
<div class="px-4 lg:px-6">
    <div 
        data-slot="card"
        class="bg-card text-card-foreground flex flex-col gap-6 rounded-xl border py-6 shadow-sm max-w-2xl"
    >
        <div 
            data-slot="card-header"
            class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-2 px-6"
        >
            <div data-slot="card-title" class="leading-none font-semibold text-2xl">Edit Profile</div>
        </div>

        <form method="POST" action="{{ route('admin.profile.update') }}" class="px-6">
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
            </div>
            
            <div 
                data-slot="card-footer"
                class="flex items-center justify-end gap-2 px-6 mt-6"
            >
                <button 
                    type="submit" 
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2"
                    data-slot="button"
                >
                    Update Profile
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
