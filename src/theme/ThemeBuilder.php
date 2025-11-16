<?php

declare(strict_types=1);

namespace Marwa\View\Theme;

/**
 * ThemeBuilder is the main facade used by the view layer and controllers.
 *
 * It glues together:
 * - ThemeRegistry  (list of available themes)
 * - ThemeResolver  (how to find templates/assets via inheritance)
 *
 * It also tracks the "current" theme for this request/context.
 *
 * Important:
 * - This class is NOT static.
 * - You create one per request or let your DI container scope it per request.
 */
final class ThemeBuilder
{
    /** @var ThemeRegistry */
    private ThemeRegistry $registry;

    /** @var ThemeResolver */
    private ThemeResolver $resolver;

    /** @var string */
    private string $activeTheme;

    /**
     * @param ThemeRegistry $registry
     * @param ThemeResolver $resolver
     * @param string        $defaultTheme  default fallback theme name
     */
    public function __construct(
        ThemeRegistry $registry,
        ThemeResolver $resolver,
        string $defaultTheme = 'default'
    ) {
        if ($defaultTheme === '') {
            throw new \InvalidArgumentException('Default theme cannot be empty');
        }

        if (!$registry->has($defaultTheme)) {
            throw new ThemeNotFoundException(
                "Default theme '{$defaultTheme}' is not registered"
            );
        }

        $this->registry    = $registry;
        $this->resolver    = $resolver;
        $this->activeTheme = $defaultTheme;
    }

    /**
     * Get current active theme name.
     */
    public function current(): string
    {
        return $this->activeTheme;
    }

    /**
     * Switch active theme at runtime (e.g. per-tenant).
     *
     * @throws ThemeNotFoundException
     */
    public function useTheme(string $themeName): void
    {
        if ($themeName === '') {
            throw new \InvalidArgumentException('Theme name cannot be empty');
        }

        if (!$this->registry->has($themeName)) {
            throw new ThemeNotFoundException("Theme '{$themeName}' is not registered");
        }

        $this->activeTheme = $themeName;
    }

    /**
     * Resolve a template file path (absolute) for the active theme.
     * This is what we feed into Twig/Marwa\View loader.
     *
     * @throws TemplateNotFoundException
     */
    public function template(string $relativeTemplatePath): string
    {
        return $this->resolver->resolveTemplate(
            $this->registry,
            $this->activeTheme,
            $relativeTemplatePath
        );
    }

    /**
     * Get a public asset URL for the active theme.
     * Can be exposed as a Twig function `theme_asset('css/app.css')`.
     */
    public function asset(string $relativeAssetPath): string
    {
        return $this->resolver->buildAssetUrl(
            $this->registry,
            $this->activeTheme,
            $relativeAssetPath
        );
    }

    /**
     * Debug helper: return theme inheritance chain.
     * Example: ['tenantA', 'dark', 'default']
     */
    public function chain(): array
    {
        return $this->resolver->chain(
            $this->registry,
            $this->activeTheme
        );
    }

    /**
     * Expose registry for advanced usage (like listing themes in admin panel).
     */
    public function registry(): ThemeRegistry
    {
        return $this->registry;
    }
}
