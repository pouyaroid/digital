<?php
use App\Models\Setting;

function setting($key, $default = null)
{
    $item = Setting::where('key', $key)->first();
    return $item ? $item->value : $default;
}
