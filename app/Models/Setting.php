<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    protected static ?array $cache = null;

    public static function allAsArray(): array
    {
        if (static::$cache === null) {
            static::$cache = static::query()->pluck('value', 'key')->all();
        }

        return static::$cache;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return static::allAsArray()[$key] ?? $default;
    }

    public static function put(string $key, mixed $value, string $group = 'general'): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value, 'group' => $group]);
        static::$cache = null;
    }

    public static function flush(): void
    {
        static::$cache = null;
    }
}
