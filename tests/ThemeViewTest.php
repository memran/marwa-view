<?php

declare(strict_types=1);

namespace Marwa\View\Tests;

use Marwa\View\Tests\Support\CreatesTemporaryFiles;
use Marwa\View\Theme\ThemeBootstrap;
use Marwa\View\View;
use Marwa\View\ViewConfig;
use PHPUnit\Framework\TestCase;

final class ThemeViewTest extends TestCase
{
    use CreatesTemporaryFiles;

    protected function tearDown(): void
    {
        $this->cleanupTemporaryPaths();
    }

    public function testThemedRenderingSupportsExtendsAndInheritedTemplateFallback(): void
    {
        $themes = $this->makeTempDirectory('themes-');
        $cache = $this->makeTempDirectory('cache-');

        $this->writeFile($themes . '/default/manifest.php', <<<'PHP'
<?php
return [
    'name' => 'default',
    'assets_url' => '/themes/default',
];
PHP);
        $this->writeFile($themes . '/default/views/layout.twig', 'Layout {{ _theme_name }} {% block content %}{% endblock %}');
        $this->writeFile($themes . '/default/views/home/index.twig', '{% extends "layout.twig" %}{% block content %}Default{% endblock %}');

        $this->writeFile($themes . '/tenantA/manifest.php', <<<'PHP'
<?php
return [
    'name' => 'tenantA',
    'parent' => 'default',
    'assets_url' => '/themes/tenantA',
];
PHP);
        $this->writeFile($themes . '/tenantA/views/home/index.twig', '{% extends "layout.twig" %}{% block content %}Tenant {{ theme_asset("css/app.css") }}{% endblock %}');

        $themeBuilder = ThemeBootstrap::initFromDirectory($themes, 'default');
        $themeBuilder->useTheme('tenantA');

        $view = new View(
            new ViewConfig($themes . '/default/views', $cache, true),
            [],
            $themeBuilder
        );

        $output = $view->render('home/index');

        self::assertSame('Layout tenantA Tenant /themes/tenantA/css/app.css', $output);
    }

    public function testPreviewModeUsesPreviewThemeWithoutChangingSelectedTheme(): void
    {
        $themes = $this->makeTempDirectory('themes-');
        $cache = $this->makeTempDirectory('cache-');

        $this->writeFile($themes . '/default/manifest.php', <<<'PHP'
<?php
return [
    'name' => 'default',
    'assets_url' => '/themes/default',
];
PHP);
        $this->writeFile($themes . '/default/views/home/index.twig', 'selected={{ _theme_selected }} current={{ _theme_name }} preview={{ _theme_preview ?: "none" }} active={{ _theme_previewing ? "yes" : "no" }}');

        $this->writeFile($themes . '/dark/manifest.php', <<<'PHP'
<?php
return [
    'name' => 'dark',
    'parent' => 'default',
    'assets_url' => '/themes/dark',
];
PHP);
        $this->writeFile($themes . '/dark/views/home/index.twig', 'selected={{ _theme_selected }} current={{ _theme_name }} preview={{ _theme_preview ?: "none" }} active={{ _theme_previewing ? "yes" : "no" }}');

        $themeBuilder = ThemeBootstrap::initFromDirectory($themes, 'default');
        $themeBuilder->previewTheme('dark');

        $view = new View(
            new ViewConfig($themes . '/default/views', $cache, true),
            [],
            $themeBuilder
        );

        self::assertSame('selected=default current=dark preview=dark active=yes', $view->render('home/index'));

        $themeBuilder->clearPreview();

        self::assertSame('selected=default current=default preview=none active=no', $view->render('home/index'));
    }

    public function testManifestMetadataIsAvailableInThemeContext(): void
    {
        $themes = $this->makeTempDirectory('themes-');
        $cache = $this->makeTempDirectory('cache-');

        $this->writeFile($themes . '/default/manifest.php', <<<'PHP'
<?php
return [
    'name' => 'default',
    'assets_url' => '/themes/default',
    'meta' => [
        'label' => 'Default Theme',
        'description' => 'Primary light theme',
        'version' => '1.0.0',
        'author' => 'Marwa Team',
        'preview_image' => '/themes/default/preview.png',
        'tags' => ['light', 'core'],
    ],
];
PHP);
        $this->writeFile($themes . '/default/views/home/index.twig', '{{ _theme_meta.label }}|{{ _theme_meta.author }}|{{ _theme_catalog|length }}|{{ _theme_catalog[0].metadata.tags|join(",") }}');

        $themeBuilder = ThemeBootstrap::initFromDirectory($themes, 'default');

        $view = new View(
            new ViewConfig($themes . '/default/views', $cache, true),
            [],
            $themeBuilder
        );

        self::assertSame('Default Theme|Marwa Team|1|light,core', $view->render('home/index'));
    }

    public function testThemeModeCanRenderNamespacedModuleViews(): void
    {
        $themes = $this->makeTempDirectory('themes-');
        $cache = $this->makeTempDirectory('cache-');
        $moduleViews = $this->makeTempDirectory('module-views-');

        $this->writeFile($themes . '/default/manifest.php', <<<'PHP'
<?php
return [
    'name' => 'default',
    'assets_url' => '/themes/default',
];
PHP);
        $this->writeFile($themes . '/default/views/home/index.twig', '{{ view("@Admin/toolbar", { title: "Control Panel" })|raw }}');
        $this->writeFile($moduleViews . '/toolbar.twig', '<nav>{{ title }}</nav>');

        $view = new View(
            new ViewConfig($themes . '/default/views', $cache, true, null, ['Admin' => $moduleViews]),
            [],
            ThemeBootstrap::initFromDirectory($themes, 'default')
        );

        self::assertSame('<nav>Control Panel</nav>', $view->render('home/index'));
    }
}
