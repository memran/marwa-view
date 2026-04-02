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
}
