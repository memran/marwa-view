<?php

declare(strict_types=1);

// -----------------------------------------------------------------------------
// PSR-4 autoload from Composer
// -----------------------------------------------------------------------------
require_once __DIR__ . '/../vendor/autoload.php';

use Marwa\View\View;
use Marwa\View\ViewConfig;
use Marwa\View\Extension\{AssetExtension, TextExtension, DateExtension, UrlExtension};


// -----------------------------------------------------------------------------
// Configure View
// viewsPath: where .twig templates live
// cachePath: where compiled twig cache files will be stored
// debug:     true = strict vars, auto_reload
// -----------------------------------------------------------------------------
$config = new ViewConfig(
    viewsPath: __DIR__ . '/views',
    cachePath: __DIR__ . '/storage/views',
    debug: true,
    //fragmentCache: $fragmentCache,
);

// -----------------------------------------------------------------------------
// Create the View instance
// -----------------------------------------------------------------------------
$view = new View($config, [
    new AssetExtension('/static', '1.2.3'),
    new TextExtension(),
    new DateExtension(),
    new UrlExtension('https://example.com')
]);

// -----------------------------------------------------------------------------
// Share globals available in *every* template
// -----------------------------------------------------------------------------
$view->share('appName', 'EnetFlow Billing Suite');
$view->share('csrf', bin2hex(random_bytes(16)));

// You can also share "auth" or current tenant/org, etc.
$view->share('auth', [
    'id' => 999,
    'email' => 'admin@example.com',
    'role' => 'admin',
]);

// We return $view to whoever includes this bootstrap.
return $view;
