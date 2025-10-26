<?php

declare(strict_types=1);

namespace Marwa\View\Translate;

interface TranslatorInterface
{
    /**
     * Translate a message key without pluralization.
     *
     * @param string $key
     * @param array<string, mixed> $replacements
     * @param string|null $locale
     */
    public function trans(string $key, array $replacements = [], ?string $locale = null): string;

    /**
     * Translate a pluralizable message key using a numeric count.
     *
     * @param string $key Base message key
     * @param int $count The numeric quantity used for plural selection
     * @param array<string, mixed> $replacements Placeholder map (e.g. [":count" => 5])
     * @param string|null $locale Optional override locale
     *
     * @return string
     */
    public function transChoice(string $key, int $count, array $replacements = [], ?string $locale = null): string;

    /**
     * Change current locale.
     */
    public function setLocale(string $locale): void;

    /**
     * Get current locale.
     */
    public function getLocale(): string;
}
