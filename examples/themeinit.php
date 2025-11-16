<?php

use Marwa\View\Theme\ThemeBootstrap;
use Marwa\View\View;
use Marwa\View\ViewConfig;

// 1. Build ThemeBuilder automatically
$themeBuilder = ThemeBootstrap::initFromDirectory(
    themesBaseDir: '/var/www/app/themes',
    defaultTheme: 'default'
);

// 2. Build ViewConfig like before
$viewConfig = new ViewConfig(
    viewsPath: '/var/www/app/views',   // legacy fallback, still used if no theme
    cachePath: '/var/www/app/cache/twig',
    debug: true,
    fragmentCache: null // or PSR-16 cache instance
);

// 3. Create View with ThemeBuilder injected
$view = new View(
    config: $viewConfig,
    extensions: [],            // custom twig extensions if any
    themeBuilder: $themeBuilder
);
