<?php

declare(strict_types=1);

namespace Marwa\View\Cache;

use DateInterval;
use Psr\SimpleCache\CacheInterface;

/**
 * NullCache is a no-op PSR-16 cache implementation.
 * Useful default for fragment caching.
 */
final class NullCache implements CacheInterface
{
    public function get($key, $default = null): mixed
    {
        return $default;
    }

    public function set($key, $value, $ttl = null): bool
    {
        return true;
    }

    public function delete($key): bool
    {
        return true;
    }

    public function clear(): bool
    {
        return true;
    }

    public function getMultiple($keys, $default = null): iterable
    {
        foreach ($keys as $key) {
            yield $key => $default;
        }
    }

    public function setMultiple($values, $ttl = null): bool
    {
        return true;
    }

    public function deleteMultiple($keys): bool
    {
        return true;
    }

    public function has($key): bool
    {
        return false;
    }
}
