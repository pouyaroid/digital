<?php

use App\Models\Setting;

if (!function_exists('setting')) {

    function setting($key, $default = null)
    {
        static $cache = [];

        if (array_key_exists($key, $cache)) {
            return $cache[$key];
        }

        $value = \App\Models\Setting::where('key', $key)->value('value');

        return $cache[$key] = $value ?? $default;
    }

}