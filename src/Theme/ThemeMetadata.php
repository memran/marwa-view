<?php

declare(strict_types=1);

namespace Marwa\View\Theme;

/**
 * Immutable theme metadata parsed from a theme manifest.
 */
final class ThemeMetadata
{
    /**
     * @param list<string> $tags
     */
    public function __construct(
        private string $label,
        private ?string $description = null,
        private ?string $version = null,
        private ?string $author = null,
        private ?string $previewImageUrl = null,
        private array $tags = [],
    ) {}

    public function label(): string
    {
        return $this->label;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function version(): ?string
    {
        return $this->version;
    }

    public function author(): ?string
    {
        return $this->author;
    }

    public function previewImageUrl(): ?string
    {
        return $this->previewImageUrl;
    }

    /**
     * @return list<string>
     */
    public function tags(): array
    {
        return $this->tags;
    }

    /**
     * @return array{
     *     label: string,
     *     description: string|null,
     *     version: string|null,
     *     author: string|null,
     *     preview_image: string|null,
     *     tags: list<string>
     * }
     */
    public function toArray(): array
    {
        return [
            'label' => $this->label,
            'description' => $this->description,
            'version' => $this->version,
            'author' => $this->author,
            'preview_image' => $this->previewImageUrl,
            'tags' => $this->tags,
        ];
    }

    /**
     * @param array<string, mixed> $manifest
     */
    public static function fromManifest(string $themeName, array $manifest): self
    {
        $meta = $manifest['meta'] ?? [];
        if (!is_array($meta)) {
            throw new \InvalidArgumentException("Theme '{$themeName}' manifest field 'meta' must be an array");
        }

        /** @var array<string, mixed> $meta */

        $label = self::normalizeOptionalString($meta['label'] ?? $manifest['label'] ?? null) ?? $themeName;
        $description = self::normalizeOptionalString($meta['description'] ?? $manifest['description'] ?? null);
        $version = self::normalizeOptionalString($meta['version'] ?? $manifest['version'] ?? null);
        $author = self::normalizeOptionalString($meta['author'] ?? $manifest['author'] ?? null);
        $previewImageUrl = self::normalizeOptionalString($meta['preview_image'] ?? $manifest['preview_image'] ?? null);

        $tags = $meta['tags'] ?? $manifest['tags'] ?? [];
        if ($tags !== [] && !is_array($tags)) {
            throw new \InvalidArgumentException("Theme '{$themeName}' manifest field 'tags' must be an array");
        }

        $normalizedTags = [];
        foreach ($tags as $tag) {
            if (!is_string($tag)) {
                throw new \InvalidArgumentException("Theme '{$themeName}' manifest tags must be strings");
            }

            $tag = trim($tag);
            if ($tag === '') {
                continue;
            }

            $normalizedTags[] = $tag;
        }

        return new self(
            label: $label,
            description: $description,
            version: $version,
            author: $author,
            previewImageUrl: $previewImageUrl,
            tags: array_values(array_unique($normalizedTags)),
        );
    }

    private static function normalizeOptionalString(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        if (!is_string($value)) {
            throw new \InvalidArgumentException('Theme metadata values must be strings when provided');
        }

        $value = trim($value);

        return $value === '' ? null : $value;
    }
}
