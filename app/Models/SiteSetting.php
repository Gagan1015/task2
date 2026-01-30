<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    /**
     * Get a setting value by key
     */
    public static function get(string $key, $default = null)
    {
        $setting = Cache::remember("setting:{$key}", 3600, function () use ($key) {
            return static::where('key', $key)->first();
        });

        if (!$setting) {
            return $default;
        }

        return match ($setting->type) {
            'boolean' => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN),
            'json' => json_decode($setting->value, true),
            default => $setting->value,
        };
    }

    /**
     * Set a setting value
     */
    public static function set(string $key, $value, string $type = 'text', string $group = 'general')
    {
        if ($type === 'json' && is_array($value)) {
            $value = json_encode($value);
        }

        if ($type === 'boolean') {
            $value = $value ? '1' : '0';
        }

        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type, 'group' => $group]
        );

        Cache::forget("setting:{$key}");

        return $setting;
    }

    /**
     * Get all settings by group
     */
    public static function getByGroup(string $group)
    {
        return static::where('group', $group)->get()->pluck('value', 'key');
    }

    /**
     * Clear all settings cache
     */
    public static function clearCache()
    {
        $settings = static::all();
        foreach ($settings as $setting) {
            Cache::forget("setting:{$setting->key}");
        }
    }
}
