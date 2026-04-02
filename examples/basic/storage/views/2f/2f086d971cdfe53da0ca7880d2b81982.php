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

/* components/card-info.twig */
class __TwigTemplate_c2aaae863d9cb64c42d91a5dbb9c39be extends Template
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
        // line 1
        yield "<div class=\"rounded-2xl border border-white/10 bg-white/6 p-5 shadow-lg shadow-slate-950/20 backdrop-blur\">
  <div class=\"text-sm font-semibold text-white\">";
        // line 2
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new RuntimeError('Variable "title" does not exist.', 2, $this->source); })()), "html", null, true);
        yield "</div>
  <p class=\"mt-2 text-sm leading-6 text-slate-300\">";
        // line 3
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["note"]) || array_key_exists("note", $context) ? $context["note"] : (function () { throw new RuntimeError('Variable "note" does not exist.', 3, $this->source); })()), "html", null, true);
        yield "</p>
</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "components/card-info.twig";
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
        return array (  49 => 3,  45 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"rounded-2xl border border-white/10 bg-white/6 p-5 shadow-lg shadow-slate-950/20 backdrop-blur\">
  <div class=\"text-sm font-semibold text-white\">{{ title }}</div>
  <p class=\"mt-2 text-sm leading-6 text-slate-300\">{{ note }}</p>
</div>
", "components/card-info.twig", "/Users/memran/projects/php-projects/marwa-view/examples/basic/views/components/card-info.twig");
    }
}
