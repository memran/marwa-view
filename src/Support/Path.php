<?php

declare(strict_types=1);

namespace Marwa\View\Support;

final class Path
{
    /**
     * Safely join multiple path segments for any OS.
     *
     * @param string ...$segments
     */
    public static function join(string ...$segments): string
    {
        if ($segments === []) {
            return '';
        }

        $prefix = '';
        $clean = [];

        foreach ($segments as $index => $segment) {
            if ($segment === '') {
                continue;
            }

            if ($index === 0) {
                if (preg_match('/^[A-Za-z]:[\\\\\\/]*$/', $segment) === 1) {
                    $prefix = rtrim(str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $segment), '\\/') . DIRECTORY_SEPARATOR;
                    continue;
                }

                if (preg_match('/^[A-Za-z]:[\\\\\\/]/', $segment) === 1) {
                    $prefix = substr($segment, 0, 2) . DIRECTORY_SEPARATOR;
                    $segment = substr($segment, 2);
                } elseif (str_starts_with($segment, '\\\\') || str_starts_with($segment, '//')) {
                    $prefix = DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR;
                    $segment = ltrim($segment, '\\/');
                } elseif (str_starts_with($segment, '\\') || str_starts_with($segment, '/')) {
                    $prefix = DIRECTORY_SEPARATOR;
                    $segment = ltrim($segment, '\\/');
                }
            }

            $normalizedSegment = trim(str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $segment), DIRECTORY_SEPARATOR);
            if ($normalizedSegment === '') {
                continue;
            }

            $clean[] = $normalizedSegment;
        }

        $joined = implode(DIRECTORY_SEPARATOR, $clean);
        if ($prefix !== '') {
            $joined = $prefix . $joined;
        }

        // Collapse duplicate separators and normalize for current OS
        $pattern = '#(?<!:)' . preg_quote(DIRECTORY_SEPARATOR, '#') . '{2,}#';
        $normalized = preg_replace($pattern, DIRECTORY_SEPARATOR, $joined);

        return $normalized ?? $joined;
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
