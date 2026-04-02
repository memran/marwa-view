<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Adds small string presentation helpers for templates.
 */
final class StringPresentationExtension extends AbstractExtension
{
    /**
     * @return array<int, TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('initials', [$this, 'initials']),
            new TwigFunction('headline', [$this, 'headline']),
            new TwigFunction('excerpt', [$this, 'excerpt']),
            new TwigFunction('nl2br_safe', [$this, 'nl2brSafe'], ['is_safe' => ['html']]),
        ];
    }

    public function initials(string $name, int $limit = 2): string
    {
        $parts = preg_split('/\s+/', trim($name)) ?: [];
        $letters = [];

        foreach ($parts as $part) {
            if ($part === '') {
                continue;
            }

            $letters[] = mb_substr($part, 0, 1);
            if (count($letters) >= max(1, $limit)) {
                break;
            }
        }

        return mb_strtoupper(implode('', $letters));
    }

    public function headline(string $text): string
    {
        $normalized = preg_replace('/[_-]+/', ' ', trim($text));
        $normalized = preg_replace('/\s+/', ' ', (string) $normalized);

        return mb_convert_case((string) $normalized, MB_CASE_TITLE, 'UTF-8');
    }

    public function excerpt(string $text, int $length = 160, string $suffix = '...'): string
    {
        if ($length < 0) {
            throw new \InvalidArgumentException('Excerpt length must be zero or greater.');
        }

        $normalized = trim(preg_replace('/\s+/', ' ', $text) ?? $text);
        if (mb_strlen($normalized) <= $length) {
            return $normalized;
        }

        $sliceLength = max(0, $length - mb_strlen($suffix));

        return rtrim(mb_substr($normalized, 0, $sliceLength)) . $suffix;
    }

    public function nl2brSafe(string $text): string
    {
        return nl2br(htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'), false);
    }
}
