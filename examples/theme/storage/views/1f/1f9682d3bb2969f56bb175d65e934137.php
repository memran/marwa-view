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

/* examples/index.twig */
class __TwigTemplate_dcea7fc2e70a83f0e004606606254bdb extends Template
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
        yield "Theme Examples";
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
        yield "    <div class=\"space-y-8\">
        <section class=\"rounded-[2rem] border border-white/60 bg-white/80 p-8 shadow-xl shadow-slate-200/40\">
            <div class=\"inline-flex rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-sky-700\">
                Theme Browser
            </div>
            <h1 class=\"mt-5 text-4xl font-extrabold tracking-tight text-slate-950\">
                Browse all theme examples with the active theme applied.
            </h1>
            <p class=\"mt-4 max-w-3xl text-lg leading-8 text-slate-600\">
                Use this page as the starting point when testing runtime theme switching, preview flows, or the theme-styled documentation browser.
            </p>
            <div class=\"mt-6 flex flex-wrap gap-3\">
                <a href=\"";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("_theme_docs_url", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["_theme_docs_url"]) || array_key_exists("_theme_docs_url", $context) ? $context["_theme_docs_url"] : (function () { throw new RuntimeError('Variable "_theme_docs_url" does not exist.', 18, $this->source); })()), "docs.php")) : ("docs.php")), "html", null, true);
        yield "\" class=\"inline-flex items-center rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-slate-800\">
                    Browse Docs
                </a>
                <a href=\"/index.php\" class=\"inline-flex items-center rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow hover:bg-slate-100\">
                    Examples Root
                </a>
            </div>
        </section>

        <section class=\"space-y-6\">
            ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["sections"]) || array_key_exists("sections", $context) ? $context["sections"] : (function () { throw new RuntimeError('Variable "sections" does not exist.', 28, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["section"]) {
            // line 29
            yield "                <article class=\"rounded-[2rem] border border-slate-200/80 bg-white/75 p-8 shadow-lg shadow-slate-200/30\">
                    <h2 class=\"text-2xl font-bold tracking-tight text-slate-950\">";
            // line 30
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "title", [], "any", false, false, false, 30), "html", null, true);
            yield "</h2>
                    <p class=\"mt-3 text-sm leading-7 text-slate-600\">";
            // line 31
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "summary", [], "any", false, false, false, 31), "html", null, true);
            yield "</p>
                    <div class=\"mt-6 grid gap-4 lg:grid-cols-2\">
                        ";
            // line 33
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "links", [], "any", false, false, false, 33));
            foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
                // line 34
                yield "                            <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["link"], "href", [], "any", false, false, false, 34), "html", null, true);
                yield "\" class=\"block rounded-3xl border border-slate-200 bg-slate-50 p-5 transition hover:border-sky-300 hover:bg-white\">
                                <div class=\"text-lg font-semibold text-slate-950\">";
                // line 35
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["link"], "label", [], "any", false, false, false, 35), "html", null, true);
                yield "</div>
                                <p class=\"mt-2 text-sm leading-6 text-slate-600\">";
                // line 36
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["link"], "summary", [], "any", false, false, false, 36), "html", null, true);
                yield "</p>
                                <div class=\"mt-4 rounded-2xl bg-slate-950 px-4 py-3 text-xs font-mono text-slate-200\">
                                    ";
                // line 38
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["link"], "href", [], "any", false, false, false, 38), "html", null, true);
                yield "
                                </div>
                            </a>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['link'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 42
            yield "                    </div>
                </article>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['section'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 45
        yield "        </section>
    </div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "examples/index.twig";
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
        return array (  149 => 45,  141 => 42,  131 => 38,  126 => 36,  122 => 35,  117 => 34,  113 => 33,  108 => 31,  104 => 30,  101 => 29,  97 => 28,  84 => 18,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"layout.twig\" %}

{% block title %}Theme Examples{% endblock %}

{% block content %}
    <div class=\"space-y-8\">
        <section class=\"rounded-[2rem] border border-white/60 bg-white/80 p-8 shadow-xl shadow-slate-200/40\">
            <div class=\"inline-flex rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-sky-700\">
                Theme Browser
            </div>
            <h1 class=\"mt-5 text-4xl font-extrabold tracking-tight text-slate-950\">
                Browse all theme examples with the active theme applied.
            </h1>
            <p class=\"mt-4 max-w-3xl text-lg leading-8 text-slate-600\">
                Use this page as the starting point when testing runtime theme switching, preview flows, or the theme-styled documentation browser.
            </p>
            <div class=\"mt-6 flex flex-wrap gap-3\">
                <a href=\"{{ _theme_docs_url|default('docs.php') }}\" class=\"inline-flex items-center rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-slate-800\">
                    Browse Docs
                </a>
                <a href=\"/index.php\" class=\"inline-flex items-center rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow hover:bg-slate-100\">
                    Examples Root
                </a>
            </div>
        </section>

        <section class=\"space-y-6\">
            {% for section in sections %}
                <article class=\"rounded-[2rem] border border-slate-200/80 bg-white/75 p-8 shadow-lg shadow-slate-200/30\">
                    <h2 class=\"text-2xl font-bold tracking-tight text-slate-950\">{{ section.title }}</h2>
                    <p class=\"mt-3 text-sm leading-7 text-slate-600\">{{ section.summary }}</p>
                    <div class=\"mt-6 grid gap-4 lg:grid-cols-2\">
                        {% for link in section.links %}
                            <a href=\"{{ link.href }}\" class=\"block rounded-3xl border border-slate-200 bg-slate-50 p-5 transition hover:border-sky-300 hover:bg-white\">
                                <div class=\"text-lg font-semibold text-slate-950\">{{ link.label }}</div>
                                <p class=\"mt-2 text-sm leading-6 text-slate-600\">{{ link.summary }}</p>
                                <div class=\"mt-4 rounded-2xl bg-slate-950 px-4 py-3 text-xs font-mono text-slate-200\">
                                    {{ link.href }}
                                </div>
                            </a>
                        {% endfor %}
                    </div>
                </article>
            {% endfor %}
        </section>
    </div>
{% endblock %}
", "examples/index.twig", "/Users/memran/projects/php-projects/marwa-view/examples/theme/themes/default/views/examples/index.twig");
    }
}
