<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Marwa\View\View;
use Marwa\View\ViewConfig;

$config = new ViewConfig(
    viewsPath: __DIR__ . DIRECTORY_SEPARATOR . 'views',          // folder with .twig files
    cachePath: __DIR__ . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'views',  // compiled cache (writable)
    debug: true,
);

$view = new View($config);

// share globals
$view->share('appName', 'EnetFlow Billing');
$view->share('csrf', 'abc123token');
echo $view->render('welcome', [
    'title' => 'Welcome Home',
    'user' => [
        'name' => 'Mohammad Emran',
        'role' => 'Founder & CTO'
    ],
    'notifications' => ['New message from support', 'Server update completed']
]);
