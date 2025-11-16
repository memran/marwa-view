<?php

declare(strict_types=1);

use Marwa\View\View;
use Marwa\View\ViewConfig;
use Marwa\View\Support\Path;
use Marwa\View\Theme\ThemeConfig;
use Marwa\View\Theme\ThemeRegistry;
use Marwa\View\Theme\ThemeResolver;
use Marwa\View\Theme\ThemeBuilder;

require_once __DIR__ . '/../vendor/autoload.php';

// 1. Build ThemeRegistry and add themes
$registry = new ThemeRegistry();

// absolute paths to each theme's views dir
$defaultViewsPath = Path::join(__DIR__, 'views', 'themes', 'default', 'views');
$darkViewsPath    = Path::join(__DIR__, 'views', 'themes', 'dark', 'views');



if ($defaultViewsPath === false || $darkViewsPath === false) {
    throw new RuntimeException('Theme directories not found. Check your paths.');
}

// Each theme gets: name, absolute path to its views, parent theme name (or null), asset base URL.
$registry->add(
    new ThemeConfig(
        name: 'default',
        path: $defaultViewsPath,
        parent: null,
        assetBaseUrl: '/views/themes/default/assets' // URL prefix for assets from this theme
    )
);

$registry->add(
    new ThemeConfig(
        name: 'dark',
        path: $darkViewsPath,
        parent: 'default',            // dark inherits default if it can't find a template
        assetBaseUrl: '/views/themes/dark/assets'  // URL prefix for dark assets
    )
);

// 2. Create resolver
$resolver = new ThemeResolver();

// 3. Create builder with a default active theme (e.g. "default")
$themeBuilder = new ThemeBuilder(
    registry: $registry,
    resolver: $resolver,
    defaultTheme: 'default'
);

// (Optional) Switch theme at runtime, e.g. dark mode:
$tenantWantsDark = true;
if ($tenantWantsDark) {
    $themeBuilder->useTheme('dark');
}

// 4. Create ViewConfig for Twig cache etc.
$viewConfig = new ViewConfig(
    viewsPath: $defaultViewsPath, // fallback path; View will mostly pull from ThemeBuilder anyway
    cachePath: realpath(__DIR__ . '/storage/cache/twig') ?: (__DIR__ . '/storage/cache/twig'),
    debug: true,
    fragmentCache: null // or inject a PSR-16 cache implementation
);

// 5. Create the View and inject ThemeBuilder
$view = new View(
    config: $viewConfig,
    extensions: [],
    themeBuilder: $themeBuilder
);

// 6. Render a page from the active theme
echo $view->render('home/index', [
    'user' => [
        'id'   => 7,
        'name' => 'Emran',
    ],
]);
