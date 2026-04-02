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
    private string $name;
    private string $path;
    private ?string $parent;
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
        $name = trim($name);
        if ($name === '') {
            throw new \InvalidArgumentException('Theme name cannot be empty');
        }

        if (preg_match('/^[A-Za-z0-9][A-Za-z0-9_-]*$/', $name) !== 1) {
            throw new \InvalidArgumentException('Theme name may only contain letters, numbers, dashes, and underscores');
        }

        $realPath = realpath($path);
        if ($realPath === false || !is_dir($realPath)) {
            throw new \InvalidArgumentException('Theme path must be an existing directory');
        }

        $parent = $parent !== null ? trim($parent) : null;
        if ($parent === '') {
            $parent = null;
        }

        if ($parent !== null && preg_match('/^[A-Za-z0-9][A-Za-z0-9_-]*$/', $parent) !== 1) {
            throw new \InvalidArgumentException('Parent theme name may only contain letters, numbers, dashes, and underscores');
        }

        $assetBaseUrl = trim($assetBaseUrl);
        if ($assetBaseUrl === '') {
            throw new \InvalidArgumentException('Asset base URL cannot be empty');
        }

        $this->name         = $name;
        $this->path         = rtrim($realPath, DIRECTORY_SEPARATOR);
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
