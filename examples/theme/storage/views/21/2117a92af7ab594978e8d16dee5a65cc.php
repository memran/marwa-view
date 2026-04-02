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

/* home/index.twig */
class __TwigTemplate_06ec281d8aff53d71c5eec4127d4db15 extends Template
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
        yield "Home · Default Theme";
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
        yield "    <div class=\"grid gap-6 lg:grid-cols-[1.15fr_0.85fr]\">
        <section class=\"rounded-[2rem] border border-white/60 bg-white/80 p-8 shadow-xl shadow-slate-200/40\">
            <div class=\"inline-flex rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-sky-700\">
                Default Theme
            </div>
            <h1 class=\"mt-5 text-4xl font-extrabold tracking-tight text-slate-950\">
                Clean, calm, and ready for customer-facing dashboards.
            </h1>
            <p class=\"mt-4 text-lg leading-8 text-slate-600\">
                This theme is intentionally neutral and polished. It works as a sensible base for product UIs, admin panels, and branded tenant overrides.
            </p>

            <div class=\"mt-8 grid gap-4 sm:grid-cols-3\">
                <div class=\"rounded-3xl border border-slate-200 bg-slate-50 p-4\">
                    <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">Focus</div>
                    <div class=\"mt-2 font-semibold text-slate-900\">Clarity</div>
                </div>
                <div class=\"rounded-3xl border border-slate-200 bg-slate-50 p-4\">
                    <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">Mood</div>
                    <div class=\"mt-2 font-semibold text-slate-900\">Professional</div>
                </div>
                <div class=\"rounded-3xl border border-slate-200 bg-slate-50 p-4\">
                    <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">Use Case</div>
                    <div class=\"mt-2 font-semibold text-slate-900\">Base Theme</div>
                </div>
            </div>
        </section>

        <section class=\"rounded-[2rem] border border-slate-200/80 bg-white/75 p-8 shadow-lg shadow-slate-200/30\">
            <h2 class=\"text-lg font-semibold text-slate-950\">Debug Info</h2>
            <div class=\"mt-4 rounded-3xl bg-slate-950 px-5 py-4 text-xs font-mono leading-7 text-slate-200\">
                Theme: ";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["_theme_name"]) || array_key_exists("_theme_name", $context) ? $context["_theme_name"] : (function () { throw new RuntimeError('Variable "_theme_name" does not exist.', 37, $this->source); })()), "html", null, true);
        yield "<br/>
                Chain: ";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::join((isset($context["_theme_chain"]) || array_key_exists("_theme_chain", $context) ? $context["_theme_chain"] : (function () { throw new RuntimeError('Variable "_theme_chain" does not exist.', 38, $this->source); })()), " -> "), "html", null, true);
        yield "
            </div>
        </section>
    </div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "home/index.twig";
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
        return array (  107 => 38,  103 => 37,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"layout.twig\" %}

{% block title %}Home · Default Theme{% endblock %}

{% block content %}
    <div class=\"grid gap-6 lg:grid-cols-[1.15fr_0.85fr]\">
        <section class=\"rounded-[2rem] border border-white/60 bg-white/80 p-8 shadow-xl shadow-slate-200/40\">
            <div class=\"inline-flex rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-sky-700\">
                Default Theme
            </div>
            <h1 class=\"mt-5 text-4xl font-extrabold tracking-tight text-slate-950\">
                Clean, calm, and ready for customer-facing dashboards.
            </h1>
            <p class=\"mt-4 text-lg leading-8 text-slate-600\">
                This theme is intentionally neutral and polished. It works as a sensible base for product UIs, admin panels, and branded tenant overrides.
            </p>

            <div class=\"mt-8 grid gap-4 sm:grid-cols-3\">
                <div class=\"rounded-3xl border border-slate-200 bg-slate-50 p-4\">
                    <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">Focus</div>
                    <div class=\"mt-2 font-semibold text-slate-900\">Clarity</div>
                </div>
                <div class=\"rounded-3xl border border-slate-200 bg-slate-50 p-4\">
                    <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">Mood</div>
                    <div class=\"mt-2 font-semibold text-slate-900\">Professional</div>
                </div>
                <div class=\"rounded-3xl border border-slate-200 bg-slate-50 p-4\">
                    <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">Use Case</div>
                    <div class=\"mt-2 font-semibold text-slate-900\">Base Theme</div>
                </div>
            </div>
        </section>

        <section class=\"rounded-[2rem] border border-slate-200/80 bg-white/75 p-8 shadow-lg shadow-slate-200/30\">
            <h2 class=\"text-lg font-semibold text-slate-950\">Debug Info</h2>
            <div class=\"mt-4 rounded-3xl bg-slate-950 px-5 py-4 text-xs font-mono leading-7 text-slate-200\">
                Theme: {{ _theme_name }}<br/>
                Chain: {{ _theme_chain|join(' -> ') }}
            </div>
        </section>
    </div>
{% endblock %}
", "home/index.twig", "/Users/memran/projects/php-projects/marwa-view/examples/theme/themes/default/views/home/index.twig");
    }
}
