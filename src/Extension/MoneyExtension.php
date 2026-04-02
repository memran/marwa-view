<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Adds lightweight money formatting for templates.
 */
final class MoneyExtension extends AbstractExtension
{
    /**
     * @return array<int, TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('money', [$this, 'formatMoney']),
        ];
    }

    public function formatMoney(int|float|string $amount, string $currency = 'USD', ?int $decimals = null): string
    {
        if (!is_numeric($amount)) {
            throw new \InvalidArgumentException('Money amount must be numeric.');
        }

        $currency = strtoupper(trim($currency));
        if ($currency === '') {
            throw new \InvalidArgumentException('Currency code cannot be empty.');
        }

        $decimals ??= $this->defaultDecimals($currency);
        if ($decimals < 0) {
            throw new \InvalidArgumentException('Money decimals must be zero or greater.');
        }

        $value = (float) $amount;
        $formatted = number_format(abs($value), $decimals, '.', ',');
        $prefix = $value < 0 ? '-' : '';
        $symbol = $this->currencySymbol($currency);

        if ($symbol !== null) {
            return $prefix . $symbol . $formatted;
        }

        return sprintf('%s%s %s', $prefix, $currency, $formatted);
    }

    private function defaultDecimals(string $currency): int
    {
        return in_array($currency, ['JPY', 'KRW'], true) ? 0 : 2;
    }

    private function currencySymbol(string $currency): ?string
    {
        return match ($currency) {
            'USD', 'CAD', 'AUD', 'NZD', 'SGD' => '$',
            'EUR' => 'EUR ',
            'GBP' => 'GBP ',
            default => null,
        };
    }
}
