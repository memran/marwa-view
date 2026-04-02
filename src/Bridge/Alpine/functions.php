<?php

declare(strict_types=1);

use Marwa\View\Bridge\Alpine\UiBridge;

if (!function_exists('ui')) {
    /**
     * Global convenience helper for PHP-first templates and HTML snippets.
     */
    function ui(): UiBridge
    {
        static $bridge;

        if (!$bridge instanceof UiBridge) {
            $bridge = new UiBridge();
        }

        return $bridge;
    }
}
