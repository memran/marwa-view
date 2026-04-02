<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Adds small number-formatting helpers for templates.
 */
final class NumberExtension extends AbstractExtension
{
    /**
     * @return array<int, TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('number', [$this, 'formatNumber']),
            new TwigFunction('percent', [$this, 'formatPercent']),
            new TwigFunction('compact_number', [$this, 'compactNumber']),
            new TwigFunction('file_size', [$this, 'formatFileSize']),
        ];
    }

    public function formatNumber(int|float|string $value, int $decimals = 0): string
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException('Number value must be numeric.');
        }

        if ($decimals < 0) {
            throw new \InvalidArgumentException('Number decimals must be zero or greater.');
        }

        return number_format((float) $value, $decimals, '.', ',');
    }

    public function formatPercent(int|float|string $value, int $decimals = 0): string
    {
        return $this->formatNumber($value, $decimals) . '%';
    }

    public function compactNumber(int|float|string $value, int $decimals = 1): string
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException('Compact number value must be numeric.');
        }

        if ($decimals < 0) {
            throw new \InvalidArgumentException('Compact number decimals must be zero or greater.');
        }

        $number = (float) $value;
        $absolute = abs($number);

        if ($absolute >= 1_000_000_000) {
            return $this->trimTrailingZeros($number / 1_000_000_000, $decimals) . 'B';
        }

        if ($absolute >= 1_000_000) {
            return $this->trimTrailingZeros($number / 1_000_000, $decimals) . 'M';
        }

        if ($absolute >= 1_000) {
            return $this->trimTrailingZeros($number / 1_000, $decimals) . 'K';
        }

        return $this->formatNumber($number, $decimals);
    }

    public function formatFileSize(int|float|string $bytes, int $decimals = 1): string
    {
        if (!is_numeric($bytes)) {
            throw new \InvalidArgumentException('File size value must be numeric.');
        }

        if ($decimals < 0) {
            throw new \InvalidArgumentException('File size decimals must be zero or greater.');
        }

        $value = max(0.0, (float) $bytes);
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $unitIndex = 0;

        while ($value >= 1024 && $unitIndex < count($units) - 1) {
            $value /= 1024;
            ++$unitIndex;
        }

        return $this->trimTrailingZeros($value, $decimals) . ' ' . $units[$unitIndex];
    }

    private function trimTrailingZeros(float $value, int $decimals): string
    {
        $formatted = number_format($value, $decimals, '.', ',');

        return rtrim(rtrim($formatted, '0'), '.');
    }
}
