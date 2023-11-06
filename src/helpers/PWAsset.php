<?php

namespace PressWind\Src\Helpers;

use PressWind\Src\Helpers\Base\CSSAsset;
use PressWind\Src\Helpers\Base\JSAsset;

/**
 * Class PwAsset
 */
class PWAsset
{
    /**
     * define if asset is css
     */
    protected static function isCss($src): bool
    {
        return str_contains($src, '.css');
    }

    /**
     * Create new asset instance
     *
     *
     *
     *
     * @throws \Exception
     */
    public static function add($handle, $src): CSSAsset|JSAsset
    {
        try {
            if (self::isCss($src)) {
                return new CSSAsset($handle, $src);
            } else {
                return new JSAsset($handle, $src);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
