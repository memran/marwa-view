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
class __TwigTemplate_d38d33aa46adeb938ea973f5a7b995d0 extends Template
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

    ";
        // line 10
        yield "    <script src=\"https://cdn.tailwindcss.com\"></script>

    ";
        // line 13
        yield "    <link rel=\"stylesheet\" href=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('theme_asset')->getCallable()("css/app.css"), "html", null, true);
        yield "\"/>

    <style>
        /* Small utility if you want soft transitions between themes */
        .theme-fade {
            transition: all .2s ease;
        }
    </style>
</head>
<body class=\"min-h-full bg-gray-50 text-gray-900 theme-fade\">
    <header class=\"site-header border-b bg-white shadow-sm\">
        <div class=\"mx-auto max-w-7xl px-4 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3\">
            <div class=\"flex items-center gap-3\">
                <img src=\"";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('theme_asset')->getCallable()("images/logo-default.svg"), "html", null, true);
        yield "\"
                     alt=\"Logo\"
                     class=\"h-8 w-8 rounded-full ring-1 ring-gray-300\" />
                <div>
                    <div class=\"text-sm text-gray-500\">Current Theme:</div>
                    <div class=\"font-semibold text-gray-900\">";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["_theme_name"]) || array_key_exists("_theme_name", $context) ? $context["_theme_name"] : (function () { throw new RuntimeError('Variable "_theme_name" does not exist.', 31, $this->source); })()), "html", null, true);
        yield "</div>
                    <div class=\"text-[10px] text-gray-400\">
                        Chain: ";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::join((isset($context["_theme_chain"]) || array_key_exists("_theme_chain", $context) ? $context["_theme_chain"] : (function () { throw new RuntimeError('Variable "_theme_chain" does not exist.', 33, $this->source); })()), " → "), "html", null, true);
        yield "
                    </div>
                </div>
            </div>

            ";
        // line 42
        yield "            <form method=\"post\" action=\"/switch-theme\" class=\"flex items-center gap-2\">
                <label class=\"text-sm text-gray-600 font-medium\">Theme:</label>
                <select name=\"theme_name\"
                        class=\"block rounded-md border border-gray-300 bg-white px-2 py-1 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500\">
                    <option value=\"default\" ";
        // line 46
        if (((isset($context["_theme_name"]) || array_key_exists("_theme_name", $context) ? $context["_theme_name"] : (function () { throw new RuntimeError('Variable "_theme_name" does not exist.', 46, $this->source); })()) == "default")) {
            yield "selected";
        }
        yield ">Default</option>
                    <option value=\"dark\" ";
        // line 47
        if (((isset($context["_theme_name"]) || array_key_exists("_theme_name", $context) ? $context["_theme_name"] : (function () { throw new RuntimeError('Variable "_theme_name" does not exist.', 47, $this->source); })()) == "dark")) {
            yield "selected";
        }
        yield ">Dark</option>
                    <option value=\"tenantA\" ";
        // line 48
        if (((isset($context["_theme_name"]) || array_key_exists("_theme_name", $context) ? $context["_theme_name"] : (function () { throw new RuntimeError('Variable "_theme_name" does not exist.', 48, $this->source); })()) == "tenantA")) {
            yield "selected";
        }
        yield ">Tenant A</option>
                </select>
                <button type=\"submit\"
                        class=\"inline-flex items-center rounded-md bg-indigo-600 px-3 py-1.5 text-xs font-semibold text-white shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500\">
                    Switch
                </button>
            </form>
        </div>
    </header>

    <main class=\"mx-auto max-w-7xl px-4 py-10\">
        ";
        // line 59
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 60
        yield "    </main>

    <footer class=\"mt-16 border-t py-6 text-center text-xs text-gray-500\">
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

    // line 59
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
        return array (  159 => 59,  148 => 7,  135 => 60,  133 => 59,  117 => 48,  111 => 47,  105 => 46,  99 => 42,  91 => 33,  86 => 31,  78 => 26,  61 => 13,  57 => 10,  52 => 7,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\" class=\"h-full\">
<head>
    <meta charset=\"utf-8\" />
    <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\" />

    <title>{% block title %}My Themed App{% endblock %}</title>

    {# Tailwind CDN for demo; prod: compile per-theme #}
    <script src=\"https://cdn.tailwindcss.com\"></script>

    {# Theme-specific compiled css (per theme). #}
    <link rel=\"stylesheet\" href=\"{{ theme_asset('css/app.css') }}\"/>

    <style>
        /* Small utility if you want soft transitions between themes */
        .theme-fade {
            transition: all .2s ease;
        }
    </style>
</head>
<body class=\"min-h-full bg-gray-50 text-gray-900 theme-fade\">
    <header class=\"site-header border-b bg-white shadow-sm\">
        <div class=\"mx-auto max-w-7xl px-4 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3\">
            <div class=\"flex items-center gap-3\">
                <img src=\"{{ theme_asset('images/logo-default.svg') }}\"
                     alt=\"Logo\"
                     class=\"h-8 w-8 rounded-full ring-1 ring-gray-300\" />
                <div>
                    <div class=\"text-sm text-gray-500\">Current Theme:</div>
                    <div class=\"font-semibold text-gray-900\">{{ _theme_name }}</div>
                    <div class=\"text-[10px] text-gray-400\">
                        Chain: {{ _theme_chain|join(' → ') }}
                    </div>
                </div>
            </div>

            {# Theme switcher form.
               Your controller should read POST['theme_name'] and call
               \$themeBuilder->useTheme(\$_POST['theme_name']) before rendering.
            #}
            <form method=\"post\" action=\"/switch-theme\" class=\"flex items-center gap-2\">
                <label class=\"text-sm text-gray-600 font-medium\">Theme:</label>
                <select name=\"theme_name\"
                        class=\"block rounded-md border border-gray-300 bg-white px-2 py-1 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500\">
                    <option value=\"default\" {% if _theme_name == 'default' %}selected{% endif %}>Default</option>
                    <option value=\"dark\" {% if _theme_name == 'dark' %}selected{% endif %}>Dark</option>
                    <option value=\"tenantA\" {% if _theme_name == 'tenantA' %}selected{% endif %}>Tenant A</option>
                </select>
                <button type=\"submit\"
                        class=\"inline-flex items-center rounded-md bg-indigo-600 px-3 py-1.5 text-xs font-semibold text-white shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500\">
                    Switch
                </button>
            </form>
        </div>
    </header>

    <main class=\"mx-auto max-w-7xl px-4 py-10\">
        {% block content %}{% endblock %}
    </main>

    <footer class=\"mt-16 border-t py-6 text-center text-xs text-gray-500\">
        Powered by Marwa\\View + ThemeBuilder
    </footer>

</body>
</html>
", "layout.twig", "F:\\projects\\memran-marwa-view\\examples\\views\\themes\\default\\views\\layout.twig");
    }
}
