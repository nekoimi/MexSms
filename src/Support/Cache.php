<?php
/**
 * # ----
 * #     Yprisoner <yyprisoner@gmail.com>
 * #                   19-8-14 上午10:59
 * #                            ------
 **/

namespace MexSms\Support;
use MexSms\Contracts\CacheHandlerInterface;

class Cache implements CacheHandlerInterface {

    const CACHE_PREFIX = 'MEX_SMS:';

    public static function instance() {
        return new self();
    }

    /**
     * Get cache value by cache Key.
     *
     * @param string $key
     * @return string
     */
    public function get(string $key): string {
        return app('redis')->get(static::CACHE_PREFIX . $key);
    }

    /**
     * Set a cache.
     *
     * @param string $key
     * @param string $value
     * @param int $expired_at 过期时间（秒钟）
     */
    public function set(string $key, string $value, int $expired_at) {
        app('redis')->setex(static::CACHE_PREFIX . $key, $expired_at, $value);
    }

    /**
     * Determine if the cache exists.
     *
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool {
        return app('redis')->exists(static::CACHE_PREFIX . $key);
    }

    /**
     * Remove s cache by Key.
     *
     * @param string $key
     */
    public function del(string $key) {
        app('redis')->del((array)static::CACHE_PREFIX . $key);
    }
}
