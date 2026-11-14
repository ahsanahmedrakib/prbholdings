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
    /**
     * Page banner image settings, keyed by setting name.
     */
    public const BANNERS = [
        'banner_image' => 'Default banner (fallback for every page)',
        'banner_image_about' => 'About page',
        'banner_image_team' => 'Our Team page',
        'banner_image_projects' => 'Projects page',
        'banner_image_gallery' => 'Gallery page',
        'banner_image_contact' => 'Contact page',
        'banner_image_privacy' => 'Privacy Policy page',
    ];

    public function edit(): View
    {
        $settings = Setting::query()->orderBy('group')->orderBy('id')->get()->groupBy('group');
        $banners = self::BANNERS;

        return view('admin.settings.edit', compact('settings', 'banners'));
    }

    public function update(Request $request): RedirectResponse
    {
        $rules = [
            'settings' => ['nullable', 'array'],
            'settings.*' => ['nullable', 'string'],
            'about_image_main_file' => ['nullable', 'image', 'max:6144'],
            'about_image_secondary_file' => ['nullable', 'image', 'max:6144'],
        ];

        foreach (array_keys(self::BANNERS) as $key) {
            $rules[$key.'_file'] = ['nullable', 'image', 'max:6144'];
        }

        $request->validate($rules);

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

        foreach (array_keys(self::BANNERS) as $key) {
            if ($request->hasFile($key.'_file')) {
                ImageUpload::delete(Setting::get($key));
                Setting::put($key, ImageUpload::store($request->file($key.'_file'), 'settings', $key), 'banner');
            }
        }

        Setting::flush();

        return redirect()->route('admin.settings.edit')->with('success', 'Site settings updated successfully.');
    }
}
