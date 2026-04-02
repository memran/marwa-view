<?php

declare(strict_types=1);

// -----------------------------------------------------------------------------
// PSR-4 autoload from Composer
// -----------------------------------------------------------------------------
require_once __DIR__ . '/../../vendor/autoload.php';

use Marwa\View\Extension\{AlpineExtension, AssetExtension, DateExtension, HtmlExtension, IconExtension, ImageExtension, JsonExtension, ListExtension, MetaStackExtension, MoneyExtension, NumberExtension, SeoExtension, StatusExtension, StringPresentationExtension, TextExtension, UrlExtension};
use Marwa\View\Extension\TranslateExtension;
use Marwa\View\Translate\ArrayTranslator;
use Marwa\View\View;
use Marwa\View\ViewConfig;

$translator = new ArrayTranslator(
    defaultLocale: 'en',
    langPath: __DIR__ . '/lang'
);

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
    namespaces: [
        'Blog' => __DIR__ . '/modules/Blog/views',
    ],
);

// -----------------------------------------------------------------------------
// Create the View instance
// -----------------------------------------------------------------------------
$view = new View($config, [
    new AssetExtension('/static', '1.2.3'),
    new TextExtension(),
    new DateExtension(),
    new HtmlExtension(),
    new AlpineExtension(),
    new ImageExtension(),
    new NumberExtension(),
    new JsonExtension(),
    new ListExtension(),
    new MoneyExtension(),
    new StatusExtension(),
    new StringPresentationExtension(),
    new UrlExtension('https://demo.test'),
    new TranslateExtension($translator),
]);

$view->addExtension(new MetaStackExtension($view));
$view->addExtension(new SeoExtension($view));
$view->addExtension(new IconExtension([
    'spark' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" xmlns="http://www.w3.org/2000/svg"><path d="M12 3l1.9 5.6L19 10.5l-4.1 3 1.6 5.5-4.5-3.2L7.5 19l1.6-5.5-4.1-3 5.1-1.9L12 3Z"/></svg>',
    'server' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" xmlns="http://www.w3.org/2000/svg"><rect x="4" y="4" width="16" height="6" rx="2"/><rect x="4" y="14" width="16" height="6" rx="2"/><path d="M8 7h.01M8 17h.01M12 7h6M12 17h6"/></svg>',
]));

// -----------------------------------------------------------------------------
// Share globals available in *every* template
// -----------------------------------------------------------------------------
$view->share('appName', 'OrbitOps Billing Suite');
$view->share('csrf', bin2hex(random_bytes(16)));
// Share locale for convenience
$view->share('locale', $translator->getLocale());

// You can also share "auth" or current tenant/org, etc.
$view->share('auth', [
    'id' => 999,
    'email' => 'admin@orbitops.test',
    'role' => 'admin',
]);
$view->share('featureTags', ['fragment cache', 'themes', 'namespaced views']);

// We return $view to whoever includes this bootstrap.
return $view;
