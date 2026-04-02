<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Marwa\View\ViewInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Adds small SEO-focused stack helpers.
 */
final class SeoExtension extends AbstractExtension
{
    public function __construct(private ViewInterface $view) {}

    /**
     * @return array<int, TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('meta_title', [$this, 'metaTitle']),
            new TwigFunction('meta_description', [$this, 'metaDescription']),
            new TwigFunction('canonical_tag', [$this, 'canonicalTag']),
            new TwigFunction('robots_tag', [$this, 'robotsTag']),
            new TwigFunction('og_tag', [$this, 'ogTag']),
        ];
    }

    public function metaTitle(string $title, string $stack = 'head'): string
    {
        $this->view->pushToStack(
            $stack,
            sprintf('<meta property="og:title" content="%s">', $this->escape($title))
        );

        return '';
    }

    public function metaDescription(string $description, string $stack = 'head'): string
    {
        $escaped = $this->escape($description);
        $this->view->pushToStack($stack, sprintf('<meta name="description" content="%s">', $escaped));
        $this->view->pushToStack($stack, sprintf('<meta property="og:description" content="%s">', $escaped));

        return '';
    }

    public function canonicalTag(string $url, string $stack = 'head'): string
    {
        $this->view->pushToStack(
            $stack,
            sprintf('<link rel="canonical" href="%s">', $this->escape($url))
        );

        return '';
    }

    public function robotsTag(string $value, string $stack = 'head'): string
    {
        $this->view->pushToStack(
            $stack,
            sprintf('<meta name="robots" content="%s">', $this->escape($value))
        );

        return '';
    }

    public function ogTag(string $property, string $content, string $stack = 'head'): string
    {
        $this->view->pushToStack(
            $stack,
            sprintf('<meta property="%s" content="%s">', $this->escape($property), $this->escape($content))
        );

        return '';
    }

    private function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
