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

/* components/card.twig */
class __TwigTemplate_691fec099584fc8228ae1774036580e3 extends Template
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
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 1
    public function macro_panel($title = null, $body = null, $icon = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "title" => $title,
            "body" => $body,
            "icon" => $icon,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 2
            yield "  <div class=\"group relative overflow-hidden rounded-2xl border border-slate-200/70 dark:border-slate-800/70 bg-white/70 dark:bg-slate-900/60 p-6 shadow-sm hover:shadow-lg hover:shadow-brand/10 transition\">
    <div class=\"absolute -right-10 -top-10 h-28 w-28 rounded-full bg-brand/10 blur-2xl opacity-0 group-hover:opacity-100 transition\"></div>
    <div class=\"flex items-start gap-4\">
      ";
            // line 5
            if ((($tmp = (isset($context["icon"]) || array_key_exists("icon", $context) ? $context["icon"] : (function () { throw new RuntimeError('Variable "icon" does not exist.', 5, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 6
                yield "        <div class=\"mt-1 inline-flex h-10 w-10 items-center justify-center rounded-xl bg-brand/10 ring-1 ring-brand/30\">";
                yield (isset($context["icon"]) || array_key_exists("icon", $context) ? $context["icon"] : (function () { throw new RuntimeError('Variable "icon" does not exist.', 6, $this->source); })());
                yield "</div>
      ";
            }
            // line 8
            yield "      <div>
        <h3 class=\"text-base font-semibold\">";
            // line 9
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new RuntimeError('Variable "title" does not exist.', 9, $this->source); })()), "html", null, true);
            yield "</h3>
        <p class=\"mt-2 text-sm text-slate-600 dark:text-slate-300\">";
            // line 10
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["body"]) || array_key_exists("body", $context) ? $context["body"] : (function () { throw new RuntimeError('Variable "body" does not exist.', 10, $this->source); })()), "html", null, true);
            yield "</p>
      </div>
    </div>
  </div>
";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "components/card.twig";
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
        return array (  79 => 10,  75 => 9,  72 => 8,  66 => 6,  64 => 5,  59 => 2,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% macro panel(title, body, icon=null) %}
  <div class=\"group relative overflow-hidden rounded-2xl border border-slate-200/70 dark:border-slate-800/70 bg-white/70 dark:bg-slate-900/60 p-6 shadow-sm hover:shadow-lg hover:shadow-brand/10 transition\">
    <div class=\"absolute -right-10 -top-10 h-28 w-28 rounded-full bg-brand/10 blur-2xl opacity-0 group-hover:opacity-100 transition\"></div>
    <div class=\"flex items-start gap-4\">
      {% if icon %}
        <div class=\"mt-1 inline-flex h-10 w-10 items-center justify-center rounded-xl bg-brand/10 ring-1 ring-brand/30\">{{ icon|raw }}</div>
      {% endif %}
      <div>
        <h3 class=\"text-base font-semibold\">{{ title }}</h3>
        <p class=\"mt-2 text-sm text-slate-600 dark:text-slate-300\">{{ body }}</p>
      </div>
    </div>
  </div>
{% endmacro %}
", "components/card.twig", "/Users/memran/projects/php-projects/marwa-view/examples/basic/views/components/card.twig");
    }
}
