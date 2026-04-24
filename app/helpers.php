<?php

use App\Models\Setting;

function setting($key, $default = null)
{
    $value = Setting::where('key', $key)->value('value');
    return $value ?? $default;
}
