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

/* @Blog/teaser.twig */
class __TwigTemplate_d9c13368df0138ae107802e93c34420e extends Template
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
        yield "<section class=\"rounded-xl border border-cyan-300/40 bg-cyan-50/80 p-4 text-sm text-cyan-950 shadow-sm\">
  <div class=\"font-semibold\">Namespaced View Demo</div>
  <p class=\"mt-1 text-cyan-900/80\">
    This card was rendered from <code>@Blog/teaser</code> using the Marwa\\View namespace registry.
  </p>
  <p class=\"mt-2 text-xs text-cyan-900/70\">
    Application: ";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["appName"]) || array_key_exists("appName", $context) ? $context["appName"] : (function () { throw new RuntimeError('Variable "appName" does not exist.', 7, $this->source); })()), "html", null, true);
        yield "
  </p>
</section>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@Blog/teaser.twig";
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
        return array (  50 => 7,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<section class=\"rounded-xl border border-cyan-300/40 bg-cyan-50/80 p-4 text-sm text-cyan-950 shadow-sm\">
  <div class=\"font-semibold\">Namespaced View Demo</div>
  <p class=\"mt-1 text-cyan-900/80\">
    This card was rendered from <code>@Blog/teaser</code> using the Marwa\\View namespace registry.
  </p>
  <p class=\"mt-2 text-xs text-cyan-900/70\">
    Application: {{ appName }}
  </p>
</section>
", "@Blog/teaser.twig", "/Users/memran/projects/php-projects/marwa-view/examples/basic/modules/Blog/views/teaser.twig");
    }
}
