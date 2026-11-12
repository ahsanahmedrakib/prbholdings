<?php

use App\Models\Setting;

if (! function_exists('setting')) {
    function setting(string $key, mixed $default = null): mixed
    {
        return Setting::get($key, $default);
    }
}

if (! function_exists('media_url')) {
    function media_url(?string $path, ?string $fallback = null): string
    {
        if (filled($path)) {
            return asset($path);
        }

        return asset($fallback ?: 'uploads/placeholder.jpg');
    }
}

if (! function_exists('whatsapp_url')) {
    function whatsapp_url(?string $number = null, string $message = ''): string
    {
        $number = preg_replace('/[^0-9]/', '', $number ?: (string) setting('whatsapp', ''));

        return 'https://wa.me/'.$number.($message !== '' ? '?text='.urlencode($message) : '');
    }
}