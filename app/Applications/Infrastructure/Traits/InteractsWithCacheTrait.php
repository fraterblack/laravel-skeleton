<?php

namespace Lpf\Applications\Infrastructure\Traits;

use Closure;
use Illuminate\Contracts\Cache\Repository as Cache;

trait InteractsWithCacheTrait
{
    protected function resolveCache($key, $duration = null, Closure $callback)
    {
        $cache = $this->makeCacheRepository();

        $this->resetCache($key, $cache);

        $this->addKeyToControl($key, $cache);

        return $cache->remember($key, ($duration !== null ? $duration : config('cache.duration')), $callback);
    }

    protected function resetCache($key, $cache = null)
    {
        if (app()->env == 'local' && config('cache.always_reset_in_local')) {
            $cache->forget($key, $cache);
        }
    }

    protected function removeCache($key, $cache = null) {
        $cache = ($cache) ? $cache : $this->makeCacheRepository();

        $cache->forget('_cacheControl');
        $cache->forget($key);
    }

    protected function addKeyToControl($key, $cache = null) {
        $cache = ($cache) ? $cache : $this->makeCacheRepository();

        $keys = $cache->get('_cacheControl', []);

        if (!in_array($key, $keys)) {
            $keys = array_prepend($keys, $key);

            $cache->forever('_cacheControl', $keys);
        }
    }

    /**
     * @return Cache
     */
    protected function makeCacheRepository()
    {
        return app()->make(Cache::class);
    }
}