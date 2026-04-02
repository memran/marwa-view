<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Marwa\View\Theme\ThemeBootstrap;
use Marwa\View\View;
use Marwa\View\ViewConfig;

session_start();

// bootstrap once
$themeBuilder = ThemeBootstrap::initFromDirectory(
    __DIR__ . '/views/themes',
    'default'
);

$viewConfig = new ViewConfig(
    viewsPath: __DIR__ . '/views',
    cachePath: __DIR__ . '/storage/views',
    debug: true
);

$currentUser = [
    'id' => 1,
    'name' => 'Demo User',
];

// inside request handling:
// if user submitted theme switcher form:
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && ($_POST['theme_name'] ?? '') !== ''
) {

    $requested = (string)$_POST['theme_name'];

    // this is your "public api where i will supply only theme name"
    // If the theme doesn't exist, ThemeBuilder will throw ThemeNotFoundException.
    $themeBuilder->useTheme($requested);

    // persist to session/cookie to remember selection per user, etc.
    $_SESSION['theme_name'] = $requested;
} else {
    // load previous theme from session if available
    if (!empty($_SESSION['theme_name'])) {
        $themeBuilder->useTheme((string) $_SESSION['theme_name']);
    }
}

// finally render
$view = new View($viewConfig, [], $themeBuilder);
echo $view->render('home/index', [
    'user' => $currentUser,
]);
