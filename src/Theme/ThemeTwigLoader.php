<?php

declare(strict_types=1);

namespace Marwa\View\Theme;

use Twig\Error\LoaderError;
use Twig\Loader\LoaderInterface;
use Twig\Source;

/**
 * Twig loader backed by ThemeBuilder so Twig inheritance and includes keep
 * working while the active theme changes at runtime.
 */
final class ThemeTwigLoader implements LoaderInterface
{
    /**
     * @param array<string, string> $namespaces
     */
    public function __construct(
        private ThemeBuilder $themeBuilder,
        private array $namespaces = [],
    ) {}

    public function addNamespace(string $namespace, string $path): void
    {
        $this->namespaces[$namespace] = $path;
    }

    public function getSourceContext(string $name): Source
    {
        $path = $this->resolve($name);
        $source = file_get_contents($path);
        if ($source === false) {
            throw new LoaderError("Unable to read template '{$name}' at '{$path}'");
        }

        return new Source($source, $name, $path);
    }

    public function exists(string $name): bool
    {
        try {
            $this->resolve($name);

            return true;
        } catch (LoaderError) {
            return false;
        }
    }

    public function getCacheKey(string $name): string
    {
        return $this->themeBuilder->current() . ':' . $this->resolve($name);
    }

    public function isFresh(string $name, int $time): bool
    {
        return filemtime($this->resolve($name)) <= $time;
    }

    private function resolve(string $name): string
    {
        try {
            if (str_starts_with($name, '@')) {
                return $this->resolveNamespacedTemplate($name);
            }

            return $this->themeBuilder->template($name);
        } catch (\InvalidArgumentException | TemplateNotFoundException $exception) {
            throw new LoaderError($exception->getMessage(), -1, null, $exception);
        }
    }

    private function resolveNamespacedTemplate(string $name): string
    {
        if (!preg_match('/^@([A-Za-z][A-Za-z0-9_]*)\/(.+)$/', $name, $matches)) {
            throw new LoaderError("Invalid namespaced template '{$name}'.");
        }

        $namespace = $matches[1];
        $relativePath = $matches[2];
        $basePath = $this->namespaces[$namespace] ?? null;
        if ($basePath === null) {
            throw new LoaderError("View namespace '{$namespace}' is not registered.");
        }

        $segments = [];
        foreach (explode('/', str_replace('\\', '/', $relativePath)) as $segment) {
            if ($segment === '' || $segment === '.') {
                continue;
            }

            if ($segment === '..' || str_contains($segment, "\0")) {
                throw new LoaderError("Invalid namespaced template path '{$name}'.");
            }

            $segments[] = $segment;
        }

        if ($segments === []) {
            throw new LoaderError("Invalid namespaced template path '{$name}'.");
        }

        $candidate = $basePath . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $segments);
        if (!is_file($candidate)) {
            throw new LoaderError("Namespaced template '{$name}' was not found.");
        }

        return $candidate;
    }
}
