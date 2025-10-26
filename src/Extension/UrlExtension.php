<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Adds simple URL and route helpers.
 */
final class UrlExtension extends AbstractExtension
{
    public function __construct(
        private string $baseUrl = ''
    ) {}

    /**
     * @return array<int, TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('url', function (string $path = ''): string {
                return rtrim($this->baseUrl, '/') . '/' . ltrim($path, '/');
            }),
            new TwigFunction('route', function (string $name, array $params = []): string {
                // This could integrate with a real router later.
                $url = '/' . ltrim($name, '/');
                if (!empty($params)) {
                    $url .= '?' . http_build_query($params);
                }
                return rtrim($this->baseUrl, '/') . $url;
            }),
        ];
    }
}
