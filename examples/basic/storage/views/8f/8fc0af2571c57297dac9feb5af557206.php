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

/* partials/footer.twig */
class __TwigTemplate_8bd6dc1a0ec8c6a3ed891eb61c95a869 extends Template
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
        yield "<footer class=\"mt-24 border-t border-slate-200/60 dark:border-slate-800/60\">
  <div class=\"mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10 text-sm text-slate-500 dark:text-slate-400\">
    <div class=\"flex flex-col sm:flex-row items-center justify-between gap-4\">
      <p>© ";
        // line 4
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield " MarwaPHP. All rights reserved.</p>
      <div class=\"flex items-center gap-4\">
        <a href=\"#docs\" class=\"hover:text-brand transition\">Docs</a>
        <a href=\"#license\" class=\"hover:text-brand transition\">License</a>
        <a href=\"#github\" class=\"hover:text-brand transition\">GitHub</a>
      </div>
    </div>
  </div>
</footer>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "partials/footer.twig";
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
        return array (  47 => 4,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<footer class=\"mt-24 border-t border-slate-200/60 dark:border-slate-800/60\">
  <div class=\"mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10 text-sm text-slate-500 dark:text-slate-400\">
    <div class=\"flex flex-col sm:flex-row items-center justify-between gap-4\">
      <p>© {{ \"now\"|date(\"Y\") }} MarwaPHP. All rights reserved.</p>
      <div class=\"flex items-center gap-4\">
        <a href=\"#docs\" class=\"hover:text-brand transition\">Docs</a>
        <a href=\"#license\" class=\"hover:text-brand transition\">License</a>
        <a href=\"#github\" class=\"hover:text-brand transition\">GitHub</a>
      </div>
    </div>
  </div>
</footer>", "partials/footer.twig", "/Users/memran/projects/php-projects/marwa-view/examples/basic/views/partials/footer.twig");
    }
}
