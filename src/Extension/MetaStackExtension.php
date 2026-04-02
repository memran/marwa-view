<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Marwa\View\ViewInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Adds small convenience helpers for pushing metadata and asset tags into stacks.
 */
final class MetaStackExtension extends AbstractExtension
{
    public function __construct(private ViewInterface $view) {}

    /**
     * @return array<int, TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('push_meta', [$this, 'pushMeta']),
            new TwigFunction('push_property_meta', [$this, 'pushPropertyMeta']),
            new TwigFunction('push_link_tag', [$this, 'pushLinkTag']),
            new TwigFunction('push_script_tag', [$this, 'pushScriptTag']),
        ];
    }

    public function pushMeta(string $name, string $content, string $stack = 'head'): string
    {
        $this->view->pushToStack(
            $stack,
            sprintf('<meta name="%s" content="%s">', $this->escape($name), $this->escape($content))
        );

        return '';
    }

    public function pushPropertyMeta(string $property, string $content, string $stack = 'head'): string
    {
        $this->view->pushToStack(
            $stack,
            sprintf('<meta property="%s" content="%s">', $this->escape($property), $this->escape($content))
        );

        return '';
    }

    /**
     * @param array<string, scalar|bool|null> $attributes
     */
    public function pushLinkTag(string $rel, string $href, array $attributes = [], string $stack = 'head'): string
    {
        $attributes = array_merge(['rel' => $rel, 'href' => $href], $attributes);
        $this->view->pushToStack($stack, '<link ' . $this->compileAttributes($attributes) . '>');

        return '';
    }

    /**
     * @param array<string, scalar|bool|null> $attributes
     */
    public function pushScriptTag(string $src, array $attributes = [], string $stack = 'scripts'): string
    {
        $attributes = array_merge(['src' => $src], $attributes);
        $this->view->pushToStack($stack, '<script ' . $this->compileAttributes($attributes) . '></script>');

        return '';
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

            $escapedName = $this->escape($name);
            if ($value === true) {
                $compiled[] = $escapedName;
                continue;
            }

            $compiled[] = sprintf('%s="%s"', $escapedName, $this->escape((string) $value));
        }

        return implode(' ', $compiled);
    }

    private function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
