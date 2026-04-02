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
class __TwigTemplate_ffdf38f5e9ecb3638f15d67bf4052f08 extends Template
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
                <img src=\"";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('theme_asset')->getCallable()("images/logo-default.svg"), "html", null, true);
        yield "\"
                     alt=\"Logo\"
                     class=\"h-10 w-10 rounded-2xl ring-1 ring-slate-300 bg-white shadow-sm\" />
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
                </div>
            </div>

            <div class=\"w-full max-w-3xl rounded-[1.75rem] border border-slate-200/80 bg-white/80 p-4 shadow-xl shadow-slate-200/40\">
                <div class=\"mb-3 flex items-center justify-between gap-4\">
                    <div>
                        <div class=\"text-xs font-semibold uppercase tracking-[0.24em] text-slate-500\">Admin Theme Workflow</div>
                        <div class=\"mt-1 text-sm text-slate-600\">Preview without saving, then apply or revert.</div>
                    </div>
                    ";
        // line 56
        if ((($tmp = (isset($context["_theme_previewing"]) || array_key_exists("_theme_previewing", $context) ? $context["_theme_previewing"] : (function () { throw new RuntimeError('Variable "_theme_previewing" does not exist.', 56, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 57
            yield "                        <div class=\"text-[11px] text-amber-700\">
                            Saved: <strong>";
            // line 58
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["_theme_selected_meta"]) || array_key_exists("_theme_selected_meta", $context) ? $context["_theme_selected_meta"] : (function () { throw new RuntimeError('Variable "_theme_selected_meta" does not exist.', 58, $this->source); })()), "label", [], "any", false, false, false, 58), "html", null, true);
            yield "</strong>
                        </div>
                    ";
        }
        // line 61
        yield "                </div>

                <div class=\"grid gap-3 md:grid-cols-2\">
                    ";
        // line 64
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["_theme_catalog"]) || array_key_exists("_theme_catalog", $context) ? $context["_theme_catalog"] : (function () { throw new RuntimeError('Variable "_theme_catalog" does not exist.', 64, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["theme"]) {
            // line 65
            yield "                        <form method=\"post\" action=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("_theme_form_action", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["_theme_form_action"]) || array_key_exists("_theme_form_action", $context) ? $context["_theme_form_action"] : (function () { throw new RuntimeError('Variable "_theme_form_action" does not exist.', 65, $this->source); })()), "switch-theme.php")) : ("switch-theme.php")), "html", null, true);
            yield "\" class=\"rounded-3xl border border-slate-200 bg-white p-4 shadow-sm\">
                            <input type=\"hidden\" name=\"theme_name\" value=\"";
            // line 66
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "name", [], "any", false, false, false, 66), "html", null, true);
            yield "\">
                            <div class=\"flex h-full flex-col justify-between gap-4\">
                                <div>
                                    <div class=\"flex items-center justify-between gap-3\">
                                        <div class=\"font-semibold text-sm text-slate-950\">";
            // line 70
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 70), "label", [], "any", false, false, false, 70), "html", null, true);
            yield "</div>
                                        ";
            // line 71
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "name", [], "any", false, false, false, 71) == (isset($context["_theme_name"]) || array_key_exists("_theme_name", $context) ? $context["_theme_name"] : (function () { throw new RuntimeError('Variable "_theme_name" does not exist.', 71, $this->source); })()))) {
                // line 72
                yield "                                            <span class=\"rounded-full bg-emerald-100 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide text-emerald-700\">Active</span>
                                        ";
            }
            // line 74
            yield "                                    </div>
                                    ";
            // line 75
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 75), "description", [], "any", false, false, false, 75)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 76
                yield "                                        <div class=\"mt-2 text-sm leading-6 text-slate-600\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 76), "description", [], "any", false, false, false, 76), "html", null, true);
                yield "</div>
                                    ";
            }
            // line 78
            yield "                                    <div class=\"mt-3 flex flex-wrap gap-2 text-[10px] text-slate-500\">
                                        <span class=\"rounded-full bg-slate-100 px-2 py-1\">Key: ";
            // line 79
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "name", [], "any", false, false, false, 79), "html", null, true);
            yield "</span>
                                        ";
            // line 80
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 80), "version", [], "any", false, false, false, 80)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<span class=\"rounded-full bg-slate-100 px-2 py-1\">Version: ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 80), "version", [], "any", false, false, false, 80), "html", null, true);
                yield "</span>";
            }
            // line 81
            yield "                                        ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 81), "author", [], "any", false, false, false, 81)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<span class=\"rounded-full bg-slate-100 px-2 py-1\">Author: ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "metadata", [], "any", false, false, false, 81), "author", [], "any", false, false, false, 81), "html", null, true);
                yield "</span>";
            }
            // line 82
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
        // line 97
        yield "
                    ";
        // line 98
        if ((($tmp = (isset($context["_theme_previewing"]) || array_key_exists("_theme_previewing", $context) ? $context["_theme_previewing"] : (function () { throw new RuntimeError('Variable "_theme_previewing" does not exist.', 98, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 99
            yield "                        <form method=\"post\" action=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("_theme_form_action", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["_theme_form_action"]) || array_key_exists("_theme_form_action", $context) ? $context["_theme_form_action"] : (function () { throw new RuntimeError('Variable "_theme_form_action" does not exist.', 99, $this->source); })()), "switch-theme.php")) : ("switch-theme.php")), "html", null, true);
            yield "\" class=\"pt-1\">
                            <button type=\"submit\" name=\"theme_action\" value=\"clear-preview\"
                                    class=\"inline-flex items-center rounded-full border border-slate-300 bg-white px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-100\">
                                Revert Preview
                            </button>
                        </form>
                    ";
        }
        // line 106
        yield "                </div>
            </div>
        </div>
    </header>

    <main class=\"mx-auto max-w-7xl px-4 py-10\">
        ";
        // line 112
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 113
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

    // line 112
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
        return array (  271 => 112,  260 => 7,  247 => 113,  245 => 112,  237 => 106,  226 => 99,  224 => 98,  221 => 97,  201 => 82,  194 => 81,  188 => 80,  184 => 79,  181 => 78,  175 => 76,  173 => 75,  170 => 74,  166 => 72,  164 => 71,  160 => 70,  153 => 66,  148 => 65,  144 => 64,  139 => 61,  133 => 58,  130 => 57,  128 => 56,  114 => 45,  111 => 44,  105 => 42,  103 => 41,  100 => 40,  96 => 38,  94 => 37,  90 => 36,  81 => 30,  62 => 14,  52 => 7,  44 => 1,);
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
                <img src=\"{{ theme_asset('images/logo-default.svg') }}\"
                     alt=\"Logo\"
                     class=\"h-10 w-10 rounded-2xl ring-1 ring-slate-300 bg-white shadow-sm\" />
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
