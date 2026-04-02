<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Adds lightweight image markup helpers.
 */
final class ImageExtension extends AbstractExtension
{
    /**
     * @return array<int, TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('image_attrs', [$this, 'imageAttrs'], ['is_safe' => ['html']]),
            new TwigFunction('srcset', [$this, 'srcset']),
        ];
    }

    /**
     * @param array<string, scalar|bool|null> $attributes
     */
    public function imageAttrs(string $src, string $alt, array $attributes = []): string
    {
        $attributes = array_merge(['src' => $src, 'alt' => $alt], $attributes);

        return $this->compileAttributes($attributes);
    }

    /**
     * @param iterable<mixed> $candidates
     */
    public function srcset(iterable $candidates): string
    {
        $parts = [];

        foreach ($candidates as $descriptor => $path) {
            if (!is_scalar($path)) {
                continue;
            }

            $pathValue = trim((string) $path);
            if ($pathValue === '') {
                continue;
            }

            if (is_int($descriptor)) {
                $parts[] = $pathValue;
                continue;
            }

            $descriptorValue = trim((string) $descriptor);
            if ($descriptorValue === '') {
                continue;
            }

            $parts[] = $pathValue . ' ' . $descriptorValue;
        }

        return implode(', ', $parts);
    }

    /**
     * @param array<string, scalar|bool|null> $attributes
     */
    private function compileAttributes(array $attributes): string
    {
        $compiled = [];

        foreach ($attributes as $name => $value) {
            if ($value === null || $value === false) {
                continue;
            }

            $escapedName = htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

            if ($value === true) {
                $compiled[] = $escapedName;
                continue;
            }

            $compiled[] = sprintf(
                '%s="%s"',
                $escapedName,
                htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')
            );
        }

        return implode(' ', $compiled);
    }
}
