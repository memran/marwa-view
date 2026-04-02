<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Marwa\View\View;
use Marwa\View\ViewConfig;

$config = new ViewConfig(
    viewsPath: __DIR__ . DIRECTORY_SEPARATOR . 'views',          // folder with .twig files
    cachePath: __DIR__ . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'views',  // compiled cache (writable)
    debug: true,
);

$view = new View($config);

// share globals
$view->share('appName', 'OrbitOps Billing');
$view->share('csrf', 'abc123token');
echo $view->render('myhome', [
    'title' => 'Basic Examples',
    'user' => [
        'name' => 'Avery Stone',
        'role' => 'Platform Lead',
    ],
    'notifications' => ['Design system review is ready', 'Nightly deployment finished successfully'],
    'exampleLinks' => [
        [
            'label' => 'Simple Demo',
            'href' => '/basic/render-demo.php',
            'summary' => 'Fragment caching, translations, HTML helpers, and sub-view rendering.',
        ],
        [
            'label' => 'Full Demo',
            'href' => '/basic/demo.php',
            'summary' => 'Namespaced views, stacks, JSON helpers, icons, and richer template composition.',
        ],
        [
            'label' => 'Theme Examples',
            'href' => '/theme/index.php',
            'summary' => 'Jump to runtime theme switching, preview mode, and the docs browser.',
        ],
        [
            'label' => 'Docs Browser',
            'href' => '/theme/docs.php',
            'summary' => 'Browse tutorials, API docs, extension notes, and development guidance.',
        ],
    ],
]);
