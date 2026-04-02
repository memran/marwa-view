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

/* simple-demo.twig */
class __TwigTemplate_9a0d0c4fd329f76fdab11eb646e0e1b6 extends Template
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

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "layouts/base.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 2
        $macros["forms"] = $this->macros["forms"] = $this->load("macros/form.twig", 2)->unwrap();
        // line 1
        $this->parent = $this->load("layouts/base.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new RuntimeError('Variable "title" does not exist.', 4, $this->source); })()), "html", null, true);
        yield " - ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["appName"]) || array_key_exists("appName", $context) ? $context["appName"] : (function () { throw new RuntimeError('Variable "appName" does not exist.', 4, $this->source); })()), "html", null, true);
        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 7
        yield "  ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Marwa\View\Extension\MetaStackExtension']->pushMeta("description", "Simple example page demonstrating Marwa\\View helpers."), "html", null, true);
        yield "
  ";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Marwa\View\Extension\MetaStackExtension']->pushLinkTag("canonical", $this->env->getFunction('url')->getCallable()("/examples/simple-demo")), "html", null, true);
        yield "
  <main class=\"mx-auto max-w-6xl px-6 py-14 sm:px-8\">
    <section class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-8 shadow-glow backdrop-blur sm:p-10\">
      <div class=\"flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between\">
        <div class=\"max-w-3xl\">
          <div class=\"inline-flex rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-brand-100\">
            Simple Demo
          </div>
          <h1 class=\"mt-5 text-4xl font-extrabold tracking-tight text-white\">";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new RuntimeError('Variable "title" does not exist.', 16, $this->source); })()), "html", null, true);
        yield "</h1>
          <p class=\"mt-4 text-lg leading-8 text-slate-300\">
            A compact example showing translation, cached fragments, nested views, macros, and normal template control flow through the Marwa\\View API.
          </p>
        </div>
        <div class=\"rounded-3xl border border-emerald-400/20 bg-emerald-500/10 px-5 py-4 text-sm text-emerald-100\">
          Welcome back, <strong>";
        // line 22
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "name", [], "any", true, true, false, 22)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 22, $this->source); })()), "name", [], "any", false, false, false, 22), "Guest")) : ("Guest")), "html", null, true);
        yield "</strong>.
        </div>
      </div>

      <div class=\"mt-10 grid gap-6 xl:grid-cols-[1.4fr_0.8fr]\">
        <div class=\"space-y-6\">
          <section class=\"rounded-3xl border border-white/10 bg-white/6 p-6\">
            <div class=\"flex items-center justify-between gap-3\">
              <h2 class=\"text-xl font-semibold text-white\">Translation</h2>
              <span class=\"rounded-full bg-brand-500/10 px-3 py-1 text-xs font-semibold text-brand-100\">ArrayTranslator</span>
            </div>
            <div class=\"mt-4 space-y-3 text-sm leading-7 text-slate-300\">
              <p class=\"text-2xl font-semibold text-white\">";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Marwa\View\Extension\TranslateExtension']->translate("welcome.title", [":name" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 34, $this->source); })()), "name", [], "any", false, false, false, 34)]), "html", null, true);
        yield "</p>
              <a href=\"#\" class=\"inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1.5 text-xs font-semibold uppercase tracking-[0.2em] text-slate-200 transition hover:bg-white/10\">";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Marwa\View\Extension\TranslateExtension']->translate("logout"), "html", null, true);
        yield "</a>
            </div>
          </section>

          <section class=\"rounded-3xl border border-white/10 bg-slate-950/50 p-6\">
            <div class=\"flex items-center justify-between gap-4\">
              <h2 class=\"text-xl font-semibold text-white\">Client List</h2>
              <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">";
        // line 42
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Marwa\View\Extension\NumberExtension']->compactNumber(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["clients"]) || array_key_exists("clients", $context) ? $context["clients"] : (function () { throw new RuntimeError('Variable "clients" does not exist.', 42, $this->source); })())), 0), "html", null, true);
        yield " records</div>
            </div>
            <div class=\"mt-4 overflow-hidden rounded-2xl border border-white/8\">
              <table class=\"min-w-full divide-y divide-white/8 text-left text-sm\">
                <thead class=\"bg-white/5 text-slate-300\">
                  <tr>
                    <th class=\"px-4 py-3 font-semibold\">#</th>
                    <th class=\"px-4 py-3 font-semibold\">Name</th>
                    <th class=\"px-4 py-3 font-semibold\">Status</th>
                    <th class=\"px-4 py-3 text-right font-semibold\">Revenue</th>
                  </tr>
                </thead>
                <tbody class=\"divide-y divide-white/8 bg-slate-950/30\">
                  ";
        // line 55
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["clients"]) || array_key_exists("clients", $context) ? $context["clients"] : (function () { throw new RuntimeError('Variable "clients" does not exist.', 55, $this->source); })()));
        $context['_iterated'] = false;
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["client"]) {
            // line 56
            yield "                    <tr class=\"text-slate-200\">
                      <td class=\"px-4 py-3 text-slate-500\">";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 57), "html", null, true);
            yield "</td>
                      <td class=\"px-4 py-3 font-medium\">";
            // line 58
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["client"], "name", [], "any", false, false, false, 58), "html", null, true);
            yield "</td>
                      <td class=\"px-4 py-3\">
                        <span class=\"";
            // line 60
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Marwa\View\Extension\HtmlExtension']->classNames("rounded-full px-2.5 py-1 text-xs font-semibold", (((($tmp = CoreExtension::getAttribute($this->env, $this->source,             // line 62
$context["client"], "active", [], "any", false, false, false, 62)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("bg-emerald-500/10 text-emerald-300") : ("bg-slate-700/70 text-slate-300"))), "html", null, true);
            // line 63
            yield "\">
                          ";
            // line 64
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["client"], "active", [], "any", false, false, false, 64)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Active") : ("Inactive"));
            yield "
                        </span>
                      </td>
                      <td class=\"px-4 py-3 text-right font-mono text-slate-300\">";
            // line 67
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Marwa\View\Extension\MoneyExtension']->formatMoney(CoreExtension::getAttribute($this->env, $this->source, $context["client"], "revenue_monthly", [], "any", false, false, false, 67), "USD"), "html", null, true);
            yield "</td>
                    </tr>
                  ";
            $context['_iterated'] = true;
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        // line 69
        if (!$context['_iterated']) {
            // line 70
            yield "                    <tr>
                      <td colspan=\"4\" class=\"px-4 py-5 text-center text-slate-500\">No clients found.</td>
                    </tr>
                  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['client'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 74
        yield "                </tbody>
              </table>
            </div>
          </section>

          <section class=\"rounded-3xl border border-white/10 bg-white/6 p-6\">
            <h2 class=\"text-xl font-semibold text-white\">Macro Example</h2>
            <div class=\"mt-5 grid gap-4 md:grid-cols-2\">
              <div>
                ";
        // line 83
        yield $macros["forms"]->getTemplateForMacro("macro_input", $context, 83, $this->getSourceContext())->macro_input(...["username", "Username", ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "name", [], "any", true, true, false, 83)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 83, $this->source); })()), "name", [], "any", false, false, false, 83), "")) : (""))]);
        yield "
              </div>
              <div>
                ";
        // line 86
        yield $macros["forms"]->getTemplateForMacro("macro_password", $context, 86, $this->getSourceContext())->macro_password(...["password", "Password"]);
        yield "
              </div>
            </div>
          </section>

          <section class=\"rounded-3xl border border-white/10 bg-white/6 p-6\">
            <div class=\"flex items-center gap-3\">
              ";
        // line 93
        yield $this->extensions['Marwa\View\Extension\IconExtension']->renderIcon("server", ["class" => "h-5 w-5 text-brand-200"]);
        yield "
              <h2 class=\"text-xl font-semibold text-white\">Number Helpers</h2>
            </div>
            <div class=\"mt-5 grid gap-4 sm:grid-cols-3\">
              <div class=\"rounded-2xl border border-white/8 bg-slate-950/40 p-4\">
                <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">Sessions</div>
                <div class=\"mt-2 text-2xl font-bold text-white\">";
        // line 99
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Marwa\View\Extension\NumberExtension']->compactNumber(18420), "html", null, true);
        yield "</div>
              </div>
              <div class=\"rounded-2xl border border-white/8 bg-slate-950/40 p-4\">
                <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">Success Rate</div>
                <div class=\"mt-2 text-2xl font-bold text-white\">";
        // line 103
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Marwa\View\Extension\NumberExtension']->formatPercent(99.94, 2), "html", null, true);
        yield "</div>
              </div>
              <div class=\"rounded-2xl border border-white/8 bg-slate-950/40 p-4\">
                <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">Backup Size</div>
                <div class=\"mt-2 text-2xl font-bold text-white\">";
        // line 107
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Marwa\View\Extension\NumberExtension']->formatFileSize(5368709120), "html", null, true);
        yield "</div>
              </div>
            </div>
          </section>
        </div>

        <aside class=\"space-y-6\">
          <section class=\"rounded-3xl border border-white/10 bg-slate-950/60 p-6\">
            <h2 class=\"text-lg font-semibold text-white\">Fragment Example</h2>
            <p class=\"mt-2 text-sm leading-6 text-slate-400\">The sidebar below is rendered through <code class=\"font-mono text-slate-200\">fragment()</code> and cached separately.</p>
            <div class=\"mt-4\">
              ";
        // line 118
        yield $this->env->getFunction('fragment')->getCallable()("simple_sidebar", 120, ["template" => "partials/sidebar", "data" => ["user" =>         // line 120
(isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 120, $this->source); })())]]);
        // line 121
        yield "
            </div>
          </section>

          <section class=\"rounded-3xl border border-white/10 bg-slate-950/60 p-6\">
            <h2 class=\"text-lg font-semibold text-white\">Sub-view Example</h2>
            <div class=\"mt-4\">
              ";
        // line 128
        yield $this->env->getFunction('view')->getCallable()("components/card-info", ["title" => "Quick Info", "note" => "Rendered with view() inside a parent template while keeping the application API Twig-agnostic."]);
        // line 131
        yield "
            </div>
          </section>

          <section class=\"rounded-3xl border border-white/10 bg-slate-950/60 p-6\">
            <h2 class=\"text-lg font-semibold text-white\">HTML Helper Example</h2>
            <button ";
        // line 137
        yield $this->extensions['Marwa\View\Extension\HtmlExtension']->htmlAttrs(["type" => "button", "class" => ["mt-4 inline-flex items-center rounded-full px-4 py-2 text-sm font-semibold transition", (((CoreExtension::getAttribute($this->env, $this->source,         // line 141
(isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 141, $this->source); })()), "role", [], "any", false, false, false, 141) == "admin")) ? ("bg-brand-500 text-white") : ("bg-white/10 text-slate-100"))], "data-role" => CoreExtension::getAttribute($this->env, $this->source,         // line 143
(isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 143, $this->source); })()), "role", [], "any", false, false, false, 143), "aria-label" => "Open account panel"]);
        // line 145
        yield ">
              Open account panel
            </button>
          </section>
        </aside>
      </div>

      ";
        // line 152
        yield $this->env->getFunction('view')->getCallable()("components/footer");
        yield "
    </section>
  </main>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "simple-demo.twig";
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
        return array (  312 => 152,  303 => 145,  301 => 143,  300 => 141,  299 => 137,  291 => 131,  289 => 128,  280 => 121,  278 => 120,  277 => 118,  263 => 107,  256 => 103,  249 => 99,  240 => 93,  230 => 86,  224 => 83,  213 => 74,  204 => 70,  202 => 69,  187 => 67,  181 => 64,  178 => 63,  176 => 62,  175 => 60,  170 => 58,  166 => 57,  163 => 56,  145 => 55,  129 => 42,  119 => 35,  115 => 34,  100 => 22,  91 => 16,  80 => 8,  75 => 7,  68 => 6,  55 => 4,  50 => 1,  48 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"layouts/base.twig\" %}
{% import \"macros/form.twig\" as forms %}

{% block title %}{{ title }} - {{ appName }}{% endblock %}

{% block body %}
  {{ push_meta('description', 'Simple example page demonstrating Marwa\\\\View helpers.') }}
  {{ push_link_tag('canonical', url('/examples/simple-demo')) }}
  <main class=\"mx-auto max-w-6xl px-6 py-14 sm:px-8\">
    <section class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-8 shadow-glow backdrop-blur sm:p-10\">
      <div class=\"flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between\">
        <div class=\"max-w-3xl\">
          <div class=\"inline-flex rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-brand-100\">
            Simple Demo
          </div>
          <h1 class=\"mt-5 text-4xl font-extrabold tracking-tight text-white\">{{ title }}</h1>
          <p class=\"mt-4 text-lg leading-8 text-slate-300\">
            A compact example showing translation, cached fragments, nested views, macros, and normal template control flow through the Marwa\\View API.
          </p>
        </div>
        <div class=\"rounded-3xl border border-emerald-400/20 bg-emerald-500/10 px-5 py-4 text-sm text-emerald-100\">
          Welcome back, <strong>{{ user.name|default('Guest') }}</strong>.
        </div>
      </div>

      <div class=\"mt-10 grid gap-6 xl:grid-cols-[1.4fr_0.8fr]\">
        <div class=\"space-y-6\">
          <section class=\"rounded-3xl border border-white/10 bg-white/6 p-6\">
            <div class=\"flex items-center justify-between gap-3\">
              <h2 class=\"text-xl font-semibold text-white\">Translation</h2>
              <span class=\"rounded-full bg-brand-500/10 px-3 py-1 text-xs font-semibold text-brand-100\">ArrayTranslator</span>
            </div>
            <div class=\"mt-4 space-y-3 text-sm leading-7 text-slate-300\">
              <p class=\"text-2xl font-semibold text-white\">{{ t('welcome.title', {':name': user.name}) }}</p>
              <a href=\"#\" class=\"inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1.5 text-xs font-semibold uppercase tracking-[0.2em] text-slate-200 transition hover:bg-white/10\">{{ t('logout') }}</a>
            </div>
          </section>

          <section class=\"rounded-3xl border border-white/10 bg-slate-950/50 p-6\">
            <div class=\"flex items-center justify-between gap-4\">
              <h2 class=\"text-xl font-semibold text-white\">Client List</h2>
              <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">{{ compact_number(clients|length, 0) }} records</div>
            </div>
            <div class=\"mt-4 overflow-hidden rounded-2xl border border-white/8\">
              <table class=\"min-w-full divide-y divide-white/8 text-left text-sm\">
                <thead class=\"bg-white/5 text-slate-300\">
                  <tr>
                    <th class=\"px-4 py-3 font-semibold\">#</th>
                    <th class=\"px-4 py-3 font-semibold\">Name</th>
                    <th class=\"px-4 py-3 font-semibold\">Status</th>
                    <th class=\"px-4 py-3 text-right font-semibold\">Revenue</th>
                  </tr>
                </thead>
                <tbody class=\"divide-y divide-white/8 bg-slate-950/30\">
                  {% for client in clients %}
                    <tr class=\"text-slate-200\">
                      <td class=\"px-4 py-3 text-slate-500\">{{ loop.index }}</td>
                      <td class=\"px-4 py-3 font-medium\">{{ client.name }}</td>
                      <td class=\"px-4 py-3\">
                        <span class=\"{{ class_names(
                          'rounded-full px-2.5 py-1 text-xs font-semibold',
                          client.active ? 'bg-emerald-500/10 text-emerald-300' : 'bg-slate-700/70 text-slate-300'
                        ) }}\">
                          {{ client.active ? 'Active' : 'Inactive' }}
                        </span>
                      </td>
                      <td class=\"px-4 py-3 text-right font-mono text-slate-300\">{{ money(client.revenue_monthly, 'USD') }}</td>
                    </tr>
                  {% else %}
                    <tr>
                      <td colspan=\"4\" class=\"px-4 py-5 text-center text-slate-500\">No clients found.</td>
                    </tr>
                  {% endfor %}
                </tbody>
              </table>
            </div>
          </section>

          <section class=\"rounded-3xl border border-white/10 bg-white/6 p-6\">
            <h2 class=\"text-xl font-semibold text-white\">Macro Example</h2>
            <div class=\"mt-5 grid gap-4 md:grid-cols-2\">
              <div>
                {{ forms.input('username', 'Username', user.name|default('')) }}
              </div>
              <div>
                {{ forms.password('password', 'Password') }}
              </div>
            </div>
          </section>

          <section class=\"rounded-3xl border border-white/10 bg-white/6 p-6\">
            <div class=\"flex items-center gap-3\">
              {{ icon('server', { class: 'h-5 w-5 text-brand-200' }) }}
              <h2 class=\"text-xl font-semibold text-white\">Number Helpers</h2>
            </div>
            <div class=\"mt-5 grid gap-4 sm:grid-cols-3\">
              <div class=\"rounded-2xl border border-white/8 bg-slate-950/40 p-4\">
                <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">Sessions</div>
                <div class=\"mt-2 text-2xl font-bold text-white\">{{ compact_number(18420) }}</div>
              </div>
              <div class=\"rounded-2xl border border-white/8 bg-slate-950/40 p-4\">
                <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">Success Rate</div>
                <div class=\"mt-2 text-2xl font-bold text-white\">{{ percent(99.94, 2) }}</div>
              </div>
              <div class=\"rounded-2xl border border-white/8 bg-slate-950/40 p-4\">
                <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">Backup Size</div>
                <div class=\"mt-2 text-2xl font-bold text-white\">{{ file_size(5368709120) }}</div>
              </div>
            </div>
          </section>
        </div>

        <aside class=\"space-y-6\">
          <section class=\"rounded-3xl border border-white/10 bg-slate-950/60 p-6\">
            <h2 class=\"text-lg font-semibold text-white\">Fragment Example</h2>
            <p class=\"mt-2 text-sm leading-6 text-slate-400\">The sidebar below is rendered through <code class=\"font-mono text-slate-200\">fragment()</code> and cached separately.</p>
            <div class=\"mt-4\">
              {{ fragment('simple_sidebar', 120, {
                  template: 'partials/sidebar',
                  data: { user: user }
              })|raw }}
            </div>
          </section>

          <section class=\"rounded-3xl border border-white/10 bg-slate-950/60 p-6\">
            <h2 class=\"text-lg font-semibold text-white\">Sub-view Example</h2>
            <div class=\"mt-4\">
              {{ view('components/card-info', {
                  title: 'Quick Info',
                  note: 'Rendered with view() inside a parent template while keeping the application API Twig-agnostic.'
              })|raw }}
            </div>
          </section>

          <section class=\"rounded-3xl border border-white/10 bg-slate-950/60 p-6\">
            <h2 class=\"text-lg font-semibold text-white\">HTML Helper Example</h2>
            <button {{ html_attrs({
              type: 'button',
              class: [
                'mt-4 inline-flex items-center rounded-full px-4 py-2 text-sm font-semibold transition',
                user.role == 'admin' ? 'bg-brand-500 text-white' : 'bg-white/10 text-slate-100'
              ],
              'data-role': user.role,
              'aria-label': 'Open account panel'
            }) }}>
              Open account panel
            </button>
          </section>
        </aside>
      </div>

      {{ view('components/footer')|raw }}
    </section>
  </main>
{% endblock %}
", "simple-demo.twig", "/Users/memran/projects/php-projects/marwa-view/examples/basic/views/simple-demo.twig");
    }
}
