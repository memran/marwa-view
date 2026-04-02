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

/* layout.twig */
class __TwigTemplate_19c199d05a1a7649c8a79050d2678234 extends Template
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

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\" class=\"h-full\">
<head>
    <meta charset=\"utf-8\" />
    <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\" />

    <title>";
        // line 7
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>

    <script src=\"https://cdn.tailwindcss.com\"></script>
    <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
    <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
    <link href=\"https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap\" rel=\"stylesheet\">

    <link rel=\"stylesheet\" href=\"";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('theme_asset')->getCallable()("css/app.css"), "html", null, true);
        yield "\"/>

    <style>
        :root { color-scheme: light; }
        body { font-family: 'Manrope', system-ui, sans-serif; }
        code, pre { font-family: 'JetBrains Mono', monospace; }
        .theme-fade {
            transition: all .2s ease;
        }
    </style>
</head>
<body class=\"min-h-full bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.14),_transparent_28%),linear-gradient(180deg,_#f8fafc_0%,_#eef2ff_35%,_#f8fafc_100%)] text-gray-900 theme-fade\">
    <div class=\"absolute inset-x-0 top-0 -z-10 h-80 bg-[radial-gradient(circle,_rgba(125,211,252,0.28),_transparent_55%)] blur-3xl\"></div>
    <header class=\"site-header border-b border-slate-200/80 bg-white/75 backdrop-blur\">
        <div class=\"mx-auto max-w-7xl px-4 py-5 flex flex-col gap-4 md:flex-row md:items-start md:justify-between\">
            <div class=\"flex items-center gap-4\">
                <div class=\"flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-sky-500 to-blue-700 text-sm font-extrabold text-white shadow-sm shadow-sky-200/60\">
                    MV
                </div>
                <div>
                    <div class=\"text-xs font-semibold uppercase tracking-[0.24em] text-slate-500\">Current Theme</div>
                    <div class=\"mt-1 text-lg font-semibold text-slate-950\">
                        ";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["_theme_meta"]) || array_key_exists("_theme_meta", $context) ? $context["_theme_meta"] : (function () { throw new RuntimeError('Variable "_theme_meta" does not exist.', 36, $this->source); })()), "label", [], "any", false, false, false, 36), "html", null, true);
        yield "
                        ";
        // line 37
        if ((($tmp = (isset($context["_theme_previewing"]) || array_key_exists("_theme_previewing", $context) ? $context["_theme_previewing"] : (function () { throw new RuntimeError('Variable "_theme_previewing" does not exist.', 37, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 38
            yield "                            <span class=\"rounded-full bg-amber-100 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide text-amber-800\">Preview</span>
                        ";
        }
        // line 40
        yield "                    </div>
                    ";
        // line 41
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["_theme_meta"]) || array_key_exists("_theme_meta", $context) ? $context["_theme_meta"] : (function () { throw new RuntimeError('Variable "_theme_meta" does not exist.', 41, $this->source); })()), "description", [], "any", false, false, false, 41)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 42
            yield "                        <div class=\"text-sm text-slate-600\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["_theme_meta"]) || array_key_exists("_theme_meta", $context) ? $context["_theme_meta"] : (function () { throw new RuntimeError('Variable "_theme_meta" does not exist.', 42, $this->source); })()), "description", [], "any", false, false, false, 42), "html", null, true);
            yield "</div>
                    ";
        }
        // line 44
        yield "                    <div class=\"mt-1 text-[11px] text-slate-400\">
                        Chain: ";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::join((isset($context["_theme_chain"]) || array_key_exists("_theme_chain", $context) ? $context["_theme_chain"] : (function () { throw new RuntimeError('Variable "_theme_chain" does not exist.', 45, $this->source); })()), " -> "), "html", null, true);
        yield "
                    </div>
                    <div class=\"mt-3 flex flex-wrap gap-2\">
                        <a href=\"";
        // line 48
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("_theme_home_url", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["_theme_home_url"]) || array_key_exists("_theme_home_url", $context) ? $context["_theme_home_url"] : (function () { throw new RuntimeError('Variable "_theme_home_url" does not exist.', 48, $this->source); })()), "switch-theme.php")) : ("switch-theme.php")), "html", null, true);
        yield "\" class=\"inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-700 hover:bg-slate-100\">
                            Theme Demo
                        </a>
                        <a href=\"";
        // line 51
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("_theme_docs_url", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["_theme_docs_url"]) || array_key_exists("_theme_docs_url", $context) ? $context["_theme_docs_url"] : (function () { throw new RuntimeError('Variable "_theme_docs_url" does not exist.', 51, $this->source); })()), "docs.php")) : ("docs.php")), "html", null, true);
        yield "\" class=\"inline-flex items-center rounded-full border border-sky-200 bg-sky-50 px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.18em] text-sky-700 hover:bg-sky-100\">
                            Browse Docs
                        </a>
                    </div>
                </div>
            </div>

            <div class=\"w-full max-w-3xl rounded-[1.75rem] border border-slate-200/80 bg-white/80 p-4 shadow-xl shadow-slate-200/40\">
                <div class=\"mb-3 flex items-center justify-between gap-4\">
                    <div>
                        <div class=\"text-xs font-semibold uppercase tracking-[0.24em] text-slate-500\">Admin Theme Workflow</div>
                        <div class=\"mt-1 text-sm text-slate-600\">Preview without saving, then apply or revert.</div>
                    </div>
                    ";
        // line 64
        if ((($tmp = (isset($context["_theme_previewing"]) || array_key_exists("_theme_previewing", $context) ? $context["_theme_previewing"] : (function () { throw new RuntimeError('Variable "_theme_previewing" does not exist.', 64, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 65
            yield "                        <div class=\"text-[11px] text-amber-700\">
                            Saved: <strong>";
            // line 66
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["_theme_selected_meta"]) || array_key_exists("_theme_selected_meta", $context) ? $context["_theme_selected_meta"] : (function () { throw new RuntimeError('Variable "_theme_selected_meta" does not exist.', 66, $this->source); })()), "label", [], "any", false, false, false, 66), "html", null, true);
            yield "</strong>
                        </div>
                    ";
        }
        // line 69
        yield "                </div>

                <div class=\"grid gap-3 md:grid-cols-2\">
                    ";
        // line 72
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["_theme_catalog"]) || array_key_exists("_theme_catalog", $context) ? $context["_theme_catalog"] : (function () { throw new RuntimeError('Variable "_theme_catalog" does not exist.', 72, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["theme"]) {
            // line 73
            yield "                        <form method=\"post\" action=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("_theme_form_action", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["_theme_form_action"]) || array_key_exists("_theme_form_action", $context) ? $context["_theme_form_action"] : (function () { throw new RuntimeError('Variable "_theme_form_action" does not exist.', 73, $this->source); })()), "switch-theme.php")) : ("switch-theme.php")), "html", null, true);
            yield "\" class=\"rounded-3xl border border-slate-200 bg-white p-4 shadow-sm\">
                            <input type=\"hidden\" name=\"theme_name\" value=\"";
            // line 74
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "name", [], "any", false, false, false, 74), "html", null, true);
            yield "\">
                            <div class=\"flex h-full flex-col justify-between gap-4\">
                                <div>
                                    <div class=\"flex items-center justify-between gap-3\">
                                        <div class=\"font-semibold text-sm text-slate-950\">";
            // line 78
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 78), "label", [], "any", false, false, false, 78), "html", null, true);
            yield "</div>
                                        ";
            // line 79
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "name", [], "any", false, false, false, 79) == (isset($context["_theme_name"]) || array_key_exists("_theme_name", $context) ? $context["_theme_name"] : (function () { throw new RuntimeError('Variable "_theme_name" does not exist.', 79, $this->source); })()))) {
                // line 80
                yield "                                            <span class=\"rounded-full bg-emerald-100 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide text-emerald-700\">Active</span>
                                        ";
            }
            // line 82
            yield "                                    </div>
                                    ";
            // line 83
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 83), "description", [], "any", false, false, false, 83)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 84
                yield "                                        <div class=\"mt-2 text-sm leading-6 text-slate-600\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 84), "description", [], "any", false, false, false, 84), "html", null, true);
                yield "</div>
                                    ";
            }
            // line 86
            yield "                                    <div class=\"mt-3 flex flex-wrap gap-2 text-[10px] text-slate-500\">
                                        <span class=\"rounded-full bg-slate-100 px-2 py-1\">Key: ";
            // line 87
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "name", [], "any", false, false, false, 87), "html", null, true);
            yield "</span>
                                        ";
            // line 88
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 88), "version", [], "any", false, false, false, 88)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<span class=\"rounded-full bg-slate-100 px-2 py-1\">Version: ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 88), "version", [], "any", false, false, false, 88), "html", null, true);
                yield "</span>";
            }
            // line 89
            yield "                                        ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 89), "author", [], "any", false, false, false, 89)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<span class=\"rounded-full bg-slate-100 px-2 py-1\">Author: ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 89), "author", [], "any", false, false, false, 89), "html", null, true);
                yield "</span>";
            }
            // line 90
            yield "                                    </div>
                                </div>
                                <div class=\"flex gap-2\">
                                    <button type=\"submit\" name=\"theme_action\" value=\"preview\"
                                            class=\"inline-flex items-center rounded-full border border-amber-300 bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-800 hover:bg-amber-100\">
                                        Preview
                                    </button>
                                    <button type=\"submit\" name=\"theme_action\" value=\"apply\"
                                            class=\"inline-flex items-center rounded-full bg-slate-900 px-3 py-2 text-xs font-semibold text-white shadow hover:bg-slate-800\">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </form>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['theme'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 105
        yield "
                    ";
        // line 106
        if ((($tmp = (isset($context["_theme_previewing"]) || array_key_exists("_theme_previewing", $context) ? $context["_theme_previewing"] : (function () { throw new RuntimeError('Variable "_theme_previewing" does not exist.', 106, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 107
            yield "                        <form method=\"post\" action=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("_theme_form_action", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["_theme_form_action"]) || array_key_exists("_theme_form_action", $context) ? $context["_theme_form_action"] : (function () { throw new RuntimeError('Variable "_theme_form_action" does not exist.', 107, $this->source); })()), "switch-theme.php")) : ("switch-theme.php")), "html", null, true);
            yield "\" class=\"pt-1\">
                            <button type=\"submit\" name=\"theme_action\" value=\"clear-preview\"
                                    class=\"inline-flex items-center rounded-full border border-slate-300 bg-white px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-100\">
                                Revert Preview
                            </button>
                        </form>
                    ";
        }
        // line 114
        yield "                </div>
            </div>
        </div>
    </header>

    <main class=\"mx-auto max-w-7xl px-4 py-10\">
        ";
        // line 120
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 121
        yield "    </main>

    <footer class=\"mt-16 border-t border-slate-200/70 py-6 text-center text-xs text-slate-500\">
        Powered by Marwa\\View + ThemeBuilder
    </footer>

</body>
</html>
";
        yield from [];
    }

    // line 7
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "My Themed App";
        yield from [];
    }

    // line 120
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "layout.twig";
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
        return array (  282 => 120,  271 => 7,  258 => 121,  256 => 120,  248 => 114,  237 => 107,  235 => 106,  232 => 105,  212 => 90,  205 => 89,  199 => 88,  195 => 87,  192 => 86,  186 => 84,  184 => 83,  181 => 82,  177 => 80,  175 => 79,  171 => 78,  164 => 74,  159 => 73,  155 => 72,  150 => 69,  144 => 66,  141 => 65,  139 => 64,  123 => 51,  117 => 48,  111 => 45,  108 => 44,  102 => 42,  100 => 41,  97 => 40,  93 => 38,  91 => 37,  87 => 36,  62 => 14,  52 => 7,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\" class=\"h-full\">
<head>
    <meta charset=\"utf-8\" />
    <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\" />

    <title>{% block title %}My Themed App{% endblock %}</title>

    <script src=\"https://cdn.tailwindcss.com\"></script>
    <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
    <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
    <link href=\"https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap\" rel=\"stylesheet\">

    <link rel=\"stylesheet\" href=\"{{ theme_asset('css/app.css') }}\"/>

    <style>
        :root { color-scheme: light; }
        body { font-family: 'Manrope', system-ui, sans-serif; }
        code, pre { font-family: 'JetBrains Mono', monospace; }
        .theme-fade {
            transition: all .2s ease;
        }
    </style>
</head>
<body class=\"min-h-full bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.14),_transparent_28%),linear-gradient(180deg,_#f8fafc_0%,_#eef2ff_35%,_#f8fafc_100%)] text-gray-900 theme-fade\">
    <div class=\"absolute inset-x-0 top-0 -z-10 h-80 bg-[radial-gradient(circle,_rgba(125,211,252,0.28),_transparent_55%)] blur-3xl\"></div>
    <header class=\"site-header border-b border-slate-200/80 bg-white/75 backdrop-blur\">
        <div class=\"mx-auto max-w-7xl px-4 py-5 flex flex-col gap-4 md:flex-row md:items-start md:justify-between\">
            <div class=\"flex items-center gap-4\">
                <div class=\"flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-sky-500 to-blue-700 text-sm font-extrabold text-white shadow-sm shadow-sky-200/60\">
                    MV
                </div>
                <div>
                    <div class=\"text-xs font-semibold uppercase tracking-[0.24em] text-slate-500\">Current Theme</div>
                    <div class=\"mt-1 text-lg font-semibold text-slate-950\">
                        {{ _theme_meta.label }}
                        {% if _theme_previewing %}
                            <span class=\"rounded-full bg-amber-100 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide text-amber-800\">Preview</span>
                        {% endif %}
                    </div>
                    {% if _theme_meta.description %}
                        <div class=\"text-sm text-slate-600\">{{ _theme_meta.description }}</div>
                    {% endif %}
                    <div class=\"mt-1 text-[11px] text-slate-400\">
                        Chain: {{ _theme_chain|join(' -> ') }}
                    </div>
                    <div class=\"mt-3 flex flex-wrap gap-2\">
                        <a href=\"{{ _theme_home_url|default('switch-theme.php') }}\" class=\"inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-700 hover:bg-slate-100\">
                            Theme Demo
                        </a>
                        <a href=\"{{ _theme_docs_url|default('docs.php') }}\" class=\"inline-flex items-center rounded-full border border-sky-200 bg-sky-50 px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.18em] text-sky-700 hover:bg-sky-100\">
                            Browse Docs
                        </a>
                    </div>
                </div>
            </div>

            <div class=\"w-full max-w-3xl rounded-[1.75rem] border border-slate-200/80 bg-white/80 p-4 shadow-xl shadow-slate-200/40\">
                <div class=\"mb-3 flex items-center justify-between gap-4\">
                    <div>
                        <div class=\"text-xs font-semibold uppercase tracking-[0.24em] text-slate-500\">Admin Theme Workflow</div>
                        <div class=\"mt-1 text-sm text-slate-600\">Preview without saving, then apply or revert.</div>
                    </div>
                    {% if _theme_previewing %}
                        <div class=\"text-[11px] text-amber-700\">
                            Saved: <strong>{{ _theme_selected_meta.label }}</strong>
                        </div>
                    {% endif %}
                </div>

                <div class=\"grid gap-3 md:grid-cols-2\">
                    {% for theme in _theme_catalog %}
                        <form method=\"post\" action=\"{{ _theme_form_action|default('switch-theme.php') }}\" class=\"rounded-3xl border border-slate-200 bg-white p-4 shadow-sm\">
                            <input type=\"hidden\" name=\"theme_name\" value=\"{{ theme.name }}\">
                            <div class=\"flex h-full flex-col justify-between gap-4\">
                                <div>
                                    <div class=\"flex items-center justify-between gap-3\">
                                        <div class=\"font-semibold text-sm text-slate-950\">{{ theme.metadata.label }}</div>
                                        {% if theme.name == _theme_name %}
                                            <span class=\"rounded-full bg-emerald-100 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide text-emerald-700\">Active</span>
                                        {% endif %}
                                    </div>
                                    {% if theme.metadata.description %}
                                        <div class=\"mt-2 text-sm leading-6 text-slate-600\">{{ theme.metadata.description }}</div>
                                    {% endif %}
                                    <div class=\"mt-3 flex flex-wrap gap-2 text-[10px] text-slate-500\">
                                        <span class=\"rounded-full bg-slate-100 px-2 py-1\">Key: {{ theme.name }}</span>
                                        {% if theme.metadata.version %}<span class=\"rounded-full bg-slate-100 px-2 py-1\">Version: {{ theme.metadata.version }}</span>{% endif %}
                                        {% if theme.metadata.author %}<span class=\"rounded-full bg-slate-100 px-2 py-1\">Author: {{ theme.metadata.author }}</span>{% endif %}
                                    </div>
                                </div>
                                <div class=\"flex gap-2\">
                                    <button type=\"submit\" name=\"theme_action\" value=\"preview\"
                                            class=\"inline-flex items-center rounded-full border border-amber-300 bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-800 hover:bg-amber-100\">
                                        Preview
                                    </button>
                                    <button type=\"submit\" name=\"theme_action\" value=\"apply\"
                                            class=\"inline-flex items-center rounded-full bg-slate-900 px-3 py-2 text-xs font-semibold text-white shadow hover:bg-slate-800\">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </form>
                    {% endfor %}

                    {% if _theme_previewing %}
                        <form method=\"post\" action=\"{{ _theme_form_action|default('switch-theme.php') }}\" class=\"pt-1\">
                            <button type=\"submit\" name=\"theme_action\" value=\"clear-preview\"
                                    class=\"inline-flex items-center rounded-full border border-slate-300 bg-white px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-100\">
                                Revert Preview
                            </button>
                        </form>
                    {% endif %}
                </div>
            </div>
        </div>
    </header>

    <main class=\"mx-auto max-w-7xl px-4 py-10\">
        {% block content %}{% endblock %}
    </main>

    <footer class=\"mt-16 border-t border-slate-200/70 py-6 text-center text-xs text-slate-500\">
        Powered by Marwa\\View + ThemeBuilder
    </footer>

</body>
</html>
", "layout.twig", "/Users/memran/projects/php-projects/marwa-view/examples/theme/themes/default/views/layout.twig");
    }
}
