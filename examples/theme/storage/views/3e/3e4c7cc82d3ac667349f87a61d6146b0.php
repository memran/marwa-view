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
class __TwigTemplate_3e2d73ad7c63d987d8718ac04e67b6ec extends Template
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
        yield "Home · Tenant A";
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
        <section class=\"rounded-[2rem] border border-emerald-500/20 bg-slate-900/70 p-8 shadow-2xl shadow-black/20\">
            <div class=\"flex items-center gap-4\">
            <img src=\"";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('theme_asset')->getCallable()("images/logo-tenantA.svg"), "html", null, true);
        yield "\"
                 alt=\"Tenant A Logo\"
                 class=\"h-12 w-12 rounded-2xl ring-2 ring-emerald-500 bg-slate-800 p-1.5\" />
                <div>
                    <div class=\"text-xs font-semibold uppercase tracking-[0.24em] text-emerald-300\">Tenant Override</div>
                    <h1 class=\"mt-2 text-4xl font-extrabold tracking-tight text-slate-100\">
                        Tenant A Dashboard
                    </h1>
                </div>
            </div>

            <p class=\"mt-5 text-lg leading-8 text-slate-300\">
                This tenant inherits the dark foundation but customizes its logo, accent color, and homepage content. It demonstrates how independent branding can sit on top of a shared theme chain.
            </p>

            <div class=\"mt-8 flex flex-wrap gap-3\">
                <button class=\"inline-flex items-center rounded-full bg-emerald-500 px-5 py-3 text-sm font-semibold text-slate-950 shadow-lg shadow-emerald-500/20\">
                    Tenant A Primary Action
                </button>
                <button class=\"inline-flex items-center rounded-full border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-slate-100\">
                    View Theme Metadata
                </button>
            </div>
        </section>

        <section class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-8 shadow-xl shadow-black/20\">
            <h2 class=\"text-lg font-semibold text-slate-100\">Debug Info</h2>
            <div class=\"mt-4 rounded-3xl bg-black/30 px-5 py-4 text-xs font-mono leading-7 text-slate-200\">
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
        return array (  110 => 38,  106 => 37,  75 => 9,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"layout.twig\" %}

{% block title %}Home · Tenant A{% endblock %}

{% block content %}
    <div class=\"grid gap-6 lg:grid-cols-[1.15fr_0.85fr]\">
        <section class=\"rounded-[2rem] border border-emerald-500/20 bg-slate-900/70 p-8 shadow-2xl shadow-black/20\">
            <div class=\"flex items-center gap-4\">
            <img src=\"{{ theme_asset('images/logo-tenantA.svg') }}\"
                 alt=\"Tenant A Logo\"
                 class=\"h-12 w-12 rounded-2xl ring-2 ring-emerald-500 bg-slate-800 p-1.5\" />
                <div>
                    <div class=\"text-xs font-semibold uppercase tracking-[0.24em] text-emerald-300\">Tenant Override</div>
                    <h1 class=\"mt-2 text-4xl font-extrabold tracking-tight text-slate-100\">
                        Tenant A Dashboard
                    </h1>
                </div>
            </div>

            <p class=\"mt-5 text-lg leading-8 text-slate-300\">
                This tenant inherits the dark foundation but customizes its logo, accent color, and homepage content. It demonstrates how independent branding can sit on top of a shared theme chain.
            </p>

            <div class=\"mt-8 flex flex-wrap gap-3\">
                <button class=\"inline-flex items-center rounded-full bg-emerald-500 px-5 py-3 text-sm font-semibold text-slate-950 shadow-lg shadow-emerald-500/20\">
                    Tenant A Primary Action
                </button>
                <button class=\"inline-flex items-center rounded-full border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-slate-100\">
                    View Theme Metadata
                </button>
            </div>
        </section>

        <section class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-8 shadow-xl shadow-black/20\">
            <h2 class=\"text-lg font-semibold text-slate-100\">Debug Info</h2>
            <div class=\"mt-4 rounded-3xl bg-black/30 px-5 py-4 text-xs font-mono leading-7 text-slate-200\">
                Theme: {{ _theme_name }}<br/>
                Chain: {{ _theme_chain|join(' -> ') }}
            </div>
        </section>
    </div>
{% endblock %}
", "home/index.twig", "/Users/memran/projects/php-projects/marwa-view/examples/theme/themes/tenantA/views/home/index.twig");
    }
}
