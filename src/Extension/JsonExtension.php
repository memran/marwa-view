<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Adds safe JSON rendering helpers for HTML templates.
 */
final class JsonExtension extends AbstractExtension
{
    /**
     * @return array<int, TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('json', [$this, 'encode']),
            new TwigFunction('json_script', [$this, 'scriptTag'], ['is_safe' => ['html']]),
        ];
    }

    public function encode(mixed $value, int $flags = 0): string
    {
        return json_encode($value, $flags | $this->defaultFlags() | JSON_THROW_ON_ERROR, 512);
    }

    public function scriptTag(string $id, mixed $value, int $flags = 0): string
    {
        $json = $this->encode($value, $flags);
        $escapedId = htmlspecialchars($id, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

        return sprintf(
            '<script type="application/json" id="%s">%s</script>',
            $escapedId,
            $json
        );
    }

    private function defaultFlags(): int
    {
        return JSON_HEX_TAG
            | JSON_HEX_AMP
            | JSON_HEX_APOS
            | JSON_HEX_QUOT
            | JSON_UNESCAPED_UNICODE
            | JSON_UNESCAPED_SLASHES;
    }
}
