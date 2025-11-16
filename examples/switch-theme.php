<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Marwa\View\Theme\ThemeBootstrap;
use Marwa\View\View;
// bootstrap once
$themeBuilder = ThemeBootstrap::initFromDirectory(
    __DIR__ . 'views/themes',
    'default'
);

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
        $themeBuilder->useTheme($_SESSION['theme_name']);
    }
}

// finally render
$view = new View($viewConfig, [], $themeBuilder);
echo $view->render('home/index', [
    'user' => $currentUser,
]);
