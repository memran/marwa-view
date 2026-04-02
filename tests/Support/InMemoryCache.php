<?php

declare(strict_types=1);

namespace Marwa\View\Tests\Support;

use DateInterval;
use DateTimeImmutable;
use Psr\SimpleCache\CacheInterface;

final class InMemoryCache implements CacheInterface
{
    /**
     * @var array<string, mixed>
     */
    private array $values = [];

    /**
     * @var array<string, int|null>
     */
    private array $expiries = [];

    public function get($key, $default = null): mixed
    {
        if (!$this->has($key)) {
            return $default;
        }

        return $this->values[$key];
    }

    public function set($key, $value, $ttl = null): bool
    {
        $this->values[(string) $key] = $value;
        $this->expiries[(string) $key] = $this->normalizeExpiry($ttl);

        return true;
    }

    public function delete($key): bool
    {
        unset($this->values[(string) $key], $this->expiries[(string) $key]);

        return true;
    }

    public function clear(): bool
    {
        $this->values = [];
        $this->expiries = [];

        return true;
    }

    public function getMultiple($keys, $default = null): iterable
    {
        $results = [];
        foreach ($keys as $key) {
            $results[$key] = $this->get($key, $default);
        }

        return $results;
    }

    /**
     * @param iterable<string, mixed> $values
     */
    public function setMultiple($values, $ttl = null): bool
    {
        foreach ($values as $key => $value) {
            $this->set($key, $value, $ttl);
        }

        return true;
    }

    public function deleteMultiple($keys): bool
    {
        foreach ($keys as $key) {
            $this->delete($key);
        }

        return true;
    }

    public function has($key): bool
    {
        $key = (string) $key;
        if (!array_key_exists($key, $this->values)) {
            return false;
        }

        $expiry = $this->expiries[$key];
        if ($expiry !== null && $expiry < time()) {
            $this->delete($key);

            return false;
        }

        return true;
    }

    private function normalizeExpiry(DateInterval|int|null $ttl): ?int
    {
        if ($ttl === null) {
            return null;
        }

        if ($ttl instanceof DateInterval) {
            return (new DateTimeImmutable())->add($ttl)->getTimestamp();
        }

        return time() + $ttl;
    }
}
