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

/* partials/sidebar.twig */
class __TwigTemplate_8f9004e0e4ffad58eff15ee2cb52d0f3 extends Template
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
        yield "<aside class=\"rounded-2xl border border-white/10 bg-slate-900/70 p-5 shadow-lg shadow-slate-950/20\">
  <div class=\"text-xs font-semibold uppercase tracking-[0.24em] text-brand-200\">Cached Fragment</div>
  <h3 class=\"mt-3 text-lg font-semibold text-white\">Sidebar Snapshot</h3>
  <dl class=\"mt-4 space-y-3 text-sm text-slate-300\">
    <div class=\"flex items-center justify-between gap-3\">
      <dt class=\"text-slate-500\">User</dt>
      <dd class=\"font-medium text-slate-100\">";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 7, $this->source); })()), "name", [], "any", false, false, false, 7), "html", null, true);
        yield "</dd>
    </div>
    <div class=\"flex items-center justify-between gap-3\">
      <dt class=\"text-slate-500\">Role</dt>
      <dd class=\"rounded-full bg-brand-500/10 px-2.5 py-1 text-xs font-semibold text-brand-100\">";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 11, $this->source); })()), "role", [], "any", false, false, false, 11)), "html", null, true);
        yield "</dd>
    </div>
  </dl>
</aside>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "partials/sidebar.twig";
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
        return array (  57 => 11,  50 => 7,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<aside class=\"rounded-2xl border border-white/10 bg-slate-900/70 p-5 shadow-lg shadow-slate-950/20\">
  <div class=\"text-xs font-semibold uppercase tracking-[0.24em] text-brand-200\">Cached Fragment</div>
  <h3 class=\"mt-3 text-lg font-semibold text-white\">Sidebar Snapshot</h3>
  <dl class=\"mt-4 space-y-3 text-sm text-slate-300\">
    <div class=\"flex items-center justify-between gap-3\">
      <dt class=\"text-slate-500\">User</dt>
      <dd class=\"font-medium text-slate-100\">{{ user.name }}</dd>
    </div>
    <div class=\"flex items-center justify-between gap-3\">
      <dt class=\"text-slate-500\">Role</dt>
      <dd class=\"rounded-full bg-brand-500/10 px-2.5 py-1 text-xs font-semibold text-brand-100\">{{ user.role|capitalize }}</dd>
    </div>
  </dl>
</aside>
", "partials/sidebar.twig", "/Users/memran/projects/php-projects/marwa-view/examples/basic/views/partials/sidebar.twig");
    }
}
