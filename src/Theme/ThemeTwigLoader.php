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
    public function __construct(
        private ThemeBuilder $themeBuilder
    ) {}

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
            return $this->themeBuilder->template($name);
        } catch (\InvalidArgumentException | TemplateNotFoundException $exception) {
            throw new LoaderError($exception->getMessage(), -1, null, $exception);
        }
    }
}
