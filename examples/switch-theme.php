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
// support both "preview" and "apply" flows from the same form.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = (string) ($_POST['theme_action'] ?? 'apply');
    $requested = (string) ($_POST['theme_name'] ?? '');

    if ($action === 'clear-preview') {
        $themeBuilder->clearPreview();
        unset($_SESSION['theme_preview']);
    } elseif ($requested !== '') {
        if ($action === 'preview') {
            $themeBuilder->previewTheme($requested);
            $_SESSION['theme_preview'] = $themeBuilder->previewingTheme();
        } else {
            $themeBuilder->applyTheme($requested);
            $_SESSION['theme_name'] = $themeBuilder->selected();
            unset($_SESSION['theme_preview']);
        }
    }
} else {
    if (!empty($_SESSION['theme_name'])) {
        $themeBuilder->useTheme((string) $_SESSION['theme_name']);
    }

    if (!empty($_SESSION['theme_preview'])) {
        $themeBuilder->previewTheme((string) $_SESSION['theme_preview']);
    }
}

// finally render
$view = new View($viewConfig, [], $themeBuilder);
echo $view->render('home/index', [
    'user' => $currentUser,
]);
