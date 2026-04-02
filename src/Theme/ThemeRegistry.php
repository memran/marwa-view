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
        if (isset($this->themes[$name])) {
            throw new \InvalidArgumentException("Theme '{$name}' is already registered");
        }

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

    /**
     * @return array<string, ThemeConfig>
     */
    public function all(): array
    {
        return $this->themes;
    }

    /**
     * @return list<string>
     */
    public function names(): array
    {
        return array_keys($this->themes);
    }

    /**
     * @return list<array{
     *     name: string,
     *     path: string,
     *     parent: string|null,
     *     asset_base_url: string,
     *     metadata: array{
     *         label: string,
     *         description: string|null,
     *         version: string|null,
     *         author: string|null,
     *         preview_image: string|null,
     *         tags: list<string>
     *     }
     * }>
     */
    public function catalog(): array
    {
        return array_values(array_map(
            static fn (ThemeConfig $theme): array => $theme->toArray(),
            $this->themes
        ));
    }
}
