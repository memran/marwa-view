<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Renders small inline SVG icons from an explicit icon map.
 */
final class IconExtension extends AbstractExtension
{
    /**
     * @param array<string, string> $icons
     */
    public function __construct(private array $icons) {}

    /**
     * @return array<int, TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('icon', [$this, 'renderIcon'], ['is_safe' => ['html']]),
            new TwigFunction('has_icon', [$this, 'hasIcon']),
        ];
    }

    public function hasIcon(string $name): bool
    {
        return array_key_exists($name, $this->icons);
    }

    /**
     * @param array<string, scalar|bool|null> $attributes
     */
    public function renderIcon(string $name, array $attributes = []): string
    {
        $svg = $this->icons[$name] ?? null;
        if ($svg === null) {
            throw new \InvalidArgumentException(sprintf("Icon '%s' is not registered.", $name));
        }

        if ($attributes === []) {
            return $svg;
        }

        $attributesString = $this->compileAttributes($attributes);
        if ($attributesString === '') {
            return $svg;
        }

        return preg_replace('/<svg\b/', '<svg ' . $attributesString, $svg, 1) ?? $svg;
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
