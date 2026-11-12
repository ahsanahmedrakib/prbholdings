<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Support\ImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        $settings = Setting::query()->orderBy('group')->orderBy('id')->get()->groupBy('group');

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'settings' => ['nullable', 'array'],
            'settings.*' => ['nullable', 'string'],
            'about_image_main_file' => ['nullable', 'image', 'max:6144'],
            'about_image_secondary_file' => ['nullable', 'image', 'max:6144'],
        ]);

        foreach ((array) $request->input('settings', []) as $key => $value) {
            $setting = Setting::where('key', $key)->first();

            if ($setting) {
                $setting->update(['value' => $value]);
            }
        }

        if ($request->hasFile('about_image_main_file')) {
            ImageUpload::delete(Setting::get('about_image_main'));
            Setting::put('about_image_main', ImageUpload::store($request->file('about_image_main_file'), 'settings', 'about-main'), 'about');
        }

        if ($request->hasFile('about_image_secondary_file')) {
            ImageUpload::delete(Setting::get('about_image_secondary'));
            Setting::put('about_image_secondary', ImageUpload::store($request->file('about_image_secondary_file'), 'settings', 'about-secondary'), 'about');
        }

        Setting::flush();

        return redirect()->route('admin.settings.edit')->with('success', 'Site settings updated successfully.');
    }
}