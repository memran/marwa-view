<?php

declare(strict_types=1);

namespace Marwa\View\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Adds small semantic status helpers for templates.
 */
final class StatusExtension extends AbstractExtension
{
    /**
     * @return array<int, TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('status_label', [$this, 'statusLabel']),
            new TwigFunction('status_variant', [$this, 'statusVariant']),
            new TwigFunction('status_classes', [$this, 'statusClasses']),
        ];
    }

    public function statusLabel(string $status): string
    {
        $normalized = $this->normalize($status);

        return match ($normalized) {
            'active' => 'Active',
            'inactive' => 'Inactive',
            'pending' => 'Pending',
            'draft' => 'Draft',
            'failed' => 'Failed',
            'archived' => 'Archived',
            default => mb_convert_case(str_replace('-', ' ', $normalized), MB_CASE_TITLE, 'UTF-8'),
        };
    }

    public function statusVariant(string $status): string
    {
        return match ($this->normalize($status)) {
            'active' => 'success',
            'pending' => 'warning',
            'failed' => 'danger',
            'draft', 'archived', 'inactive' => 'neutral',
            default => 'neutral',
        };
    }

    public function statusClasses(string $status): string
    {
        $base = 'rounded-full px-2.5 py-1 text-xs font-semibold';

        $variant = match ($this->statusVariant($status)) {
            'success' => 'bg-emerald-500/10 text-emerald-300',
            'warning' => 'bg-amber-500/10 text-amber-300',
            'danger' => 'bg-rose-500/10 text-rose-300',
            default => 'bg-slate-700/70 text-slate-300',
        };

        return $base . ' ' . $variant;
    }

    private function normalize(string $status): string
    {
        $status = mb_strtolower(trim($status));
        $status = preg_replace('/\s+/', '-', $status) ?? $status;

        return trim($status, '-');
    }
}
