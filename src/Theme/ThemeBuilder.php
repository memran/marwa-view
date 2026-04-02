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
    private ThemeRegistry $registry;
    private ThemeResolver $resolver;
    private string $selectedTheme;
    private ?string $previewTheme = null;

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

        $this->registry = $registry;
        $this->resolver = $resolver;
        $this->selectedTheme = $defaultTheme;
    }

    /**
     * Get the theme currently used for rendering.
     * When preview mode is active this returns the preview theme.
     */
    public function current(): string
    {
        return $this->previewTheme ?? $this->selectedTheme;
    }

    /**
     * Get the persisted/selected theme name without preview overrides.
     */
    public function selected(): string
    {
        return $this->selectedTheme;
    }

    /**
     * Switch active theme at runtime (e.g. per-tenant).
     *
     * @throws ThemeNotFoundException
     */
    public function useTheme(string $themeName): void
    {
        $this->selectedTheme = $this->assertKnownTheme($themeName);
        $this->previewTheme = null;
    }

    /**
     * Alias for useTheme() when the caller wants explicit "apply" semantics.
     *
     * @throws ThemeNotFoundException
     */
    public function applyTheme(string $themeName): void
    {
        $this->useTheme($themeName);
    }

    /**
     * Enable preview mode without changing the selected theme.
     *
     * @throws ThemeNotFoundException
     */
    public function previewTheme(string $themeName): void
    {
        $themeName = $this->assertKnownTheme($themeName);
        if ($themeName === $this->selectedTheme) {
            $this->previewTheme = null;

            return;
        }

        $this->previewTheme = $themeName;
    }

    /**
     * Exit preview mode and render with the selected theme again.
     */
    public function clearPreview(): void
    {
        $this->previewTheme = null;
    }

    /**
     * Whether the builder is temporarily rendering a preview theme.
     */
    public function isPreviewing(): bool
    {
        return $this->previewTheme !== null;
    }

    /**
     * Return the preview theme name or null when preview mode is disabled.
     */
    public function previewingTheme(): ?string
    {
        return $this->previewTheme;
    }

    /**
     * Resolve a template file path (absolute) for the active theme.
     * This is what we feed into Twig/Marwa\View loader.
     *
     * @throws TemplateNotFoundException
     * @throws \InvalidArgumentException
     */
    public function template(string $relativeTemplatePath): string
    {
        return $this->resolver->resolveTemplate(
            $this->registry,
            $this->current(),
            $relativeTemplatePath
        );
    }

    /**
     * Get a public asset URL for the active theme.
     * Can be exposed as a Twig function `theme_asset('css/app.css')`.
     *
     * @throws \InvalidArgumentException
     */
    public function asset(string $relativeAssetPath): string
    {
        return $this->resolver->buildAssetUrl(
            $this->registry,
            $this->current(),
            $relativeAssetPath
        );
    }

    /**
     * Debug helper: return theme inheritance chain.
     * Example: ['tenantA', 'dark', 'default']
     *
     * @return list<string>
     */
    public function chain(): array
    {
        return $this->resolver->chain(
            $this->registry,
            $this->current()
        );
    }

    public function currentConfig(): ThemeConfig
    {
        return $this->registry->get($this->current());
    }

    public function selectedConfig(): ThemeConfig
    {
        return $this->registry->get($this->selectedTheme);
    }

    /**
     * Expose registry for advanced usage (like listing themes in admin panel).
     */
    public function registry(): ThemeRegistry
    {
        return $this->registry;
    }

    /**
     * @return list<string>
     */
    public function themes(): array
    {
        return $this->registry->names();
    }

    /**
     * @return list<array{
     *     name: string,
     *     path: string,
     *     parent: string|null,
     *     asset_base_url: string,
     *     metadata: array{
     *         label: string,
     *         description: string|null,
     *         version: string|null,
     *         author: string|null,
     *         preview_image: string|null,
     *         tags: list<string>
     *     }
     * }>
     */
    public function catalog(): array
    {
        return $this->registry->catalog();
    }

    /**
     * @throws ThemeNotFoundException
     */
    private function assertKnownTheme(string $themeName): string
    {
        $themeName = trim($themeName);
        if ($themeName === '') {
            throw new \InvalidArgumentException('Theme name cannot be empty');
        }

        if (!$this->registry->has($themeName)) {
            throw new ThemeNotFoundException("Theme '{$themeName}' is not registered");
        }

        return $themeName;
    }
}
