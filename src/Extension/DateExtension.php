<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use DateTimeInterface;
use IntlDateFormatter;

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
        if (!$date instanceof DateTimeInterface) {
            $date = new \DateTime($date);
        }

        $formatter = new IntlDateFormatter($locale, $this->resolvePattern($pattern), IntlDateFormatter::NONE);
        return $formatter->format($date);
    }

    public function timeAgo(DateTimeInterface|string $time): string
    {
        if (!$time instanceof DateTimeInterface) {
            $time = new \DateTime($time);
        }

        $diff = (new \DateTime())->getTimestamp() - $time->getTimestamp();

        $units = [
            31536000 => 'year',
            2592000  => 'month',
            604800   => 'week',
            86400    => 'day',
            3600     => 'hour',
            60       => 'minute',
            1        => 'second',
        ];

        foreach ($units as $secs => $label) {
            if ($diff >= $secs) {
                $value = floor($diff / $secs);
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
}
