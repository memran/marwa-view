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

/* docs/index.twig */
class __TwigTemplate_7b7d56a951f4f4fc1f7b632874bea10b extends Template
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
        yield "Documentation Browser";
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
                Documentation
            </div>
            <h1 class=\"mt-5 text-4xl font-extrabold tracking-tight text-slate-950\">
                Browse tutorials, API notes, examples, and development guides.
            </h1>
            <p class=\"mt-4 max-w-3xl text-lg leading-8 text-slate-600\">
                This page mirrors the repository documentation structure and helps theme demos point to all major learning and reference material from a single place.
            </p>
            <div class=\"mt-6 flex flex-wrap gap-3\">
                <a href=\"";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("_theme_home_url", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["_theme_home_url"]) || array_key_exists("_theme_home_url", $context) ? $context["_theme_home_url"] : (function () { throw new RuntimeError('Variable "_theme_home_url" does not exist.', 18, $this->source); })()), "switch-theme.php")) : ("switch-theme.php")), "html", null, true);
        yield "\" class=\"inline-flex items-center rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-slate-800\">
                    Back to Theme Demo
                </a>
                <span class=\"inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600\">
                    Source index: <code class=\"ml-2 font-mono text-slate-900\">docs/README.md</code>
                </span>
            </div>
        </section>

        <section class=\"grid gap-6 lg:grid-cols-2\">
            ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["sections"]) || array_key_exists("sections", $context) ? $context["sections"] : (function () { throw new RuntimeError('Variable "sections" does not exist.', 28, $this->source); })()));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["section"]) {
            // line 29
            yield "                <article class=\"rounded-[2rem] border border-slate-200/80 bg-white/75 p-8 shadow-lg shadow-slate-200/30\">
                    <div class=\"flex items-start justify-between gap-4\">
                        <div>
                            <h2 class=\"text-2xl font-bold tracking-tight text-slate-950\">";
            // line 32
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "title", [], "any", false, false, false, 32), "html", null, true);
            yield "</h2>
                            <p class=\"mt-3 text-sm leading-7 text-slate-600\">";
            // line 33
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "summary", [], "any", false, false, false, 33), "html", null, true);
            yield "</p>
                        </div>
                        <span class=\"rounded-full bg-slate-100 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-500\">
                            ";
            // line 36
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 36), "html", null, true);
            yield "
                        </span>
                    </div>

                    <div class=\"mt-5 rounded-3xl bg-slate-950 px-5 py-4 text-xs font-mono leading-7 text-slate-200\">
                        ";
            // line 41
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "path", [], "any", false, false, false, 41), "html", null, true);
            yield "
                    </div>

                    <ul class=\"mt-5 space-y-3 text-sm leading-6 text-slate-700\">
                        ";
            // line 45
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "items", [], "any", false, false, false, 45));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 46
                yield "                            <li class=\"rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["item"], "html", null, true);
                yield "</li>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 48
            yield "                    </ul>
                </article>
            ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['section'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 51
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
        return "docs/index.twig";
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
        return array (  173 => 51,  157 => 48,  148 => 46,  144 => 45,  137 => 41,  129 => 36,  123 => 33,  119 => 32,  114 => 29,  97 => 28,  84 => 18,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"layout.twig\" %}

{% block title %}Documentation Browser{% endblock %}

{% block content %}
    <div class=\"space-y-8\">
        <section class=\"rounded-[2rem] border border-white/60 bg-white/80 p-8 shadow-xl shadow-slate-200/40\">
            <div class=\"inline-flex rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-sky-700\">
                Documentation
            </div>
            <h1 class=\"mt-5 text-4xl font-extrabold tracking-tight text-slate-950\">
                Browse tutorials, API notes, examples, and development guides.
            </h1>
            <p class=\"mt-4 max-w-3xl text-lg leading-8 text-slate-600\">
                This page mirrors the repository documentation structure and helps theme demos point to all major learning and reference material from a single place.
            </p>
            <div class=\"mt-6 flex flex-wrap gap-3\">
                <a href=\"{{ _theme_home_url|default('switch-theme.php') }}\" class=\"inline-flex items-center rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-slate-800\">
                    Back to Theme Demo
                </a>
                <span class=\"inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600\">
                    Source index: <code class=\"ml-2 font-mono text-slate-900\">docs/README.md</code>
                </span>
            </div>
        </section>

        <section class=\"grid gap-6 lg:grid-cols-2\">
            {% for section in sections %}
                <article class=\"rounded-[2rem] border border-slate-200/80 bg-white/75 p-8 shadow-lg shadow-slate-200/30\">
                    <div class=\"flex items-start justify-between gap-4\">
                        <div>
                            <h2 class=\"text-2xl font-bold tracking-tight text-slate-950\">{{ section.title }}</h2>
                            <p class=\"mt-3 text-sm leading-7 text-slate-600\">{{ section.summary }}</p>
                        </div>
                        <span class=\"rounded-full bg-slate-100 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-500\">
                            {{ loop.index }}
                        </span>
                    </div>

                    <div class=\"mt-5 rounded-3xl bg-slate-950 px-5 py-4 text-xs font-mono leading-7 text-slate-200\">
                        {{ section.path }}
                    </div>

                    <ul class=\"mt-5 space-y-3 text-sm leading-6 text-slate-700\">
                        {% for item in section.items %}
                            <li class=\"rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3\">{{ item }}</li>
                        {% endfor %}
                    </ul>
                </article>
            {% endfor %}
        </section>
    </div>
{% endblock %}
", "docs/index.twig", "/Users/memran/projects/php-projects/marwa-view/examples/theme/themes/default/views/docs/index.twig");
    }
}
