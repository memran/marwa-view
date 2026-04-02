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

/* full-demo.twig */
class __TwigTemplate_1b0a654eddd1b0f3b594bf4c7529a278 extends Template
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
        // line 14
        return "layouts/base.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("layouts/base.twig", 14);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 16
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Full Demo | ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["appName"]) || array_key_exists("appName", $context) ? $context["appName"] : (function () { throw new RuntimeError('Variable "appName" does not exist.', 16, $this->source); })()), "html", null, true);
        yield from [];
    }

    // line 18
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 19
        yield "  ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Marwa\View\Extension\MetaStackExtension']->pushMeta("description", "Full Marwa\\View demo with stacks, namespaced views, icons, and formatting helpers."), "html", null, true);
        yield "
  ";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Marwa\View\Extension\MetaStackExtension']->pushPropertyMeta("og:title", ((isset($context["appName"]) || array_key_exists("appName", $context) ? $context["appName"] : (function () { throw new RuntimeError('Variable "appName" does not exist.', 20, $this->source); })()) . " demo")), "html", null, true);
        yield "
  ";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Marwa\View\Extension\MetaStackExtension']->pushScriptTag($this->env->getFunction('url')->getCallable()("/static/app.js"), ["defer" => true]), "html", null, true);
        yield "
  ";
        // line 22
        $context["analyticsScript"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 23
            yield "    <script>
      window.demoAnalytics = { page: 'full-demo', app: '";
            // line 24
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["appName"]) || array_key_exists("appName", $context) ? $context["appName"] : (function () { throw new RuntimeError('Variable "appName" does not exist.', 24, $this->source); })()), "js"), "html", null, true);
            yield "' };
    </script>
  ";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 27
        yield "  ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('push')->getCallable()("scripts", (isset($context["analyticsScript"]) || array_key_exists("analyticsScript", $context) ? $context["analyticsScript"] : (function () { throw new RuntimeError('Variable "analyticsScript" does not exist.', 27, $this->source); })())), "html", null, true);
        yield "

  ";
        // line 29
        $context["headMeta"] = new Markup("    <meta name=\"demo-module\" content=\"full-demo\"/>
  ", $this->env->getCharset());
        // line 32
        yield "  ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('prepend')->getCallable()("head", (isset($context["headMeta"]) || array_key_exists("headMeta", $context) ? $context["headMeta"] : (function () { throw new RuntimeError('Variable "headMeta" does not exist.', 32, $this->source); })())), "html", null, true);
        yield "

  ";
        // line 34
        $context["total"] = 0;
        // line 35
        yield "  ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["clients"]) || array_key_exists("clients", $context) ? $context["clients"] : (function () { throw new RuntimeError('Variable "clients" does not exist.', 35, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["client"]) {
            // line 36
            yield "    ";
            $context["total"] = ((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 36, $this->source); })()) + CoreExtension::getAttribute($this->env, $this->source, $context["client"], "revenue_monthly", [], "any", false, false, false, 36));
            // line 37
            yield "  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['client'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        yield "
  <main class=\"mx-auto max-w-7xl px-6 py-14 sm:px-8\">
    <header class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-8 shadow-glow backdrop-blur sm:p-10\">
      <div class=\"flex flex-col gap-8 xl:flex-row xl:items-end xl:justify-between\">
        <div class=\"max-w-3xl\">
          <div class=\"inline-flex rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-brand-100\">
            Full Demo
          </div>
          <h1 class=\"mt-5 text-4xl font-extrabold tracking-tight text-white sm:text-5xl\">
            Framework-style templates with modern defaults
          </h1>
          <p class=\"mt-4 text-lg leading-8 text-slate-300\">
            This example demonstrates control flow, nested rendering, namespaced module views, shared globals, and stack injection through a single developer-facing template.
          </p>
        </div>

        <div class=\"grid gap-3 sm:grid-cols-3 xl:min-w-[420px]\">
          <div class=\"rounded-3xl border border-white/10 bg-white/6 p-4\">
            <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">Session</div>
            <div class=\"mt-2 text-2xl font-bold text-white\">";
        // line 57
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Marwa\View\Extension\NumberExtension']->formatNumber((CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 57, $this->source); })()), "session_minutes", [], "any", false, false, false, 57) / 60), 1), "html", null, true);
        yield "h</div>
          </div>
          <div class=\"rounded-3xl border border-white/10 bg-white/6 p-4\">
            <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">Clients</div>
            <div class=\"mt-2 text-2xl font-bold text-white\">";
        // line 61
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Marwa\View\Extension\NumberExtension']->formatNumber(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["clients"]) || array_key_exists("clients", $context) ? $context["clients"] : (function () { throw new RuntimeError('Variable "clients" does not exist.', 61, $this->source); })()))), "html", null, true);
        yield "</div>
          </div>
          <div class=\"rounded-3xl border border-white/10 bg-white/6 p-4\">
            <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">Revenue</div>
            <div class=\"mt-2 text-2xl font-bold text-white\">";
        // line 65
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Marwa\View\Extension\NumberExtension']->compactNumber((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 65, $this->source); })()), 1), "html", null, true);
        yield "</div>
          </div>
        </div>
      </div>

      <div class=\"mt-8 grid gap-4 lg:grid-cols-[1.5fr_0.7fr]\">
        <div class=\"rounded-3xl border border-white/10 bg-slate-950/50 p-5 text-sm leading-7 text-slate-300\">
          Hello, <span class=\"font-semibold text-white\">";
        // line 72
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::titleCase($this->env->getCharset(), ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "name", [], "any", true, true, false, 72)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 72, $this->source); })()), "name", [], "any", false, false, false, 72), "Guest")) : ("Guest"))), "html", null, true);
        yield "</span>. You are inside <strong class=\"text-white\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["appName"]) || array_key_exists("appName", $context) ? $context["appName"] : (function () { throw new RuntimeError('Variable "appName" does not exist.', 72, $this->source); })()), "html", null, true);
        yield "</strong> and rendering through a stable API.
          <div class=\"mt-3 rounded-2xl bg-white/5 px-4 py-3 font-mono text-xs text-slate-400\">CSRF token: ";
        // line 73
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["csrf"]) || array_key_exists("csrf", $context) ? $context["csrf"] : (function () { throw new RuntimeError('Variable "csrf" does not exist.', 73, $this->source); })()), "html", null, true);
        yield "</div>
        </div>
        <div class=\"rounded-3xl border border-white/10 bg-slate-950/50 p-5 text-sm leading-7 text-slate-300\">
          <div>Account created: <span class=\"font-medium text-white\">";
        // line 76
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 76, $this->source); })()), "created_at", [], "any", false, false, false, 76), "Y-m-d H:i"), "html", null, true);
        yield "</span></div>
          <div class=\"mt-2\">Role: <span class=\"font-medium text-white\">";
        // line 77
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::titleCase($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 77, $this->source); })()), "role", [], "any", false, false, false, 77)), "html", null, true);
        yield "</span></div>
        </div>
      </div>
    </header>

    <section class=\"mt-8 grid gap-6 xl:grid-cols-[1.2fr_0.8fr]\">
      <div class=\"space-y-6\">
        <section class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-6 backdrop-blur\">
          <div class=\"flex items-center gap-3\">
            ";
        // line 86
        yield $this->extensions['Marwa\View\Extension\IconExtension']->renderIcon("spark", ["class" => "h-5 w-5 text-brand-200"]);
        yield "
            <h2 class=\"text-xl font-semibold text-white\">Conditional Logic</h2>
          </div>

          ";
        // line 90
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 90, $this->source); })()), "is_admin", [], "any", false, false, false, 90)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 91
            yield "            <div class=\"mt-4 rounded-3xl border border-emerald-400/20 bg-emerald-500/10 p-4 text-sm text-emerald-100\">
              Administrator access is enabled for this session.
            </div>
          ";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source,         // line 94
(isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 94, $this->source); })()), "role", [], "any", false, false, false, 94) == "manager")) {
            // line 95
            yield "            <div class=\"mt-4 rounded-3xl border border-blue-400/20 bg-blue-500/10 p-4 text-sm text-blue-100\">
              Manager dashboard access is active.
            </div>
          ";
        } else {
            // line 99
            yield "            <div class=\"mt-4 rounded-3xl border border-amber-400/20 bg-amber-500/10 p-4 text-sm text-amber-100\">
              Standard user privileges are active.
            </div>
          ";
        }
        // line 103
        yield "        </section>


        <section class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-6 backdrop-blur\">
          <div class=\"flex items-center justify-between gap-4\">
            <h2 class=\"text-xl font-semibold text-white\">Looping Over Collections</h2>
            <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">for / else</div>
          </div>

          <div class=\"mt-4 overflow-hidden rounded-3xl border border-white/8\">
            <table class=\"w-full text-left text-sm\">
              <thead class=\"bg-white/5 text-slate-300\">
                <tr>
                  <th class=\"px-4 py-3 font-semibold\">#</th>
                  <th class=\"px-4 py-3 font-semibold\">Client</th>
                  <th class=\"px-4 py-3 font-semibold\">Status</th>
                  <th class=\"px-4 py-3 text-right font-semibold\">Revenue</th>
                </tr>
              </thead>
              <tbody class=\"divide-y divide-white/8 bg-slate-950/30\">
              ";
        // line 123
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["clients"]) || array_key_exists("clients", $context) ? $context["clients"] : (function () { throw new RuntimeError('Variable "clients" does not exist.', 123, $this->source); })()));
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
            // line 124
            yield "                <tr class=\"text-slate-200\">
                  <td class=\"px-4 py-3 text-slate-500\">";
            // line 125
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 125), "html", null, true);
            yield "</td>
                  <td class=\"px-4 py-3 font-medium\">";
            // line 126
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["client"], "name", [], "any", false, false, false, 126), "html", null, true);
            yield "</td>
                  <td class=\"px-4 py-3\">
                    <span class=\"";
            // line 128
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Marwa\View\Extension\HtmlExtension']->classNames("rounded-full px-2.5 py-1 text-xs font-semibold", (((($tmp = CoreExtension::getAttribute($this->env, $this->source,             // line 130
$context["client"], "active", [], "any", false, false, false, 130)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("bg-emerald-500/10 text-emerald-300") : ("bg-slate-700/70 text-slate-300"))), "html", null, true);
            // line 131
            yield "\">
                      ";
            // line 132
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["client"], "active", [], "any", false, false, false, 132)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Active") : ("Inactive"));
            yield "
                    </span>
                  </td>
                  <td class=\"px-4 py-3 text-right font-mono text-slate-300\">
                    ";
            // line 136
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Marwa\View\Extension\MoneyExtension']->formatMoney(CoreExtension::getAttribute($this->env, $this->source, $context["client"], "revenue_monthly", [], "any", false, false, false, 136), "USD"), "html", null, true);
            yield "
                  </td>
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
        // line 139
        if (!$context['_iterated']) {
            // line 140
            yield "                <tr>
                  <td colspan=\"4\" class=\"px-4 py-5 text-center text-slate-500\">
                    No clients found.
                  </td>
                </tr>
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['client'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 146
        yield "              </tbody>
            </table>
          </div>

          <p class=\"mt-4 text-sm text-slate-400\">
            Total revenue this month:
            <strong class=\"font-mono text-white\">";
        // line 152
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Marwa\View\Extension\MoneyExtension']->formatMoney((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 152, $this->source); })()), "USD"), "html", null, true);
        yield "</strong>
          </p>
        </section>


        <section class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-6 backdrop-blur\">
          <h2 class=\"text-xl font-semibold text-white\">Variable Manipulation</h2>

          ";
        // line 160
        $context["welcome"] = ("hello " . ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "name", [], "any", true, true, false, 160)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 160, $this->source); })()), "name", [], "any", false, false, false, 160), "friend")) : ("friend")));
        // line 161
        yield "          ";
        $context["shout"] = mb_strtoupper((isset($context["welcome"]) || array_key_exists("welcome", $context) ? $context["welcome"] : (function () { throw new RuntimeError('Variable "welcome" does not exist.', 161, $this->source); })()));
        // line 162
        yield "
          <div class=\"mt-4 rounded-3xl bg-slate-950/70 p-5 font-mono text-xs leading-7 text-slate-200\">
            welcome = \"";
        // line 164
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["welcome"]) || array_key_exists("welcome", $context) ? $context["welcome"] : (function () { throw new RuntimeError('Variable "welcome" does not exist.', 164, $this->source); })()), "html", null, true);
        yield "\"<br>
            shout   = \"";
        // line 165
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["shout"]) || array_key_exists("shout", $context) ? $context["shout"] : (function () { throw new RuntimeError('Variable "shout" does not exist.', 165, $this->source); })()), "html", null, true);
        yield "\"<br>
            length  = ";
        // line 166
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["welcome"]) || array_key_exists("welcome", $context) ? $context["welcome"] : (function () { throw new RuntimeError('Variable "welcome" does not exist.', 166, $this->source); })())), "html", null, true);
        yield " chars<br>
            now     = ";
        // line 167
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "c"), "html", null, true);
        yield "<br>
          </div>
        </section>
      </div>

      <div class=\"space-y-6\">
        <section class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-6 backdrop-blur\">
          <h2 class=\"text-xl font-semibold text-white\">Namespaced Module Views</h2>
          <p class=\"mt-2 text-sm leading-6 text-slate-400\">The card below is rendered from <code class=\"font-mono text-slate-200\">@Blog/teaser</code>.</p>
          <div class=\"mt-4\">
            ";
        // line 177
        yield $this->env->getFunction('view')->getCallable()("@Blog/teaser", ["appName" => (isset($context["appName"]) || array_key_exists("appName", $context) ? $context["appName"] : (function () { throw new RuntimeError('Variable "appName" does not exist.', 177, $this->source); })())]);
        yield "
          </div>
        </section>

        <section class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-6 backdrop-blur\">
          <h2 class=\"text-xl font-semibold text-white\">Template Notes</h2>
          <ul class=\"mt-4 space-y-3 text-sm leading-6 text-slate-300\">
            <li>Stack content is injected into the shared layout head and scripts sections.</li>
            <li>Application code still renders through <code class=\"font-mono text-slate-200\">\$view->render()</code>.</li>
            <li>Nested views and fragment caching stay available without leaking Twig into the application layer.</li>
          </ul>
          <div class=\"mt-5 rounded-3xl bg-slate-950/50 p-4 text-xs text-slate-400\">
            ";
        // line 189
        yield $this->extensions['Marwa\View\Extension\JsonExtension']->scriptTag("demo-state", ["app" =>         // line 190
(isset($context["appName"]) || array_key_exists("appName", $context) ? $context["appName"] : (function () { throw new RuntimeError('Variable "appName" does not exist.', 190, $this->source); })()), "user" => ["id" => CoreExtension::getAttribute($this->env, $this->source,         // line 191
(isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 191, $this->source); })()), "id", [], "any", false, false, false, 191), "role" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 191, $this->source); })()), "role", [], "any", false, false, false, 191)], "clientCount" => Twig\Extension\CoreExtension::length($this->env->getCharset(),         // line 192
(isset($context["clients"]) || array_key_exists("clients", $context) ? $context["clients"] : (function () { throw new RuntimeError('Variable "clients" does not exist.', 192, $this->source); })()))]);
        // line 193
        yield "
            Frontend bootstrap payload embedded with <code class=\"font-mono text-slate-200\">json_script()</code>.
          </div>
        </section>
      </div>
    </section>



    ";
        // line 203
        yield "    ";
        // line 204
        yield "    ";
        // line 205
        yield "    <footer class=\"pt-10 text-center text-[11px] text-slate-500\">
      ";
        // line 206
        yield from $this->load("partials/footer.twig", 206)->unwrap()->yield($context);
        // line 207
        yield "    </footer>

  </main>

