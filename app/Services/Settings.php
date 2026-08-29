<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Settings
{
    public function all(): Collection
    {
        $settings = Cache::rememberForever('ayii.settings', function () {
            return Setting::query()
                ->get()
                ->mapWithKeys(fn (Setting $setting) => ["{$setting->group}.{$setting->key}" => $setting->value])
                ->all();
        });

        return collect($settings);
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->all()->get($key, $default);
    }

    public function put(string $group, string $key, mixed $value, string $type = 'string'): Setting
    {
        $setting = Setting::updateOrCreate(
            ['group' => $group, 'key' => $key],
            ['value' => $value, 'type' => $type]
        );

        Cache::forget('ayii.settings');

        return $setting;
    }
}
