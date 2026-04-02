<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use DateTimeImmutable;
use DateTimeInterface;
use IntlDateFormatter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Adds date formatting filters.
 */
final class DateExtension extends AbstractExtension
{
    /**
     * @return array<int, TwigFilter>
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('date_format', [$this, 'formatDate']),
            new TwigFilter('time_ago', [$this, 'timeAgo']),
        ];
    }

    public function formatDate(DateTimeInterface|string $date, string $pattern = 'medium', string $locale = 'en_US'): string
    {
        $date = $this->coerceDate($date);

        if (!class_exists(IntlDateFormatter::class)) {
            return $date->format($this->fallbackPattern($pattern));
        }

        $formatter = new IntlDateFormatter($locale, $this->resolvePattern($pattern), IntlDateFormatter::NONE);
        $formatted = $formatter->format($date);

        return is_string($formatted) ? $formatted : $date->format($this->fallbackPattern($pattern));
    }

    public function timeAgo(DateTimeInterface|string $time): string
    {
        $time = $this->coerceDate($time);

        $diff = time() - $time->getTimestamp();
        if ($diff < 0) {
            $futureDiff = abs($diff);

            foreach ($this->units() as $secs => $label) {
                if ($futureDiff >= $secs) {
                    $value = (int) floor($futureDiff / $secs);

                    return sprintf('in %d %s%s', $value, $label, $value > 1 ? 's' : '');
                }
            }

            return 'just now';
        }

        foreach ($this->units() as $secs => $label) {
            if ($diff >= $secs) {
                $value = (int) floor($diff / $secs);
                return sprintf('%d %s%s ago', $value, $label, $value > 1 ? 's' : '');
            }
        }

        return 'just now';
    }

    private function resolvePattern(string $pattern): int
    {
        return match ($pattern) {
            'short' => IntlDateFormatter::SHORT,
            'long'  => IntlDateFormatter::LONG,
            default => IntlDateFormatter::MEDIUM,
        };
    }

    private function fallbackPattern(string $pattern): string
    {
        return match ($pattern) {
            'short' => 'Y-m-d',
            'long' => 'F j, Y',
            default => 'M j, Y',
        };
    }

    private function coerceDate(DateTimeInterface|string $date): DateTimeInterface
    {
        if ($date instanceof DateTimeInterface) {
            return $date;
        }

        try {
            return new DateTimeImmutable($date);
        } catch (\Exception $exception) {
            throw new \InvalidArgumentException("Invalid date value '{$date}'", 0, $exception);
        }
    }

    /**
     * @return array<int, string>
     */
    private function units(): array
    {
        return [
            31536000 => 'year',
            2592000  => 'month',
            604800   => 'week',
            86400    => 'day',
            3600     => 'hour',
            60       => 'minute',
            1        => 'second',
        ];
    }
}
