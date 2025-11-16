<?php

declare(strict_types=1);

namespace Marwa\View\Theme;

final class ThemeBootstrap
{
    /**
     * Initialize theming system from a base directory of themes.
     *
     * @param string $themesBaseDir Absolute path to directory that contains theme subfolders.
     *                              Example: /var/www/app/themes
     *
     * @param string $defaultTheme  Name of the default theme to activate initially.
     *
     * @return ThemeBuilder Fully configured builder (registry + resolver + active defaultTheme)
     *
     * @throws \RuntimeException|\InvalidArgumentException
     */
    public static function initFromDirectory(
        string $themesBaseDir,
        string $defaultTheme
    ): ThemeBuilder {
        if ($themesBaseDir === '' || !is_dir($themesBaseDir)) {
            throw new \InvalidArgumentException(
                "Themes base directory '{$themesBaseDir}' is invalid or does not exist"
            );
        }

        // 1. Build registry
        $registry = new ThemeRegistry();

        // 2. Scan all immediate children (one theme per subdirectory)
        $dirs = scandir($themesBaseDir);
        if ($dirs === false) {
            throw new \RuntimeException("Failed to scan themes directory '{$themesBaseDir}'");
        }

        foreach ($dirs as $dirName) {
            if ($dirName === '.' || $dirName === '..') {
                continue;
            }

            $themeDir = $themesBaseDir . DIRECTORY_SEPARATOR . $dirName;
            if (!is_dir($themeDir)) {
                continue;
            }

            // Attempt to load manifest for this theme
            $manifest = self::loadManifest($themeDir);

            if ($manifest === null) {
                // No manifest => skip silently. We only register folders with manifest.
                continue;
            }

            // Normalize manifest fields
            $themeName    = $manifest['name']        ?? $dirName;
            $parentName   = $manifest['parent']      ?? null;
            $viewsPath    = $manifest['views_path']  ?? ($themeDir . DIRECTORY_SEPARATOR . 'views');
            $assetsBase   = $manifest['assets_url']  ?? null;

            if (!is_dir($viewsPath)) {
                throw new \RuntimeException(
                    "Theme '{$themeName}' views_path '{$viewsPath}' does not exist"
                );
            }

            if (!is_string($assetsBase) || $assetsBase === '') {
                throw new \RuntimeException(
                    "Theme '{$themeName}' must define a non-empty 'assets_url' in manifest"
                );
            }

            $config = new ThemeConfig(
                name: $themeName,
                path: $viewsPath,
                parent: $parentName !== '' ? $parentName : null,
                assetBaseUrl: rtrim($assetsBase, '/')
            );

            $registry->add($config);
        }

        // 3. Build resolver
        $resolver = new ThemeResolver();

        // 4. Build ThemeBuilder with default theme active
        $builder = new ThemeBuilder(
            registry: $registry,
            resolver: $resolver,
            defaultTheme: $defaultTheme
        );

        return $builder;
    }

    /**
     * INTERNAL:
     * Try to load manifest.php or manifest.json from a theme dir.
     *
     * Returns assoc array OR null if manifest not found.
     */
    private static function loadManifest(string $themeDir): ?array
    {
        $phpManifest    = $themeDir . DIRECTORY_SEPARATOR . 'manifest.php';
        $jsonManifest   = $themeDir . DIRECTORY_SEPARATOR . 'manifest.json';

        if (is_file($phpManifest)) {
            /** @var mixed $data */
            $data = include $phpManifest;
            if (!is_array($data)) {
                throw new \RuntimeException("manifest.php in '{$themeDir}' must return array");
            }
            return $data;
        }

        if (is_file($jsonManifest)) {
            $raw = file_get_contents($jsonManifest);
            if ($raw === false) {
                throw new \RuntimeException("Failed to read manifest.json in '{$themeDir}'");
            }
            $decoded = json_decode($raw, true);
            if (!is_array($decoded)) {
                throw new \RuntimeException("manifest.json in '{$themeDir}' must decode to array");
            }
            return $decoded;
        }

        // no manifest in this folder
        return null;
    }
}
