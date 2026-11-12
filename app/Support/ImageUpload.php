<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageUpload
{
    public static function store(?UploadedFile $file, string $folder, string $prefix = 'image'): ?string
    {
        if (! $file) {
            return null;
        }

        $directory = 'uploads/'.trim($folder, '/');
        $absoluteDirectory = public_path($directory);

        if (! is_dir($absoluteDirectory)) {
            mkdir($absoluteDirectory, 0755, true);
        }

        $extension = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'jpg');
        $name = Str::slug($prefix).'-'.now()->format('YmdHis').'-'.Str::lower(Str::random(6)).'.'.$extension;

        $file->move($absoluteDirectory, $name);

        return $directory.'/'.$name;
    }

    public static function delete(?string $path): void
    {
        if (blank($path)) {
            return;
        }

        $absolute = public_path(ltrim($path, '/'));

        if (is_file($absolute)) {
            @unlink($absolute);
        }
    }
}
