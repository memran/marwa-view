<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* __string_template__a0f401b250e49f04a48244c24132e979 */
class __TwigTemplate_138b7102313ca5a35a0d41386e1cfb88 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("layout.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Home · Dark Theme";
        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 6
        yield "    <div class=\"space-y-6\">
        <h1 class=\"text-2xl font-bold text-slate-100\">
            Dark Mode Activated
        </h1>

        <p class=\"text-slate-300 leading-relaxed\">
            This theme overrides layout.twig and app.css to provide a darker, more dashboard feel.
        </p>

        <div class=\"rounded-lg border border-slate-700 bg-slate-800 p-4 shadow-sm\">
            <div class=\"text-sm text-slate-400\">Debug info:</div>
            <div class=\"text-xs font-mono text-slate-200\">
                Theme: ";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["_theme_name"]) || array_key_exists("_theme_name", $context) ? $context["_theme_name"] : (function () { throw new RuntimeError('Variable "_theme_name" does not exist.', 18, $this->source); })()), "html", null, true);
        yield "<br/>
                Chain: ";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::join((isset($context["_theme_chain"]) || array_key_exists("_theme_chain", $context) ? $context["_theme_chain"] : (function () { throw new RuntimeError('Variable "_theme_chain" does not exist.', 19, $this->source); })()), " -> "), "html", null, true);
        yield "
            </div>
        </div>
    </div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "__string_template__a0f401b250e49f04a48244c24132e979";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  88 => 19,  84 => 18,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"layout.twig\" %}

{% block title %}Home · Dark Theme{% endblock %}

{% block content %}
    <div class=\"space-y-6\">
        <h1 class=\"text-2xl font-bold text-slate-100\">
            Dark Mode Activated
        </h1>

        <p class=\"text-slate-300 leading-relaxed\">
            This theme overrides layout.twig and app.css to provide a darker, more dashboard feel.
        </p>

        <div class=\"rounded-lg border border-slate-700 bg-slate-800 p-4 shadow-sm\">
            <div class=\"text-sm text-slate-400\">Debug info:</div>
            <div class=\"text-xs font-mono text-slate-200\">
                Theme: {{ _theme_name }}<br/>
                Chain: {{ _theme_chain|join(' -> ') }}
            </div>
        </div>
    </div>
{% endblock %}
", "__string_template__a0f401b250e49f04a48244c24132e979", "");
    }
}
