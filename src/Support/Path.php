<?php

declare(strict_types=1);

namespace Marwa\View\Support;

final class Path
{
    /**
     * Safely join multiple path segments for any OS.
     *
     * @param string ...$segments
     * @return string
     */
    public static function join(string ...$segments): string
    {
        $clean = [];
        foreach ($segments as $seg) {
            if ($seg === '' || $seg === DIRECTORY_SEPARATOR) {
                continue;
            }
            $clean[] = trim($seg, '\\/');
        }

        $joined = implode(DIRECTORY_SEPARATOR, $clean);

        // Collapse duplicate separators and normalize for current OS
        $normalized = preg_replace('#' . preg_quote(DIRECTORY_SEPARATOR) . '+#', DIRECTORY_SEPARATOR, $joined);

        return $normalized;
    }

    /**
     * Normalize a path to absolute realpath form if possible.
     */
    public static function normalize(string $path): string
    {
        $real = realpath($path);
        if ($real !== false) {
            return $real;
        }
        return rtrim($path, '\\/');
    }

    /**
     * Convert filesystem path to URL-safe path (forward slashes).
     */
    public static function toUrl(string $path): string
    {
        return str_replace(DIRECTORY_SEPARATOR, '/', $path);
    }
}
