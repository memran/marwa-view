<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Marwa\View\Theme\ThemeBootstrap;
use Marwa\View\View;
use Marwa\View\ViewConfig;

session_start();

$themeBuilder = ThemeBootstrap::initFromDirectory(
    __DIR__ . '/themes',
    'default'
);

if (!empty($_SESSION['theme_name'])) {
    $themeBuilder->useTheme((string) $_SESSION['theme_name']);
}

if (!empty($_SESSION['theme_preview'])) {
    $themeBuilder->previewTheme((string) $_SESSION['theme_preview']);
}

$requestUri = (string) ($_SERVER['REQUEST_URI'] ?? 'index.php');
$requestPath = parse_url($requestUri, PHP_URL_PATH);
$currentPath = is_string($requestPath) && $requestPath !== '' ? $requestPath : 'index.php';
$baseDirectory = rtrim(str_replace('\\', '/', dirname($currentPath)), '/.');
$themeDocsUrl = ($baseDirectory === '' ? '' : $baseDirectory) . '/docs.php';
$switchThemeUrl = ($baseDirectory === '' ? '' : $baseDirectory) . '/switch-theme.php';
$themeIndexUrl = ($baseDirectory === '' ? '' : $baseDirectory) . '/index.php';

$view = new View(
    new ViewConfig(
        viewsPath: __DIR__ . '/themes/default/views',
        cachePath: __DIR__ . '/storage/views',
        debug: true
    ),
    [],
    $themeBuilder
);

$view->share('_theme_docs_url', $themeDocsUrl);
$view->share('_theme_home_url', $themeIndexUrl);

echo $view->render('examples/index', [
    'sections' => [
        [
            'title' => 'Theme Overview',
            'summary' => 'This hub helps you browse all theme-related entry points with the current active theme applied.',
            'links' => [
                ['label' => 'Theme Demo', 'href' => ($baseDirectory === '' ? '' : $baseDirectory) . '/theme.php', 'summary' => 'Manual theme registry setup.'],
                ['label' => 'Switch Theme', 'href' => $switchThemeUrl, 'summary' => 'Preview, apply, and revert themes.'],
                ['label' => 'Admin Preview Alias', 'href' => ($baseDirectory === '' ? '' : $baseDirectory) . '/admin-theme-preview.php', 'summary' => 'Alias entry point for admin preview flow.'],
                ['label' => 'Docs Browser', 'href' => $themeDocsUrl, 'summary' => 'Browse tutorials, APIs, examples, and development notes.'],
            ],
        ],
        [
            'title' => 'Cross Navigation',
            'summary' => 'Useful shortcuts while testing locally from the `examples` web root.',
            'links' => [
                ['label' => 'Examples Root', 'href' => '/index.php', 'summary' => 'Root browser for every shipped example.'],
                ['label' => 'Basic Examples', 'href' => '/basic/index.php', 'summary' => 'Basic renderer demos and helper usage.'],
            ],
        ],
    ],
]);
