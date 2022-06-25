<?php

namespace App\Services;

class BaseService {

    /**
     * Service instance
     * @var static
     */
    protected static $oInstance;

    /**
     * Get service instance
     *
     * @return static|null
     * <li></li>
     */
    public static function o() {
        if (isset(self::$oInstance[static::class])) {
            return self::$oInstance[static::class];
        }
        return self::$oInstance[static::class] = new static;
    }

}
