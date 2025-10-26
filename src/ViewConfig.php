<?php

declare(strict_types=1);

namespace Marwa\View;

/**
 * ViewConfig holds all configuration for the renderer.
 * Immutable value object.
 */
final class ViewConfig
{
    /**
     * @param string               $viewsPath   Base directory for .twig templates
     * @param string               $cachePath   Directory for compiled templates (Twig internal cache)
     * @param bool                 $debug       Enable debug mode
     * @param \Psr\SimpleCache\CacheInterface|null $fragmentCache PSR-16 cache for fragment output
     */
    public function __construct(
        private string $viewsPath,
        private string $cachePath,
        private bool $debug,
        private ?\Psr\SimpleCache\CacheInterface $fragmentCache = null,
    ) {
        if (!is_dir($viewsPath)) {
            throw new \InvalidArgumentException("viewsPath '{$viewsPath}' is not a directory.");
        }

        if (!is_dir($cachePath) && !@mkdir($cachePath, 0775, true) && !is_dir($cachePath)) {
            throw new \InvalidArgumentException("cachePath '{$cachePath}' cannot be created.");
        }
    }

    public function getViewsPath(): string
    {
        return $this->viewsPath;
    }

    public function getCachePath(): string
    {
        return $this->cachePath;
    }

    public function isDebug(): bool
    {
        return $this->debug;
    }

    public function getFragmentCache(): ?\Psr\SimpleCache\CacheInterface
    {
        return $this->fragmentCache;
    }
}
