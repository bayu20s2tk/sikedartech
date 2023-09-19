<?php

namespace App\Helpers;

use App\Models\AppSetting;
use Illuminate\Support\Facades\Http;

class Helper
{
    public static function app()
    {
        if (AppSetting::first() != null) {
            return AppSetting::first();
        }
    }
}
