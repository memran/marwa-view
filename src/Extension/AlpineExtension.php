<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Marwa\View\Bridge\Alpine\UiBridge;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Optional Alpine.js bridge for templates that want PHP-first attribute helpers.
 */
final class AlpineExtension extends AbstractExtension
{
    private UiBridge $bridge;

    public function __construct(?UiBridge $bridge = null)
    {
        $this->bridge = $bridge ?? new UiBridge();
    }

    /**
     * @return array<int, TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('ui', fn (): UiBridge => $this->bridge),
        ];
    }
}