";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "full-demo.twig";
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
        return array (  415 => 207,  413 => 206,  410 => 205,  408 => 204,  406 => 203,  395 => 193,  393 => 192,  392 => 191,  391 => 190,  390 => 189,  375 => 177,  362 => 167,  358 => 166,  354 => 165,  350 => 164,  346 => 162,  343 => 161,  341 => 160,  330 => 152,  322 => 146,  311 => 140,  309 => 139,  293 => 136,  286 => 132,  283 => 131,  281 => 130,  280 => 128,  275 => 126,  271 => 125,  268 => 124,  250 => 123,  228 => 103,  222 => 99,  216 => 95,  214 => 94,  209 => 91,  207 => 90,  200 => 86,  188 => 77,  184 => 76,  178 => 73,  172 => 72,  162 => 65,  155 => 61,  148 => 57,  127 => 38,  121 => 37,  118 => 36,  113 => 35,  111 => 34,  105 => 32,  102 => 29,  96 => 27,  89 => 24,  86 => 23,  84 => 22,  80 => 21,  76 => 20,  71 => 19,  64 => 18,  52 => 16,  41 => 14,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# ====================================================================== #}
{# full-demo.twig                                                         #}
{# A \"kitchen sink\" template showing:                                     #}
{#   - variables / filters / math                                         #}
{#   - conditionals / loops / for-else                                    #}
{#   - block / extends / embed                                            #}
{#   - include / import / macro / set                                     #}
{#   - loop helpers, spaceless, raw                                       #}
{#   - dump() (in debug)                                                  #}
{#   - our helpers: view(), fragment()                                    #}
{#   - globals: appName, csrf, auth                                       #}
{# ====================================================================== #}

{% extends \"layouts/base.twig\" %}

{% block title %}Full Demo | {{ appName }}{% endblock %}

{% block body %}
  {{ push_meta('description', 'Full Marwa\\\\View demo with stacks, namespaced views, icons, and formatting helpers.') }}
  {{ push_property_meta('og:title', appName ~ ' demo') }}
  {{ push_script_tag(url('/static/app.js'), { defer: true }) }}
  {% set analyticsScript %}
    <script>
      window.demoAnalytics = { page: 'full-demo', app: '{{ appName|e('js') }}' };
    </script>
  {% endset %}
  {{ push('scripts', analyticsScript) }}

  {% set headMeta %}
    <meta name=\"demo-module\" content=\"full-demo\"/>
  {% endset %}
  {{ prepend('head', headMeta) }}

  {% set total = 0 %}
  {% for client in clients %}
    {% set total = total + client.revenue_monthly %}
  {% endfor %}

  <main class=\"mx-auto max-w-7xl px-6 py-14 sm:px-8\">
    <header class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-8 shadow-glow backdrop-blur sm:p-10\">
      <div class=\"flex flex-col gap-8 xl:flex-row xl:items-end xl:justify-between\">
        <div class=\"max-w-3xl\">
          <div class=\"inline-flex rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-brand-100\">
            Full Demo
          </div>
          <h1 class=\"mt-5 text-4xl font-extrabold tracking-tight text-white sm:text-5xl\">
            Framework-style templates with modern defaults
          </h1>
          <p class=\"mt-4 text-lg leading-8 text-slate-300\">
            This example demonstrates control flow, nested rendering, namespaced module views, shared globals, and stack injection through a single developer-facing template.
          </p>
        </div>

        <div class=\"grid gap-3 sm:grid-cols-3 xl:min-w-[420px]\">
          <div class=\"rounded-3xl border border-white/10 bg-white/6 p-4\">
            <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">Session</div>
            <div class=\"mt-2 text-2xl font-bold text-white\">{{ number(user.session_minutes / 60, 1) }}h</div>
          </div>
          <div class=\"rounded-3xl border border-white/10 bg-white/6 p-4\">
            <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">Clients</div>
            <div class=\"mt-2 text-2xl font-bold text-white\">{{ number(clients|length) }}</div>
          </div>
          <div class=\"rounded-3xl border border-white/10 bg-white/6 p-4\">
            <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">Revenue</div>
            <div class=\"mt-2 text-2xl font-bold text-white\">{{ compact_number(total, 1) }}</div>
          </div>
        </div>
      </div>

      <div class=\"mt-8 grid gap-4 lg:grid-cols-[1.5fr_0.7fr]\">
        <div class=\"rounded-3xl border border-white/10 bg-slate-950/50 p-5 text-sm leading-7 text-slate-300\">
          Hello, <span class=\"font-semibold text-white\">{{ user.name|default('Guest')|title }}</span>. You are inside <strong class=\"text-white\">{{ appName }}</strong> and rendering through a stable API.
          <div class=\"mt-3 rounded-2xl bg-white/5 px-4 py-3 font-mono text-xs text-slate-400\">CSRF token: {{ csrf }}</div>
        </div>
        <div class=\"rounded-3xl border border-white/10 bg-slate-950/50 p-5 text-sm leading-7 text-slate-300\">
          <div>Account created: <span class=\"font-medium text-white\">{{ user.created_at|date(\"Y-m-d H:i\") }}</span></div>
          <div class=\"mt-2\">Role: <span class=\"font-medium text-white\">{{ user.role|title }}</span></div>
        </div>
      </div>
    </header>

    <section class=\"mt-8 grid gap-6 xl:grid-cols-[1.2fr_0.8fr]\">
      <div class=\"space-y-6\">
        <section class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-6 backdrop-blur\">
          <div class=\"flex items-center gap-3\">
            {{ icon('spark', { class: 'h-5 w-5 text-brand-200' }) }}
            <h2 class=\"text-xl font-semibold text-white\">Conditional Logic</h2>
          </div>

          {% if user.is_admin %}
            <div class=\"mt-4 rounded-3xl border border-emerald-400/20 bg-emerald-500/10 p-4 text-sm text-emerald-100\">
              Administrator access is enabled for this session.
            </div>
          {% elseif user.role == 'manager' %}
            <div class=\"mt-4 rounded-3xl border border-blue-400/20 bg-blue-500/10 p-4 text-sm text-blue-100\">
              Manager dashboard access is active.
            </div>
          {% else %}
            <div class=\"mt-4 rounded-3xl border border-amber-400/20 bg-amber-500/10 p-4 text-sm text-amber-100\">
              Standard user privileges are active.
            </div>
          {% endif %}
        </section>


        <section class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-6 backdrop-blur\">
          <div class=\"flex items-center justify-between gap-4\">
            <h2 class=\"text-xl font-semibold text-white\">Looping Over Collections</h2>
            <div class=\"text-xs uppercase tracking-[0.2em] text-slate-500\">for / else</div>
          </div>

          <div class=\"mt-4 overflow-hidden rounded-3xl border border-white/8\">
            <table class=\"w-full text-left text-sm\">
              <thead class=\"bg-white/5 text-slate-300\">
                <tr>
                  <th class=\"px-4 py-3 font-semibold\">#</th>
                  <th class=\"px-4 py-3 font-semibold\">Client</th>
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
                  <td class=\"px-4 py-3 text-right font-mono text-slate-300\">
                    {{ money(client.revenue_monthly, 'USD') }}
                  </td>
                </tr>
              {% else %}
                <tr>
                  <td colspan=\"4\" class=\"px-4 py-5 text-center text-slate-500\">
                    No clients found.
                  </td>
                </tr>
              {% endfor %}
              </tbody>
            </table>
          </div>

          <p class=\"mt-4 text-sm text-slate-400\">
            Total revenue this month:
            <strong class=\"font-mono text-white\">{{ money(total, 'USD') }}</strong>
          </p>
        </section>


        <section class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-6 backdrop-blur\">
          <h2 class=\"text-xl font-semibold text-white\">Variable Manipulation</h2>

          {% set welcome = \"hello \" ~ user.name|default('friend') %}
          {% set shout = welcome|upper %}

          <div class=\"mt-4 rounded-3xl bg-slate-950/70 p-5 font-mono text-xs leading-7 text-slate-200\">
            welcome = \"{{ welcome }}\"<br>
            shout   = \"{{ shout }}\"<br>
            length  = {{ welcome|length }} chars<br>
            now     = {{ \"now\"|date(\"c\") }}<br>
          </div>
        </section>
      </div>

      <div class=\"space-y-6\">
        <section class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-6 backdrop-blur\">
          <h2 class=\"text-xl font-semibold text-white\">Namespaced Module Views</h2>
          <p class=\"mt-2 text-sm leading-6 text-slate-400\">The card below is rendered from <code class=\"font-mono text-slate-200\">@Blog/teaser</code>.</p>
          <div class=\"mt-4\">
            {{ view('@Blog/teaser', { appName: appName })|raw }}
          </div>
        </section>

        <section class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-6 backdrop-blur\">
          <h2 class=\"text-xl font-semibold text-white\">Template Notes</h2>
          <ul class=\"mt-4 space-y-3 text-sm leading-6 text-slate-300\">
            <li>Stack content is injected into the shared layout head and scripts sections.</li>
            <li>Application code still renders through <code class=\"font-mono text-slate-200\">\$view->render()</code>.</li>
            <li>Nested views and fragment caching stay available without leaking Twig into the application layer.</li>
          </ul>
          <div class=\"mt-5 rounded-3xl bg-slate-950/50 p-4 text-xs text-slate-400\">
            {{ json_script('demo-state', {
              app: appName,
              user: { id: user.id, role: user.role },
              clientCount: clients|length
            }) }}
            Frontend bootstrap payload embedded with <code class=\"font-mono text-slate-200\">json_script()</code>.
          </div>
        </section>
      </div>
    </section>



    {# ------------------------------------------------------------------ #}
    {# FOOTER VIA include                                                #}
    {# ------------------------------------------------------------------ #}
    <footer class=\"pt-10 text-center text-[11px] text-slate-500\">
      {% include \"partials/footer.twig\" %}
    </footer>

  </main>

{% endblock %}
", "full-demo.twig", "/Users/memran/projects/php-projects/marwa-view/examples/basic/views/full-demo.twig");
    }
}
