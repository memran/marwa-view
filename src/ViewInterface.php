<?php

declare(strict_types=1);

namespace Marwa\View;

/**
 * Public API for the view engine.
 */
interface ViewInterface
{
    /**
     * Render a template to string.
     *
     * @param string $template  Logical template name (e.g. 'home/index')
     * @param array<string,mixed> $data
     *
     * @throws \Marwa\View\Exception\ViewException
     */
    public function render(string $template, array $data = []): string;

    /**
     * Return the final compiled output but also echo it immediately.
     *
     * @param string $template
     * @param array<string,mixed> $data
     */
    public function display(string $template, array $data = []): void;

    /**
     * Add (or override) a global variable available in all templates.
     *
     * @param string $name
     * @param mixed $value
     */
    public function share(string $name, mixed $value): void;

    /**
     * Clear all cached views (if cache is enabled).
     */
    public function clearCache(): void;
}
