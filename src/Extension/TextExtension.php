<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Adds common text filters.
 */
final class TextExtension extends AbstractExtension
{
    /**
     * @return array<int, TwigFilter>
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('truncate', function (string $value, int $length = 100, string $suffix = '...'): string {
                $value = trim($value);
                if (mb_strlen($value) <= $length) {
                    return $value;
                }
                return mb_substr($value, 0, $length) . $suffix;
            }),
            new TwigFilter('upper', 'mb_strtoupper'),
            new TwigFilter('lower', 'mb_strtolower'),
            new TwigFilter('slugify', function (string $text): string {
                $slug = preg_replace('/[^a-z0-9]+/i', '-', strtolower(trim($text)));
                return trim((string) $slug, '-');
            }),
        ];
    }
}
