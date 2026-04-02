<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Marwa\View\Theme\ThemeBootstrap;
use Marwa\View\View;
use Marwa\View\ViewConfig;

session_start();

// bootstrap once
$themeBuilder = ThemeBootstrap::initFromDirectory(
    __DIR__ . '/themes',
    'default'
);

$viewConfig = new ViewConfig(
    viewsPath: __DIR__ . '/themes/default/views',
    cachePath: __DIR__ . '/storage/views',
    debug: true
);

$currentUser = [
    'id' => 1,
    'name' => 'Taylor Reed',
];

$requestMethod = (string) ($_SERVER['REQUEST_METHOD'] ?? 'GET');
$requestUri = (string) ($_SERVER['REQUEST_URI'] ?? 'switch-theme.php');
$requestPath = parse_url($requestUri, PHP_URL_PATH);
$themeFormAction = is_string($requestPath) && $requestPath !== ''
    ? $requestPath
    : 'switch-theme.php';
$baseDirectory = rtrim(str_replace('\\', '/', dirname($themeFormAction)), '/.');
$themeDocsUrl = ($baseDirectory === '' ? '' : $baseDirectory) . '/docs.php';

// inside request handling:
// support both "preview" and "apply" flows from the same form.
if ($requestMethod === 'POST') {
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
$view->share('_theme_form_action', $themeFormAction);
$view->share('_theme_home_url', $themeFormAction);
$view->share('_theme_docs_url', $themeDocsUrl);

echo $view->render('home/index', [
    'user' => $currentUser,
]);
