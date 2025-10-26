<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Adds asset() helper for static URLs.
 */
final class AssetExtension extends AbstractExtension
{
    public function __construct(
        private string $basePath = '/assets',
        private ?string $version = null
    ) {}

    /**
     * @return array<int, TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('asset', function (string $path): string {
                $versionSuffix = $this->version ? '?v=' . $this->version : '';
                return rtrim($this->basePath, '/') . '/' . ltrim($path, '/') . $versionSuffix;
            }),
        ];
    }
}
