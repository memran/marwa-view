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

/* components/footer.twig */
class __TwigTemplate_ff2350631d12ff4f17156360a99fd00a extends Template
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
        yield "<footer class=\"mt-8 border-t border-white/10 pt-5 text-sm text-slate-400\">
  <div class=\"flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between\">
    <p>&copy; ";
        // line 3
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["appName"]) || array_key_exists("appName", $context) ? $context["appName"] : (function () { throw new RuntimeError('Variable "appName" does not exist.', 3, $this->source); })()), "html", null, true);
        yield ". Built with Marwa\\View.</p>
    <div class=\"flex items-center gap-3 text-xs uppercase tracking-[0.2em] text-slate-500\">
      <span>PHP 8.2+</span>
      <span>Twig Internals</span>
      <span>Developer First</span>
    </div>
  </div>
</footer>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "components/footer.twig";
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
        return array (  46 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<footer class=\"mt-8 border-t border-white/10 pt-5 text-sm text-slate-400\">
  <div class=\"flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between\">
    <p>&copy; {{ \"now\"|date(\"Y\") }} {{ appName }}. Built with Marwa\\View.</p>
    <div class=\"flex items-center gap-3 text-xs uppercase tracking-[0.2em] text-slate-500\">
      <span>PHP 8.2+</span>
      <span>Twig Internals</span>
      <span>Developer First</span>
    </div>
  </div>
</footer>
", "components/footer.twig", "/Users/memran/projects/php-projects/marwa-view/examples/basic/views/components/footer.twig");
    }
}
