<?php

namespace App\Helpers;

use Carbon\Carbon;

class GlobalHelper
{
    public static function formatCreatedAt($date = null)
    {
        if (!$date) {
            $date = now();
        }

        if (is_string($date)) {
            $date = Carbon::parse($date);
        }

        return $date->format('d/m/Y');
    }
}
