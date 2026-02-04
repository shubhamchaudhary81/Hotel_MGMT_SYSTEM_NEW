<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.settings.index', compact('setting'));
    }

    public function store(Request $request)
    {
        $setting = new Setting();
        $this->saveSettingData($request, $setting);

        return back()->with('success', 'Settings saved successfully');
    }

    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);
        $this->saveSettingData($request, $setting);

        return back()->with('success', 'Settings updated successfully');
    }

    /**
     * Handles all fields including theme colors.
     */
    private function saveSettingData(Request $request, Setting $setting)
    {
        // VALIDATION
        $validated = $request->validate([
            'app_name' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',

            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'contact_address' => 'nullable|string|max:255',

            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',

            // 🎨 THEME COLORS
            'primary_color' => 'nullable|string|max:20',
            'primary_hover' => 'nullable|string|max:20',
            'accent_color' => 'nullable|string|max:20',
            'accent_hover' => 'nullable|string|max:20',

            'sidebar_bg' => 'nullable|string|max:20',
            'sidebar_text' => 'nullable|string|max:20',
            'sidebar_hover_bg' => 'nullable|string|max:20',
            'sidebar_active_bg' => 'nullable|string|max:20',
            'sidebar_active_text' => 'nullable|string|max:20',

            'table_header_bg' => 'nullable|string|max:20',
            'table_border' => 'nullable|string|max:20',


            'app_logo' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'favicon' => 'nullable|image|mimes:png,jpg,jpeg,webp,ico|max:512',
        ]);

        // =====================
        // LOGO UPLOAD
        // =====================
        if ($request->hasFile('app_logo')) {
            $logoPath = $request->file('app_logo')->store('uploads/settings', 'public');
            $validated['app_logo'] = 'storage/' . $logoPath;

            // delete old logo if exists
            if ($setting->app_logo && file_exists(public_path($setting->app_logo))) {
                @unlink(public_path($setting->app_logo));
            }
        }

        // =====================
        // FAVICON UPLOAD
        // =====================
        if ($request->hasFile('favicon')) {
            $faviconPath = $request->file('favicon')->store('uploads/settings', 'public');
            $validated['favicon'] = 'storage/' . $faviconPath;

            if ($setting->favicon && file_exists(public_path($setting->favicon))) {
                @unlink(public_path($setting->favicon));
            }
        }

        // HANDLE CHECKBOX
        $validated['maintenance_mode'] = $request->has('maintenance_mode') ? 1 : 0;

        // SAVE EVERYTHING
        $setting->update($validated);
    }
}
