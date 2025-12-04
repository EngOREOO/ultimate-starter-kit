@extends('ultimate::layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="px-4 lg:px-6">
    <div 
        data-slot="card"
        class="bg-card text-card-foreground flex flex-col gap-6 rounded-xl border py-6 shadow-sm max-w-4xl"
    >
        <div 
            data-slot="card-header"
            class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-2 px-6"
        >
            <div data-slot="card-title" class="leading-none font-semibold text-2xl">Settings</div>
            <div data-slot="card-description" class="text-muted-foreground text-sm">
                Manage your application settings
            </div>
        </div>

        <form method="POST" action="{{ route('admin.settings.update') }}" class="px-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                @foreach($settings as $index => $setting)
                <div class="flex flex-col gap-2 border-b pb-4 last:border-0">
                    <input type="hidden" name="settings[{{ $index }}][key]" value="{{ $setting->key }}">
                    <input type="hidden" name="settings[{{ $index }}][type]" value="{{ $setting->type }}">
                    
                    <label class="flex items-center gap-2 text-sm leading-none font-medium select-none">
                        {{ $setting->key }}
                        @if($setting->description)
                        <span class="text-xs text-muted-foreground font-normal">({{ $setting->description }})</span>
                        @endif
                    </label>
                    
                    @if($setting->type === 'boolean')
                    <select 
                        name="settings[{{ $index }}][value]" 
                        class="border-input data-[placeholder]:text-muted-foreground [&_svg:not([class*='text-'])]:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive dark:bg-input/30 dark:hover:bg-input/50 flex w-full items-center justify-between gap-2 rounded-md border bg-transparent px-3 py-2 text-sm whitespace-nowrap shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50 h-9"
                        data-slot="select-trigger"
                    >
                        <option value="1" {{ $setting->value === '1' ? 'selected' : '' }}>True</option>
                        <option value="0" {{ $setting->value === '0' ? 'selected' : '' }}>False</option>
                    </select>
                    @elseif($setting->type === 'json')
                    <textarea 
                        name="settings[{{ $index }}][value]" 
                        rows="3"
                        class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input min-h-[60px] w-full min-w-0 rounded-md border bg-transparent px-3 py-2 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                        data-slot="textarea"
                    >{{ $setting->value }}</textarea>
                    @else
                    <input 
                        type="{{ $setting->type === 'integer' ? 'number' : 'text' }}" 
                        name="settings[{{ $index }}][value]" 
                        value="{{ $setting->value }}" 
                        class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                        data-slot="input"
                    >
                    @endif
                    
                    <input 
                        type="text" 
                        name="settings[{{ $index }}][description]" 
                        value="{{ $setting->description }}" 
                        placeholder="Description (optional)" 
                        class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] mt-2"
                        data-slot="input"
                    >
                </div>
                @endforeach
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
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
