<?php

declare(strict_types=1);

namespace Marwa\View\Translate;

use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;

/**
 * ArrayTranslator
 *
 * - Loads all PHP language files from $langPath.
 * - Supports normal messages ("key" => "value")
 * - Supports plural messages ("key" => ["one" => "...", "other" => "..."])
 */
final class ArrayTranslator implements TranslatorInterface
{
    private Translator $translator;

    /**
     * @var array<string, array<string, mixed>>
     *        [
     *          'en' => [
     *              'cart.items' => [
     *                  'one' => 'You have :count item...',
     *                  'other' => 'You have :count items...'
     *              ],
     *              'welcome.title' => 'Welcome, :name!',
     *          ],
     *          'bn' => [ ... ]
     *        ]
     */
    private array $catalog = [];

    public function __construct(
        private string $defaultLocale,
        private string $langPath
    ) {
        if (!is_dir($langPath)) {
            throw new \InvalidArgumentException("Language path '{$langPath}' not found.");
        }

        $this->translator = new Translator($defaultLocale);
        $this->translator->addLoader('array', new ArrayLoader());

        $this->loadLanguages();
    }

    public function trans(string $key, array $replacements = [], ?string $locale = null): string
    {
        $loc = $locale ?? $this->getLocale();

        // Try plural block first? No. For plain trans() we only accept scalar values.
        $message = $this->translator->trans($key, [], 'messages', $loc);

        // If message not found via Symfony translator (returns key unchanged) BUT
        // we have plural array in our catalog, use 'other' fallback.
        if ($message === $key && isset($this->catalog[$loc][$key]) && is_array($this->catalog[$loc][$key])) {
            $fallback = $this->catalog[$loc][$key]['other']
                ?? $this->catalog[$loc][$key]['one']
                ?? $key;
            $message = $fallback;
        }

        return $this->applyReplacements($message, $replacements);
    }

    public function transChoice(string $key, int $count, array $replacements = [], ?string $locale = null): string
    {
        $loc = $locale ?? $this->getLocale();

        // Find plural set from catalog
        $forms = $this->catalog[$loc][$key] ?? null;

        if (!is_array($forms)) {
            // Not an array -> fallback to normal trans()
            $single = $this->trans($key, $this->injectCount($replacements, $count), $loc);
            return $single;
        }

        // pick correct form
        $pattern = $this->selectPluralForm($forms, $count, $loc);

        // inject :count automatically
        $replacements = $this->injectCount($replacements, $count);

        return $this->applyReplacements($pattern, $replacements);
    }

    public function setLocale(string $locale): void
    {
        $this->translator->setLocale($locale);
    }

    public function getLocale(): string
    {
        return $this->translator->getLocale();
    }

    /**
     * Loads all lang/*.php files and registers them with Symfony Translator.
     */
    private function loadLanguages(): void
    {
        $files = glob(rtrim($this->langPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . '*.php');
        if ($files === false) {
            return;
        }

        foreach ($files as $file) {
            $locale = basename($file, '.php');

            $messages = include $file;
            if (!is_array($messages)) {
                continue;
            }

            // Keep entire catalog internally (for plural support)
            $this->catalog[$locale] = $messages;

            // Build a "flat" subset of only scalar keys for Symfony Translator
            // because Symfony's ArrayLoader only understands "key" => "value" strings.
            $flat = [];
            foreach ($messages as $k => $v) {
                if (is_string($v)) {
                    $flat[$k] = $v;
                } elseif (is_array($v)) {
                    // if plural set, try to expose 'other' as default
                    if (isset($v['other']) && is_string($v['other'])) {
                        $flat[$k] = $v['other'];
                    } elseif (isset($v['one']) && is_string($v['one'])) {
                        $flat[$k] = $v['one'];
                    }
                }
            }

            $this->translator->addResource('array', $flat, $locale, 'messages');
        }
    }

    /**
     * Apply :placeholder replacements in message.
     *
     * @param array<string,mixed> $replacements
     */
    private function applyReplacements(string $message, array $replacements): string
    {
        foreach ($replacements as $search => $value) {
            $message = str_replace($search, (string) $value, $message);
        }
        return $message;
    }

    /**
     * Inject :count if caller didn't pass it.
     *
     * @param array<string,mixed> $replacements
     * @return array<string,mixed>
     */
    private function injectCount(array $replacements, int $count): array
    {
        if (!array_key_exists(':count', $replacements)) {
            $replacements[':count'] = $count;
        }
        return $replacements;
    }

    /**
     * Selects singular/plural message form based on count and locale.
     *
     * @param array<string,string> $forms e.g. ['one' => '1 item', 'other' => ':count items']
     */
    private function selectPluralForm(array $forms, int $count, string $locale): string
    {
        // Basic rule:
        // - if 1 => "one"
        // - else => "other"
        //
        // Future-safe: you can extend this switch for locale-specific plural logic.

        $key = ($count === 1) ? 'one' : 'other';

        if (isset($forms[$key]) && is_string($forms[$key])) {
            return $forms[$key];
        }

        // fallback chain
        if (isset($forms['other']) && is_string($forms['other'])) {
            return $forms['other'];
        }

        if (isset($forms['one']) && is_string($forms['one'])) {
            return $forms['one'];
        }

        // ultimate fallback: just return first string we find
        foreach ($forms as $candidate) {
            if (is_string($candidate)) {
                return $candidate;
            }
        }

        // catastrophic fallback
        return '';
    }
}
