<?php

namespace PressWind\Src\Helpers;

class PWApp
{
    public static function isDev(): bool
    {
        return defined('WP_ENV') && WP_ENV === 'development';
    }
}
