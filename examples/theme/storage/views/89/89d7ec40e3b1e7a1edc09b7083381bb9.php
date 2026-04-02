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
class __TwigTemplate_6cb431aa5765cb08124a3b45e14d886b extends Template
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
        :root { color-scheme: dark; }
        body { font-family: 'Manrope', system-ui, sans-serif; }
        code, pre { font-family: 'JetBrains Mono', monospace; }
        .theme-fade {
            transition: all .2s ease;
        }
    </style>
</head>
<body class=\"min-h-full bg-[radial-gradient(circle_at_top_left,_rgba(34,211,238,0.16),_transparent_30%),linear-gradient(180deg,_#020617_0%,_#0f172a_45%,_#111827_100%)] text-slate-100 theme-fade\">
    <header class=\"site-header border-b border-slate-800 bg-slate-900/75 shadow-sm text-slate-100 backdrop-blur\">
        <div class=\"mx-auto max-w-7xl px-4 py-5 flex flex-col gap-4 md:flex-row md:items-start md:justify-between\">
            <div class=\"flex items-center gap-4\">
                <div class=\"flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-400 to-slate-900 text-sm font-extrabold text-cyan-50 shadow-lg shadow-cyan-950/30 ring-1 ring-cyan-500/30\">
                    DX
                </div>
                <div>
                    <div class=\"text-xs font-semibold uppercase tracking-[0.24em] text-slate-500\">Current Theme</div>
                    <div class=\"mt-1 text-lg font-semibold text-slate-100\">
                        ";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["_theme_meta"]) || array_key_exists("_theme_meta", $context) ? $context["_theme_meta"] : (function () { throw new RuntimeError('Variable "_theme_meta" does not exist.', 35, $this->source); })()), "label", [], "any", false, false, false, 35), "html", null, true);
        yield "
                        ";
        // line 36
        if ((($tmp = (isset($context["_theme_previewing"]) || array_key_exists("_theme_previewing", $context) ? $context["_theme_previewing"] : (function () { throw new RuntimeError('Variable "_theme_previewing" does not exist.', 36, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 37
            yield "                            <span class=\"rounded-full bg-amber-400/20 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide text-amber-200\">Preview</span>
                        ";
        }
        // line 39
        yield "                    </div>
                    ";
        // line 40
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["_theme_meta"]) || array_key_exists("_theme_meta", $context) ? $context["_theme_meta"] : (function () { throw new RuntimeError('Variable "_theme_meta" does not exist.', 40, $this->source); })()), "description", [], "any", false, false, false, 40)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 41
            yield "                        <div class=\"text-sm text-slate-400\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["_theme_meta"]) || array_key_exists("_theme_meta", $context) ? $context["_theme_meta"] : (function () { throw new RuntimeError('Variable "_theme_meta" does not exist.', 41, $this->source); })()), "description", [], "any", false, false, false, 41), "html", null, true);
            yield "</div>
                    ";
        }
        // line 43
        yield "                    <div class=\"mt-1 text-[11px] text-slate-500\">
                        Chain: ";
        // line 44
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::join((isset($context["_theme_chain"]) || array_key_exists("_theme_chain", $context) ? $context["_theme_chain"] : (function () { throw new RuntimeError('Variable "_theme_chain" does not exist.', 44, $this->source); })()), " -> "), "html", null, true);
        yield "
                    </div>
                </div>
            </div>

            <div class=\"w-full max-w-3xl rounded-[1.75rem] border border-slate-800 bg-slate-950/70 p-4 shadow-2xl shadow-black/20\">
                <div class=\"mb-3 flex items-center justify-between gap-4\">
                    <div>
                        <div class=\"text-xs font-semibold uppercase tracking-[0.24em] text-slate-400\">Admin Theme Workflow</div>
                        <div class=\"mt-1 text-sm text-slate-500\">Preview a theme, apply it, or revert to the saved one.</div>
                    </div>
                    ";
        // line 55
        if ((($tmp = (isset($context["_theme_previewing"]) || array_key_exists("_theme_previewing", $context) ? $context["_theme_previewing"] : (function () { throw new RuntimeError('Variable "_theme_previewing" does not exist.', 55, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 56
            yield "                        <div class=\"text-[11px] text-amber-200\">
                            Saved: <strong>";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["_theme_selected_meta"]) || array_key_exists("_theme_selected_meta", $context) ? $context["_theme_selected_meta"] : (function () { throw new RuntimeError('Variable "_theme_selected_meta" does not exist.', 57, $this->source); })()), "label", [], "any", false, false, false, 57), "html", null, true);
            yield "</strong>
                        </div>
                    ";
        }
        // line 60
        yield "                </div>

                <div class=\"grid gap-3 md:grid-cols-2\">
                    ";
        // line 63
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["_theme_catalog"]) || array_key_exists("_theme_catalog", $context) ? $context["_theme_catalog"] : (function () { throw new RuntimeError('Variable "_theme_catalog" does not exist.', 63, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["theme"]) {
            // line 64
            yield "                        <form method=\"post\" action=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("_theme_form_action", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["_theme_form_action"]) || array_key_exists("_theme_form_action", $context) ? $context["_theme_form_action"] : (function () { throw new RuntimeError('Variable "_theme_form_action" does not exist.', 64, $this->source); })()), "switch-theme.php")) : ("switch-theme.php")), "html", null, true);
            yield "\" class=\"rounded-3xl border border-slate-800 bg-slate-900 p-4\">
                            <input type=\"hidden\" name=\"theme_name\" value=\"";
            // line 65
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "name", [], "any", false, false, false, 65), "html", null, true);
            yield "\">
                            <div class=\"flex h-full flex-col justify-between gap-4\">
                                <div>
                                    <div class=\"flex items-center justify-between gap-3\">
                                        <div class=\"font-semibold text-sm text-slate-100\">";
            // line 69
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 69), "label", [], "any", false, false, false, 69), "html", null, true);
            yield "</div>
                                        ";
            // line 70
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "name", [], "any", false, false, false, 70) == (isset($context["_theme_name"]) || array_key_exists("_theme_name", $context) ? $context["_theme_name"] : (function () { throw new RuntimeError('Variable "_theme_name" does not exist.', 70, $this->source); })()))) {
                // line 71
                yield "                                            <span class=\"rounded-full bg-emerald-500/15 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide text-emerald-200\">Active</span>
                                        ";
            }
            // line 73
            yield "                                    </div>
                                    ";
            // line 74
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 74), "description", [], "any", false, false, false, 74)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 75
                yield "                                        <div class=\"mt-2 text-sm leading-6 text-slate-400\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 75), "description", [], "any", false, false, false, 75), "html", null, true);
                yield "</div>
                                    ";
            }
            // line 77
            yield "                                    <div class=\"mt-3 flex flex-wrap gap-2 text-[10px] text-slate-500\">
                                        <span class=\"rounded-full bg-slate-800 px-2 py-1\">Key: ";
            // line 78
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "name", [], "any", false, false, false, 78), "html", null, true);
            yield "</span>
                                        ";
            // line 79
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 79), "version", [], "any", false, false, false, 79)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<span class=\"rounded-full bg-slate-800 px-2 py-1\">Version: ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 79), "version", [], "any", false, false, false, 79), "html", null, true);
                yield "</span>";
            }
            // line 80
            yield "                                        ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 80), "author", [], "any", false, false, false, 80)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<span class=\"rounded-full bg-slate-800 px-2 py-1\">Author: ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 80), "author", [], "any", false, false, false, 80), "html", null, true);
                yield "</span>";
            }
            // line 81
            yield "                                    </div>
                                </div>
                                <div class=\"flex gap-2\">
                                    <button type=\"submit\" name=\"theme_action\" value=\"preview\"
                                            class=\"inline-flex items-center rounded-full border border-amber-500/40 bg-amber-500/10 px-3 py-2 text-xs font-semibold text-amber-200 hover:bg-amber-500/20\">
                                        Preview
                                    </button>
                                    <button type=\"submit\" name=\"theme_action\" value=\"apply\"
                                            class=\"inline-flex items-center rounded-full bg-cyan-500 px-3 py-2 text-xs font-semibold text-slate-950 shadow hover:bg-cyan-400\">
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
        // line 96
        yield "
                    ";
        // line 97
        if ((($tmp = (isset($context["_theme_previewing"]) || array_key_exists("_theme_previewing", $context) ? $context["_theme_previewing"] : (function () { throw new RuntimeError('Variable "_theme_previewing" does not exist.', 97, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 98
            yield "                        <form method=\"post\" action=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("_theme_form_action", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["_theme_form_action"]) || array_key_exists("_theme_form_action", $context) ? $context["_theme_form_action"] : (function () { throw new RuntimeError('Variable "_theme_form_action" does not exist.', 98, $this->source); })()), "switch-theme.php")) : ("switch-theme.php")), "html", null, true);
            yield "\" class=\"pt-1\">
                            <button type=\"submit\" name=\"theme_action\" value=\"clear-preview\"
                                    class=\"inline-flex items-center rounded-full border border-slate-700 bg-slate-900 px-4 py-2 text-xs font-semibold text-slate-200 hover:bg-slate-800\">
                                Revert Preview
                            </button>
                        </form>
                    ";
        }
        // line 105
        yield "                </div>
            </div>
        </div>
    </header>

    <main class=\"mx-auto max-w-7xl px-4 py-10\">
        ";
        // line 111
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 112
        yield "    </main>

    <footer class=\"mt-16 border-t border-slate-800 py-6 text-center text-[11px] text-slate-500\">
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
        yield "My Themed App (Dark)";
        yield from [];
    }

    // line 111
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
        return array (  267 => 111,  256 => 7,  243 => 112,  241 => 111,  233 => 105,  222 => 98,  220 => 97,  217 => 96,  197 => 81,  190 => 80,  184 => 79,  180 => 78,  177 => 77,  171 => 75,  169 => 74,  166 => 73,  162 => 71,  160 => 70,  156 => 69,  149 => 65,  144 => 64,  140 => 63,  135 => 60,  129 => 57,  126 => 56,  124 => 55,  110 => 44,  107 => 43,  101 => 41,  99 => 40,  96 => 39,  92 => 37,  90 => 36,  86 => 35,  62 => 14,  52 => 7,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\" class=\"h-full\">
<head>
    <meta charset=\"utf-8\" />
    <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\" />

    <title>{% block title %}My Themed App (Dark){% endblock %}</title>

    <script src=\"https://cdn.tailwindcss.com\"></script>
    <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
    <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
    <link href=\"https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap\" rel=\"stylesheet\">

    <link rel=\"stylesheet\" href=\"{{ theme_asset('css/app.css') }}\"/>

    <style>
        :root { color-scheme: dark; }
        body { font-family: 'Manrope', system-ui, sans-serif; }
        code, pre { font-family: 'JetBrains Mono', monospace; }
        .theme-fade {
            transition: all .2s ease;
        }
    </style>
</head>
<body class=\"min-h-full bg-[radial-gradient(circle_at_top_left,_rgba(34,211,238,0.16),_transparent_30%),linear-gradient(180deg,_#020617_0%,_#0f172a_45%,_#111827_100%)] text-slate-100 theme-fade\">
    <header class=\"site-header border-b border-slate-800 bg-slate-900/75 shadow-sm text-slate-100 backdrop-blur\">
        <div class=\"mx-auto max-w-7xl px-4 py-5 flex flex-col gap-4 md:flex-row md:items-start md:justify-between\">
            <div class=\"flex items-center gap-4\">
                <div class=\"flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-400 to-slate-900 text-sm font-extrabold text-cyan-50 shadow-lg shadow-cyan-950/30 ring-1 ring-cyan-500/30\">
                    DX
                </div>
                <div>
                    <div class=\"text-xs font-semibold uppercase tracking-[0.24em] text-slate-500\">Current Theme</div>
                    <div class=\"mt-1 text-lg font-semibold text-slate-100\">
                        {{ _theme_meta.label }}
                        {% if _theme_previewing %}
                            <span class=\"rounded-full bg-amber-400/20 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide text-amber-200\">Preview</span>
                        {% endif %}
                    </div>
                    {% if _theme_meta.description %}
                        <div class=\"text-sm text-slate-400\">{{ _theme_meta.description }}</div>
                    {% endif %}
                    <div class=\"mt-1 text-[11px] text-slate-500\">
                        Chain: {{ _theme_chain|join(' -> ') }}
                    </div>
                </div>
            </div>

            <div class=\"w-full max-w-3xl rounded-[1.75rem] border border-slate-800 bg-slate-950/70 p-4 shadow-2xl shadow-black/20\">
                <div class=\"mb-3 flex items-center justify-between gap-4\">
                    <div>
                        <div class=\"text-xs font-semibold uppercase tracking-[0.24em] text-slate-400\">Admin Theme Workflow</div>
                        <div class=\"mt-1 text-sm text-slate-500\">Preview a theme, apply it, or revert to the saved one.</div>
                    </div>
                    {% if _theme_previewing %}
                        <div class=\"text-[11px] text-amber-200\">
                            Saved: <strong>{{ _theme_selected_meta.label }}</strong>
                        </div>
                    {% endif %}
                </div>

                <div class=\"grid gap-3 md:grid-cols-2\">
                    {% for theme in _theme_catalog %}
                        <form method=\"post\" action=\"{{ _theme_form_action|default('switch-theme.php') }}\" class=\"rounded-3xl border border-slate-800 bg-slate-900 p-4\">
                            <input type=\"hidden\" name=\"theme_name\" value=\"{{ theme.name }}\">
                            <div class=\"flex h-full flex-col justify-between gap-4\">
                                <div>
                                    <div class=\"flex items-center justify-between gap-3\">
                                        <div class=\"font-semibold text-sm text-slate-100\">{{ theme.metadata.label }}</div>
                                        {% if theme.name == _theme_name %}
                                            <span class=\"rounded-full bg-emerald-500/15 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide text-emerald-200\">Active</span>
                                        {% endif %}
                                    </div>
                                    {% if theme.metadata.description %}
                                        <div class=\"mt-2 text-sm leading-6 text-slate-400\">{{ theme.metadata.description }}</div>
                                    {% endif %}
                                    <div class=\"mt-3 flex flex-wrap gap-2 text-[10px] text-slate-500\">
                                        <span class=\"rounded-full bg-slate-800 px-2 py-1\">Key: {{ theme.name }}</span>
                                        {% if theme.metadata.version %}<span class=\"rounded-full bg-slate-800 px-2 py-1\">Version: {{ theme.metadata.version }}</span>{% endif %}
                                        {% if theme.metadata.author %}<span class=\"rounded-full bg-slate-800 px-2 py-1\">Author: {{ theme.metadata.author }}</span>{% endif %}
                                    </div>
                                </div>
                                <div class=\"flex gap-2\">
                                    <button type=\"submit\" name=\"theme_action\" value=\"preview\"
                                            class=\"inline-flex items-center rounded-full border border-amber-500/40 bg-amber-500/10 px-3 py-2 text-xs font-semibold text-amber-200 hover:bg-amber-500/20\">
                                        Preview
                                    </button>
                                    <button type=\"submit\" name=\"theme_action\" value=\"apply\"
                                            class=\"inline-flex items-center rounded-full bg-cyan-500 px-3 py-2 text-xs font-semibold text-slate-950 shadow hover:bg-cyan-400\">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </form>
                    {% endfor %}

                    {% if _theme_previewing %}
                        <form method=\"post\" action=\"{{ _theme_form_action|default('switch-theme.php') }}\" class=\"pt-1\">
                            <button type=\"submit\" name=\"theme_action\" value=\"clear-preview\"
                                    class=\"inline-flex items-center rounded-full border border-slate-700 bg-slate-900 px-4 py-2 text-xs font-semibold text-slate-200 hover:bg-slate-800\">
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

    <footer class=\"mt-16 border-t border-slate-800 py-6 text-center text-[11px] text-slate-500\">
        Powered by Marwa\\View + ThemeBuilder
    </footer>

</body>
</html>
", "layout.twig", "/Users/memran/projects/php-projects/marwa-view/examples/theme/themes/dark/views/layout.twig");
    }
}
