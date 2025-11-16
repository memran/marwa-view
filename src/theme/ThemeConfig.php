<?php

declare(strict_types=1);

namespace Marwa\View\Theme;

/**
 * ThemeConfig represents a single theme definition.
 *
 * Immutable value object.
 */
final class ThemeConfig
{
    /** @var string */
    private string $name;

    /** @var string Absolute filesystem path to this theme's root directory */
    private string $path;

    /** @var string|null Parent theme name for inheritance fallback */
    private ?string $parent;

    /** @var string Public base URL for assets of this theme (e.g. /themes/default) */
    private string $assetBaseUrl;

    /**
     * @param string      $name          Theme name (unique key, e.g. "default")
     * @param string      $path          Absolute path to theme directory
     * @param string|null $parent        Parent theme name or null
     * @param string      $assetBaseUrl  Public asset base URL (no trailing slash)
     */
    public function __construct(
        string $name,
        string $path,
        ?string $parent,
        string $assetBaseUrl
    ) {
        if ($name === '') {
            throw new \InvalidArgumentException('Theme name cannot be empty');
        }

        if ($path === '' || !is_dir($path)) {
            throw new \InvalidArgumentException('Theme path must be an existing directory');
        }

        if ($assetBaseUrl === '') {
            throw new \InvalidArgumentException('Asset base URL cannot be empty');
        }

        $this->name         = $name;
        $this->path         = rtrim($path, DIRECTORY_SEPARATOR);
        $this->parent       = $parent;
        $this->assetBaseUrl = rtrim($assetBaseUrl, '/');
    }

    public function name(): string
    {
        return $this->name;
    }

    public function path(): string
    {
        return $this->path;
    }

    public function parent(): ?string
    {
        return $this->parent;
    }

    public function assetBaseUrl(): string
    {
        return $this->assetBaseUrl;
    }
}
