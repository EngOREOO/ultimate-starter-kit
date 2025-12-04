<?php

namespace Vendor\UltimateStarterKit\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'description',
    ];

    /**
     * Get a setting value by key.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();

        if (!$setting) {
            return $default;
        }

        return static::castValue($setting->value, $setting->type);
    }

    /**
     * Set a setting value by key.
     */
    public static function set(string $key, mixed $value, string $type = 'string', ?string $description = null): void
    {
        $setting = static::firstOrNew(['key' => $key]);
        $setting->value = is_array($value) || is_object($value) ? json_encode($value) : (string) $value;
        $setting->type = $type;
        
        if ($description) {
            $setting->description = $description;
        }

        $setting->save();
    }

    /**
     * Cast value based on type.
     */
    protected static function castValue(string $value, string $type): mixed
    {
        return match ($type) {
            'integer', 'int' => (int) $value,
            'boolean', 'bool' => filter_var($value, FILTER_VALIDATE_BOOLEAN),
            'json' => json_decode($value, true),
            'array' => json_decode($value, true) ?? [],
            default => $value,
        };
    }

    /**
     * Get the casted value attribute.
     */
    public function getCastedValueAttribute(): mixed
    {
        return static::castValue($this->value, $this->type);
    }
}

