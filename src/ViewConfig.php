<?php

declare(strict_types=1);

namespace Marwa\View;

use InvalidArgumentException;
use Psr\SimpleCache\CacheInterface;

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
     * @param CacheInterface|null $fragmentCache PSR-16 cache for fragment output
     */
    public function __construct(
        private string $viewsPath,
        private string $cachePath,
        private bool $debug,
        private ?CacheInterface $fragmentCache = null,
    ) {
        $resolvedViewsPath = realpath($viewsPath);
        if ($resolvedViewsPath === false || !is_dir($resolvedViewsPath)) {
            throw new InvalidArgumentException("viewsPath '{$viewsPath}' is not a directory.");
        }

        if (!is_dir($cachePath) && !@mkdir($cachePath, 0775, true) && !is_dir($cachePath)) {
            throw new InvalidArgumentException("cachePath '{$cachePath}' cannot be created.");
        }

        $resolvedCachePath = realpath($cachePath);
        if ($resolvedCachePath === false || !is_dir($resolvedCachePath)) {
            throw new InvalidArgumentException("cachePath '{$cachePath}' is not a directory.");
        }

        if (!is_writable($resolvedCachePath)) {
            throw new InvalidArgumentException("cachePath '{$resolvedCachePath}' is not writable.");
        }

        $this->viewsPath = $resolvedViewsPath;
        $this->cachePath = $resolvedCachePath;
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

    public function getFragmentCache(): ?CacheInterface
    {
        return $this->fragmentCache;
    }
}
