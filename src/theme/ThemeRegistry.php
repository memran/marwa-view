<?php

declare(strict_types=1);

namespace Marwa\View\Theme;

/**
 * ThemeRegistry keeps track of all known themes.
 * This will usually be configured at bootstrap time.
 */
final class ThemeRegistry
{
    /** @var array<string, ThemeConfig> */
    private array $themes = [];

    /**
     * Register a theme config.
     */
    public function add(ThemeConfig $theme): void
    {
        $name = $theme->name();
        $this->themes[$name] = $theme;
    }

    /**
     * Check if a theme exists.
     */
    public function has(string $themeName): bool
    {
        return isset($this->themes[$themeName]);
    }

    /**
     * Get a theme by name or throw.
     *
     * @throws ThemeNotFoundException
     */
    public function get(string $themeName): ThemeConfig
    {
        if (!isset($this->themes[$themeName])) {
            throw new ThemeNotFoundException("Theme '{$themeName}' not registered");
        }
        return $this->themes[$themeName];
    }
}
