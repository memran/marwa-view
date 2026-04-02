<?php

declare(strict_types=1);

namespace Marwa\View\Tests;

use Marwa\View\Tests\Support\CreatesTemporaryFiles;
use Marwa\View\Theme\ThemeBootstrap;
use Marwa\View\Theme\ThemeBuilder;
use Marwa\View\Theme\ThemeConfig;
use Marwa\View\Theme\ThemeMetadata;
use Marwa\View\Theme\ThemeRegistry;
use Marwa\View\Theme\ThemeResolver;
use PHPUnit\Framework\TestCase;

final class ThemePublicApiTest extends TestCase
{
    use CreatesTemporaryFiles;

    protected function tearDown(): void
    {
        $this->cleanupTemporaryPaths();
    }

    public function testThemeBuilderPublicApiSupportsSelectionPreviewAndCatalog(): void
    {
        [$registry, $defaultViews, $darkViews] = $this->makeThemeRegistry();

        $builder = new ThemeBuilder($registry, new ThemeResolver(), 'default');

        self::assertSame('default', $builder->current());
        self::assertSame('default', $builder->selected());
        self::assertFalse($builder->isPreviewing());
        self::assertSame(['default', 'dark'], $builder->themes());
        self::assertSame('Default Theme', $builder->selectedConfig()->metadata()->label());
        self::assertSame('/themes/default/css/app.css', $builder->asset('css/app.css'));
        self::assertSame(realpath($defaultViews . DIRECTORY_SEPARATOR . 'home.twig') ?: $defaultViews . DIRECTORY_SEPARATOR . 'home.twig', $builder->template('home.twig'));

        $builder->previewTheme('dark');

        self::assertTrue($builder->isPreviewing());
        self::assertSame('dark', $builder->current());
        self::assertSame('default', $builder->selected());
        self::assertSame('dark', $builder->previewingTheme());
        self::assertSame(['dark', 'default'], $builder->chain());
        self::assertSame(realpath($darkViews . DIRECTORY_SEPARATOR . 'home.twig') ?: $darkViews . DIRECTORY_SEPARATOR . 'home.twig', $builder->template('home.twig'));
        self::assertSame('/themes/dark/css/app.css', $builder->asset('css/app.css'));
        self::assertCount(2, $builder->catalog());

        $builder->applyTheme('dark');

        self::assertSame('dark', $builder->current());
        self::assertSame('dark', $builder->selected());
        self::assertFalse($builder->isPreviewing());

        $builder->clearPreview();
        self::assertNull($builder->previewingTheme());
        self::assertSame($registry, $builder->registry());
    }

    public function testThemeRegistryAndConfigExposeCatalogData(): void
    {
        $path = $this->makeTempDirectory('theme-');
        $metadata = new ThemeMetadata(
            label: 'Marketing Theme',
            description: 'Landing pages',
            version: '2.0.0',
            author: 'Marwa Team',
            previewImageUrl: '/themes/marketing/preview.png',
            tags: ['marketing', 'light']
        );

        $config = new ThemeConfig('marketing', $path, null, '/themes/marketing', $metadata);
        $registry = new ThemeRegistry();
        $registry->add($config);

        self::assertTrue($registry->has('marketing'));
        self::assertSame(['marketing'], $registry->names());
        self::assertSame('Marketing Theme', $registry->get('marketing')->metadata()->label());
        self::assertSame('Marwa Team', $config->toArray()['metadata']['author']);
        self::assertSame('marketing', $registry->catalog()[0]['name']);
    }

    public function testThemeMetadataFromManifestNormalizesOptionalFields(): void
    {
        $metadata = ThemeMetadata::fromManifest('tenantA', [
            'meta' => [
                'label' => ' Tenant A ',
                'description' => '  Custom theme  ',
                'version' => ' 1.0.0 ',
                'author' => ' Team ',
                'preview_image' => ' /themes/tenantA/preview.png ',
                'tags' => [' tenant ', 'green', 'tenant'],
            ],
        ]);

        self::assertSame('Tenant A', $metadata->label());
        self::assertSame('Custom theme', $metadata->description());
        self::assertSame('1.0.0', $metadata->version());
        self::assertSame('Team', $metadata->author());
        self::assertSame('/themes/tenantA/preview.png', $metadata->previewImageUrl());
        self::assertSame(['tenant', 'green'], $metadata->tags());
    }

    public function testThemeBootstrapBuildsThemeMetadataFromManifest(): void
    {
        $themes = $this->makeTempDirectory('themes-');
        $this->writeFile($themes . '/default/manifest.php', <<<'PHP'
<?php
return [
    'name' => 'default',
    'assets_url' => '/themes/default',
    'meta' => [
        'label' => 'Default Theme',
        'description' => 'The default application theme',
    ],
];
PHP);
        $this->writeFile($themes . '/default/views/home.twig', 'home');

        $builder = ThemeBootstrap::initFromDirectory($themes, 'default');

        self::assertSame('Default Theme', $builder->currentConfig()->metadata()->label());
        self::assertSame('The default application theme', $builder->currentConfig()->metadata()->description());
    }

    /**
     * @return array{ThemeRegistry, string, string}
     */
    private function makeThemeRegistry(): array
    {
        $root = $this->makeTempDirectory('themes-');
        $defaultViews = $root . '/default';
        $darkViews = $root . '/dark';

        $this->writeFile($defaultViews . '/home.twig', 'default');
        $this->writeFile($darkViews . '/home.twig', 'dark');

        $registry = new ThemeRegistry();
        $registry->add(new ThemeConfig(
            'default',
            $defaultViews,
            null,
            '/themes/default',
            new ThemeMetadata('Default Theme', tags: ['base'])
        ));
        $registry->add(new ThemeConfig(
            'dark',
            $darkViews,
            'default',
            '/themes/dark',
            new ThemeMetadata('Dark Theme', tags: ['dark'])
        ));

        return [$registry, $defaultViews, $darkViews];
    }
}
