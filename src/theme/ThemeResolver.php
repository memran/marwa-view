<?php

declare(strict_types=1);

namespace Marwa\View\Theme;

use Marwa\View\Support\Path;

/**
 * ThemeResolver can locate template files and asset URLs
 * using the inheritance chain of themes.
 *
 * This class has no mutable state. Stateless/pure.
 */
final class ThemeResolver
{
    /**
     * Try to locate a template file within a theme chain.
     *
     * Example:
     *   $this->resolveTemplate($registry, "tenantA", "profile.twig");
     *
     * Steps:
     *   1. check /themes/tenantA/profile.twig
     *   2. if not found and tenantA extends "default", check /themes/default/profile.twig
     *
     * @throws TemplateNotFoundException
     */
    public function resolveTemplate(
        ThemeRegistry $registry,
        string $themeName,
        string $relativeTemplatePath
    ): string {
        $visited = [];

        $current = $themeName;
        while ($current !== null) {
            if (isset($visited[$current])) {
                // prevent circular parent loops
                throw new \RuntimeException("Circular theme inheritance detected at '{$current}'");
            }
            $visited[$current] = true;

            $theme = $registry->get($current);

            $candidate = $theme->path()
                . DIRECTORY_SEPARATOR
                . ltrim($relativeTemplatePath, DIRECTORY_SEPARATOR);

            if (is_file($candidate)) {
                return $candidate;
            }

            $current = $theme->parent();
        }

        throw new TemplateNotFoundException(
            "Template '{$relativeTemplatePath}' not found for theme '{$themeName}'"
        );
    }

    /**
     * Build asset URL for a given file relative to the theme.
     * We DO NOT check filesystem existence here (CDN, etc.).
     *
     * Example output: /themes/tenantA/css/app.css
     */
    public function buildAssetUrl(ThemeRegistry $registry, string $themeName, string $relativeAssetPath): string
    {
        $theme = $registry->get($themeName);
        return Path::toUrl($theme->assetBaseUrl() . '/' . ltrim($relativeAssetPath, '/'));
    }


    /**
     * Return array of inheritance chain from child -> ... -> root.
     * Helpful for debugging or for external code that wants to scan all paths.
     *
     * Example: ['tenantA', 'dark', 'default']
     */
    public function chain(ThemeRegistry $registry, string $themeName): array
    {
        $chain = [];
        $visited = [];

        $current = $themeName;
        while ($current !== null) {
            if (isset($visited[$current])) {
                throw new \RuntimeException("Circular theme inheritance at '{$current}'");
            }
            $visited[$current] = true;

            $chain[] = $current;
            $current = $registry->get($current)->parent();
        }

        return $chain;
    }
}
