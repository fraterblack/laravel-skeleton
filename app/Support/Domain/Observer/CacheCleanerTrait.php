<?php

namespace Lpf\Support\Domain\Observer;

use Illuminate\Contracts\Cache\Repository as Cache;

trait CacheCleanerTrait
{
    protected function clearCache($key)
    {
        $cache = $this->makeCacheRepository();

        if ($cache->has('_cacheControl')) {
            $items = $cache->get('_cacheControl', []);

            $matches = preg_grep("/^" . $key . "/", $items);

            if (count($matches) > 0) {
                foreach ($matches as $key => $cacheKey) {
                    $cache->forget($cacheKey);

                    unset($items[$key]);
                }

                $cache->forever('_cacheControl', $items);
            }
        }

        return true;
    }

    /**
     * @return Cache
     */
    protected function makeCacheRepository()
    {
        return app()->make(Cache::class);
    }
}