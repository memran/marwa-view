<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Adds small HTML helper functions for cleaner templates.
 */
final class HtmlExtension extends AbstractExtension
{
    /**
     * @return array<int, TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('class_names', [$this, 'classNames']),
            new TwigFunction('html_attrs', [$this, 'htmlAttrs'], ['is_safe' => ['html']]),
        ];
    }

    public function classNames(mixed ...$values): string
    {
        $classes = [];

        foreach ($values as $value) {
            if (is_string($value)) {
                foreach (preg_split('/\s+/', trim($value)) ?: [] as $className) {
                    if ($className !== '') {
                        $classes[$className] = true;
                    }
                }

                continue;
            }

            if (!is_array($value)) {
                continue;
            }

            if (array_is_list($value)) {
                foreach ($value as $item) {
                    if (!is_string($item)) {
                        continue;
                    }

                    foreach (preg_split('/\s+/', trim($item)) ?: [] as $className) {
                        if ($className !== '') {
                            $classes[$className] = true;
                        }
                    }
                }

                continue;
            }

            foreach ($value as $className => $condition) {
                if (is_int($className)) {
                    if (is_string($condition)) {
                        foreach (preg_split('/\s+/', trim($condition)) ?: [] as $item) {
                            if ($item !== '') {
                                $classes[$item] = true;
                            }
                        }
                    }

                    continue;
                }

                if ($condition && $className !== '') {
                    $classes[(string) $className] = true;
                }
            }
        }

        return implode(' ', array_keys($classes));
    }

    /**
     * @param array<string, mixed> $attributes
     */
    public function htmlAttrs(array $attributes): string
    {
        $compiled = [];

        foreach ($attributes as $name => $value) {
            if ($value === null || $value === false) {
                continue;
            }

            $escapedName = $this->escape((string) $name);

            if ($value === true) {
                $compiled[] = $escapedName;
                continue;
            }

            $stringValue = $name === 'class'
                ? (is_string($value) || is_array($value) ? $this->classNames($value) : '')
                : $this->stringifyAttributeValue($value);

            if ($stringValue === '') {
                continue;
            }

            $compiled[] = sprintf('%s="%s"', $escapedName, $this->escape($stringValue));
        }

        return implode(' ', $compiled);
    }

    private function stringifyAttributeValue(mixed $value): string
    {
        if (is_scalar($value)) {
            return (string) $value;
        }

        if (is_array($value)) {
            $parts = [];
            foreach ($value as $item) {
                if ($item === null || $item === false) {
                    continue;
                }

                if (is_scalar($item)) {
                    $parts[] = (string) $item;
                }
            }

            return implode(' ', $parts);
        }

        return '';
    }

    private function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
