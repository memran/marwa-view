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

/* macros/form.twig */
class __TwigTemplate_e1bd0fc6004cb07300f8c74bb65a8c0d extends Template
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
        // line 13
        yield "
";
        yield from [];
    }

    // line 1
    public function macro_input($name = null, $label = null, $value = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "name" => $name,
            "label" => $label,
            "value" => $value,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 2
            yield "  <label class=\"block text-xs text-slate-600 font-semibold mb-1\" for=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new RuntimeError('Variable "name" does not exist.', 2, $this->source); })()), "html", null, true);
            yield "\">
    ";
            // line 3
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["label"]) || array_key_exists("label", $context) ? $context["label"] : (function () { throw new RuntimeError('Variable "label" does not exist.', 3, $this->source); })()), "html", null, true);
            yield "
  </label>
  <input
    class=\"w-full border rounded px-3 py-2 text-sm text-slate-800 bg-white outline-none focus:ring focus:ring-indigo-300\"
    type=\"text\"
    id=\"";
            // line 8
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new RuntimeError('Variable "name" does not exist.', 8, $this->source); })()), "html", null, true);
            yield "\"
    name=\"";
            // line 9
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new RuntimeError('Variable "name" does not exist.', 9, $this->source); })()), "html", null, true);
            yield "\"
    value=\"";
            // line 10
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["value"]) || array_key_exists("value", $context) ? $context["value"] : (function () { throw new RuntimeError('Variable "value" does not exist.', 10, $this->source); })()));
            yield "\"
  />
";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 14
    public function macro_password($name = null, $label = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "name" => $name,
            "label" => $label,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 15
            yield "  <label class=\"block text-xs text-slate-600 font-semibold mb-1\" for=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new RuntimeError('Variable "name" does not exist.', 15, $this->source); })()), "html", null, true);
            yield "\">
    ";
            // line 16
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["label"]) || array_key_exists("label", $context) ? $context["label"] : (function () { throw new RuntimeError('Variable "label" does not exist.', 16, $this->source); })()), "html", null, true);
            yield "
  </label>
  <input
    class=\"w-full border rounded px-3 py-2 text-sm text-slate-800 bg-white outline-none focus:ring focus:ring-indigo-300\"
    type=\"password\"
    id=\"";
            // line 21
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new RuntimeError('Variable "name" does not exist.', 21, $this->source); })()), "html", null, true);
            yield "\"
    name=\"";
            // line 22
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new RuntimeError('Variable "name" does not exist.', 22, $this->source); })()), "html", null, true);
            yield "\"
  />
";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "macros/form.twig";
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
        return array (  122 => 22,  118 => 21,  110 => 16,  105 => 15,  92 => 14,  83 => 10,  79 => 9,  75 => 8,  67 => 3,  62 => 2,  48 => 1,  42 => 13,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% macro input(name, label, value) %}
  <label class=\"block text-xs text-slate-600 font-semibold mb-1\" for=\"{{ name }}\">
    {{ label }}
  </label>
  <input
    class=\"w-full border rounded px-3 py-2 text-sm text-slate-800 bg-white outline-none focus:ring focus:ring-indigo-300\"
    type=\"text\"
    id=\"{{ name }}\"
    name=\"{{ name }}\"
    value=\"{{ value|e }}\"
  />
{% endmacro %}

{% macro password(name, label) %}
  <label class=\"block text-xs text-slate-600 font-semibold mb-1\" for=\"{{ name }}\">
    {{ label }}
  </label>
  <input
    class=\"w-full border rounded px-3 py-2 text-sm text-slate-800 bg-white outline-none focus:ring focus:ring-indigo-300\"
    type=\"password\"
    id=\"{{ name }}\"
    name=\"{{ name }}\"
  />
{% endmacro %}
", "macros/form.twig", "/Users/memran/projects/php-projects/marwa-view/examples/basic/views/macros/form.twig");
    }
}
