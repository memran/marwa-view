<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Adds small human-readable list formatting helpers.
 */
final class ListExtension extends AbstractExtension
{
    /**
     * @return array<int, TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('join_human', [$this, 'joinHuman']),
            new TwigFunction('oxford_join', [$this, 'oxfordJoin']),
        ];
    }

    /**
     * @param iterable<mixed> $items
     */
    public function joinHuman(iterable $items, string $last = 'and'): string
    {
        $normalized = $this->normalizeItems($items);
        $count = count($normalized);

        if ($count === 0) {
            return '';
        }

        if ($count === 1) {
            return $normalized[0];
        }

        if ($count === 2) {
            return $normalized[0] . ' ' . $last . ' ' . $normalized[1];
        }

        $head = array_slice($normalized, 0, -1);

        return implode(', ', $head) . ' ' . $last . ' ' . $normalized[$count - 1];
    }

    /**
     * @param iterable<mixed> $items
     */
    public function oxfordJoin(iterable $items): string
    {
        $normalized = $this->normalizeItems($items);
        $count = count($normalized);

        if ($count <= 2) {
            return $this->joinHuman($normalized, 'and');
        }

        $head = array_slice($normalized, 0, -1);

        return implode(', ', $head) . ', and ' . $normalized[$count - 1];
    }

    /**
     * @param iterable<mixed> $items
     * @return list<string>
     */
    private function normalizeItems(iterable $items): array
    {
        $normalized = [];

        foreach ($items as $item) {
            if (!is_scalar($item)) {
                continue;
            }

            $value = trim((string) $item);
            if ($value !== '') {
                $normalized[] = $value;
            }
        }

        return $normalized;
    }
}
