<?php

namespace Vendor\UltimateStarterKit\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vendor\UltimateStarterKit\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        $settings = Setting::orderBy('key')->get();
        return view('ultimate::settings.index', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings' => ['required', 'array'],
            'settings.*.key' => ['required', 'string'],
            'settings.*.value' => ['nullable'],
            'settings.*.type' => ['required', 'string', 'in:string,integer,boolean,json'],
            'settings.*.description' => ['nullable', 'string'],
        ]);

        foreach ($validated['settings'] as $settingData) {
            Setting::updateOrCreate(
                ['key' => $settingData['key']],
                [
                    'value' => is_array($settingData['value']) || is_object($settingData['value'])
                        ? json_encode($settingData['value'])
                        : (string) ($settingData['value'] ?? ''),
                    'type' => $settingData['type'],
                    'description' => $settingData['description'] ?? null,
                ]
            );
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}

