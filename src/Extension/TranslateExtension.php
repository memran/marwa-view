<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Marwa\View\Translate\TranslatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * TranslateExtension
 * ------------------
 * Twig helpers:
 *   {{ t('welcome.title', {':name': user.name}) }}
 *   {{ tc('cart.items', cart.count, {':count': cart.count}) }}
 */
final class TranslateExtension extends AbstractExtension
{
    public function __construct(
        private TranslatorInterface $translator
    ) {}

    /**
     * @return array<int, TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('t', [$this, 'translate']),
            new TwigFunction('trans', [$this, 'translate']),
            new TwigFunction('tc', [$this, 'translateChoice']),
            new TwigFunction('transChoice', [$this, 'translateChoice']),
        ];
    }

    /**
     * Basic translation (no plural logic).
     *
     * @param string $key
     * @param array<string,mixed> $replacements
     * @param string|null $locale
     */
    public function translate(string $key, array $replacements = [], ?string $locale = null): string
    {
        return $this->translator->trans($key, $replacements, $locale);
    }

    /**
     * Plural-aware translation.
     *
     * @param string $key
     * @param int $count
     * @param array<string,mixed> $replacements
     * @param string|null $locale
     */
    public function translateChoice(string $key, int $count, array $replacements = [], ?string $locale = null): string
    {
        return $this->translator->transChoice($key, $count, $replacements, $locale);
    }
}
