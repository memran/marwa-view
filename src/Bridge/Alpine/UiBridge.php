<?php

declare(strict_types=1);

namespace Marwa\View\Bridge\Alpine;

use Twig\Markup;

/**
 * Small HTML-safe helper for Alpine.js directives.
 *
 * It escapes for HTML attribute context only. Alpine expression semantics stay
 * under application control.
 */
final class UiBridge
{
    public function __construct(private string $charset = 'UTF-8') {}

    /**
     * @param array<mixed>|(\JsonSerializable)|string $state
     */
    public function data(array|\JsonSerializable|string $state): Markup
    {
        if (is_string($state)) {
            return $this->attribute('x-data', $state);
        }

        return $this->attribute('x-data', $this->encodeJson($state));
    }

    public function click(string $expression): Markup
    {
        return $this->on('click', $expression);
    }

    public function show(string $expression): Markup
    {
        return $this->attribute('x-show', $expression);
    }

    public function text(string $expression): Markup
    {
        return $this->attribute('x-text', $expression);
    }

    public function html(string $expression): Markup
    {
        return $this->attribute('x-html', $expression);
    }

    public function model(string $expression): Markup
    {
        return $this->attribute('x-model', $expression);
    }

    public function init(string $expression): Markup
    {
        return $this->attribute('x-init', $expression);
    }

    public function ref(string $name): Markup
    {
        return $this->attribute('x-ref', $name);
    }

    public function bind(string $attribute, string $expression): Markup
    {
        return $this->attribute(
            'x-bind:' . $this->normalizeDirectiveFragment($attribute, 'bind target'),
            $expression
        );
    }

    /**
     * @param list<string> $modifiers
     */
    public function on(string $event, string $expression, array $modifiers = []): Markup
    {
        $directive = 'x-on:' . $this->normalizeDirectiveFragment($event, 'event name');

        foreach ($modifiers as $modifier) {
            $directive .= '.' . $this->normalizeDirectiveFragment($modifier, 'event modifier');
        }

        return $this->attribute($directive, $expression);
    }

    /**
     * @param list<string> $modifiers
     */
    public function transition(array $modifiers = []): Markup
    {
        $directive = 'x-transition';

        foreach ($modifiers as $modifier) {
            $directive .= '.' . $this->normalizeDirectiveFragment($modifier, 'transition modifier');
        }

        return $this->booleanAttribute($directive);
    }

    public function cloak(): Markup
    {
        return $this->booleanAttribute('x-cloak');
    }

    private function attribute(string $name, string $value): Markup
    {
        return new Markup(
            sprintf('%s="%s"', $this->escape($name), $this->escape($value)),
            $this->charset
        );
    }

    private function booleanAttribute(string $name): Markup
    {
        return new Markup($this->escape($name), $this->charset);
    }

    private function normalizeDirectiveFragment(string $value, string $context): string
    {
        $value = trim($value);
        if ($value === '' || str_contains($value, "\0")) {
            throw new \InvalidArgumentException("Alpine {$context} cannot be empty.");
        }

        if (preg_match('/^[A-Za-z0-9:_-]+$/', $value) !== 1) {
            throw new \InvalidArgumentException("Alpine {$context} '{$value}' contains invalid characters.");
        }

        return $value;
    }

    /**
     * @param array<mixed>|\JsonSerializable $value
     */
    private function encodeJson(array|\JsonSerializable $value): string
    {
        try {
            return json_encode(
                $value,
                JSON_THROW_ON_ERROR
                | JSON_HEX_TAG
                | JSON_HEX_APOS
                | JSON_HEX_AMP
                | JSON_HEX_QUOT
            );
        } catch (\JsonException $exception) {
            throw new \InvalidArgumentException('Unable to encode Alpine x-data payload.', 0, $exception);
        }
    }

    private function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, $this->charset);
    }
}
