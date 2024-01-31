<?php
use App\Models\Setting;


if (!function_exists('siteInfo')) {
    function siteInfo() {
        return Setting::find(1);
    }
}


