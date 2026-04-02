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

$requestUri = (string) ($_SERVER['REQUEST_URI'] ?? 'docs.php');
$requestPath = parse_url($requestUri, PHP_URL_PATH);
$currentPath = is_string($requestPath) && $requestPath !== '' ? $requestPath : 'docs.php';
$baseDirectory = rtrim(str_replace('\\', '/', dirname($currentPath)), '/.');
$docsUrl = ($baseDirectory === '' ? '' : $baseDirectory) . '/docs.php';
$switchThemeUrl = ($baseDirectory === '' ? '' : $baseDirectory) . '/switch-theme.php';

$view = new View(
    new ViewConfig(
        viewsPath: __DIR__ . '/themes/default/views',
        cachePath: __DIR__ . '/storage/views',
        debug: true
    ),
    [],
    $themeBuilder
);

$view->share('_theme_docs_url', $docsUrl);
$view->share('_theme_home_url', $switchThemeUrl);

echo $view->render('docs/index', [
    'sections' => [
        [
            'title' => 'Tutorials',
            'summary' => 'Step-by-step setup, rendering, namespaced views, stacks, and fragment caching.',
            'path' => 'docs/tutorials.md',
            'items' => ['Quick start', 'Renderer setup', 'Shared data', 'Namespaced views'],
        ],
        [
            'title' => 'API Reference',
            'summary' => 'Public API details for View, ViewConfig, theming, translation, and built-in helpers.',
            'path' => 'docs/api.md',
            'items' => ['View', 'ViewConfig', 'ThemeBuilder', 'TranslatorInterface'],
        ],
        [
            'title' => 'Extensions',
            'summary' => 'Built-in extension helpers for HTML, JSON, money, numbers, icons, and metadata stacks.',
            'path' => 'docs/extensions.md',
            'items' => ['HtmlExtension', 'JsonExtension', 'MoneyExtension', 'IconExtension'],
        ],
        [
            'title' => 'Themes',
            'summary' => 'Theme manifests, preview mode, apply/revert flow, and inheritance behavior.',
            'path' => 'docs/themes.md',
            'items' => ['Manifest metadata', 'ThemeBootstrap', 'Preview flow', 'Theme globals'],
        ],
        [
            'title' => 'Examples',
            'summary' => 'Runnable example entry points and local commands for manual verification.',
            'path' => 'docs/examples.md',
            'items' => ['Basic examples', 'Theme examples', 'Local server flow'],
        ],
        [
            'title' => 'Development',
            'summary' => 'Quality tooling, composer scripts, and release preparation notes.',
            'path' => 'docs/development.md',
            'items' => ['PHPUnit', 'PHPStan', 'CS Fixer', 'Release notes'],
        ],
    ],
]);
