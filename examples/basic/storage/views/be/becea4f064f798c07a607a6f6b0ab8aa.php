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

/* myhome.twig */
class __TwigTemplate_00c470059cca4370071aec10e294cc87 extends Template
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
        $macros["Card"] = $this->macros["Card"] = $this->load("components/card.twig", 2)->unwrap();
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
        yield "Welcome — MarwaPHP";
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
        yield "  <section class=\"mx-auto max-w-7xl px-6 py-14 sm:px-8\">
    <div class=\"grid gap-10 lg:grid-cols-[1.15fr_0.85fr] lg:items-center\">
      <div>
        <p class=\"inline-flex items-center gap-2 rounded-full border border-brand-400/30 bg-brand-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-brand-100\">
          MarwaPHP View Layer
        </p>
        <h1 class=\"mt-6 text-5xl font-extrabold tracking-tight text-white sm:text-6xl\">
          Professional example templates that still feel easy to maintain.
        </h1>
        <p class=\"mt-6 max-w-2xl text-lg leading-8 text-slate-300\">
          This landing page is intentionally product-like: clear hierarchy, attractive surfaces, and examples that show developers what the package can do without burying them in visual noise.
        </p>

        <div class=\"mt-8 flex flex-col gap-3 sm:flex-row\">
          <a href=\"#starter\" class=\"inline-flex items-center justify-center rounded-2xl bg-brand-500 px-6 py-3 text-sm font-semibold text-white shadow-glow transition hover:bg-brand-400\">
            Get Started
          </a>
          <a href=\"#docs\" class=\"inline-flex items-center justify-center rounded-2xl border border-white/12 bg-white/5 px-6 py-3 text-sm font-semibold text-slate-100 transition hover:bg-white/10\">
            Read Developer Notes
          </a>
        </div>

        <div class=\"mt-10 grid gap-4 sm:grid-cols-3\">
          <div class=\"rounded-3xl border border-white/10 bg-white/6 p-4\">
            <div class=\"text-3xl font-extrabold text-white\">PSR-16</div>
            <div class=\"mt-1 text-sm text-slate-400\">Fragment cache integration</div>
          </div>
          <div class=\"rounded-3xl border border-white/10 bg-white/6 p-4\">
            <div class=\"text-3xl font-extrabold text-white\">Themes</div>
            <div class=\"mt-1 text-sm text-slate-400\">Switch, preview, and apply flows</div>
          </div>
          <div class=\"rounded-3xl border border-white/10 bg-white/6 p-4\">
            <div class=\"text-3xl font-extrabold text-white\">Stacks</div>
            <div class=\"mt-1 text-sm text-slate-400\">Layout injection without coupling</div>
          </div>
        </div>
      </div>

      <div class=\"relative\">
        <div class=\"absolute -inset-8 rounded-[2rem] bg-brand-500/10 blur-3xl\"></div>
        <div class=\"relative space-y-4 rounded-[2rem] border border-white/10 bg-slate-900/75 p-6 shadow-glow backdrop-blur\">
          <div class=\"rounded-2xl border border-white/8 bg-slate-950/70 p-5\">
            <div class=\"text-xs uppercase tracking-[0.24em] text-slate-500\">Application Code</div>
            <pre class=\"mt-3 overflow-auto rounded-2xl bg-black/40 p-4 text-xs leading-6 text-slate-200\"><code>\$view->share('appName', 'Marwa\\View');
echo \$view->render('dashboard', [
    'user' => \$user,
]);</code></pre>
          </div>

          <div class=\"rounded-2xl border border-white/8 bg-slate-950/70 p-5\">
            <div class=\"text-xs uppercase tracking-[0.24em] text-slate-500\">Template API</div>
            <pre class=\"mt-3 overflow-auto rounded-2xl bg-black/40 p-4 text-xs leading-6 text-slate-200\"><code>";
        // line 61
        yield "{{ fragment('sidebar', 120, {
    template: 'partials/sidebar',
    data: { user: user }
}) }}";
        yield "</code></pre>
          </div>

          <div class=\"rounded-2xl border border-white/8 bg-slate-950/70 p-5\">
            <div class=\"text-xs uppercase tracking-[0.24em] text-slate-500\">Developer Experience</div>
            <p class=\"mt-3 text-sm leading-7 text-slate-300\">
              Minimal app-facing API, isolated theme logic, namespaced views, and reusable layout stacks in one package.
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class=\"mt-16 flex justify-center\">
      <a href=\"#features\" class=\"inline-flex items-center gap-2 text-sm font-medium text-slate-400 transition hover:text-brand-100\">
        Explore features
      </a>
    </div>
  </section>

  <section id=\"features\" class=\"mx-auto mt-10 max-w-7xl px-6 sm:px-8\">
    <div class=\"grid gap-6 md:grid-cols-3\">
        ";
        // line 83
        yield $macros["Card"]->getTemplateForMacro("macro_panel", $context, 83, $this->getSourceContext())->macro_panel(...["Thin Rendering Boundary", "Keep Twig hidden from application code while still exposing ergonomic template features through Marwa\\View.", "<svg viewBox=\"0 0 24 24\" class=\"h-5 w-5 text-brand\"><path fill=\"currentColor\" d=\"M3 5h18v2H3V5m0 6h18v2H3v-2m0 6h18v2H3v-2Z\"/></svg>"]);
        // line 87
        yield "
        ";
        // line 88
        yield $macros["Card"]->getTemplateForMacro("macro_panel", $context, 88, $this->getSourceContext())->macro_panel(...["Theme Switching", "Preview, apply, and revert independent themes while exposing manifest metadata to the UI layer.", "<svg viewBox=\"0 0 24 24\" class=\"h-5 w-5 text-brand\"><path fill=\"currentColor\" d=\"M12 1l9 4v6c0 5-3.8 9.7-9 11-5.2-1.3-9-6-9-11V5l9-4z\"/></svg>"]);
        // line 92
        yield "
        ";
        // line 93
        yield $macros["Card"]->getTemplateForMacro("macro_panel", $context, 93, $this->getSourceContext())->macro_panel(...["Developer Utility Layer", "Fragment caching, translator helpers, namespaced module views, and stack injection keep templates productive.", "<svg viewBox=\"0 0 24 24\" class=\"h-5 w-5 text-brand\"><path fill=\"currentColor\" d=\"M12 2a10 10 0 100 20 10 10 0 000-20Zm1 5v5h5v2h-7V7h2Z\"/></svg>"]);
        // line 97
        yield "
      </div>
  </section>

  <section id=\"starter\" class=\"mx-auto mt-16 max-w-7xl px-6 sm:px-8\">
    <div class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-8 backdrop-blur\">
      <h2 class=\"text-2xl font-bold text-white\">Start a fresh project</h2>
      <ol class=\"mt-5 space-y-4 text-sm text-slate-300\">
          <li class=\"flex items-start gap-3\">
            <span class=\"mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-brand-500/10 text-brand-100 text-xs ring-1 ring-brand-400/30\">1</span>
            <span>Install the package, configure view and cache paths, and wire your app container.</span>
          </li>
          <li class=\"flex items-start gap-3\">
            <span class=\"mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-brand-500/10 text-brand-100 text-xs ring-1 ring-brand-400/30\">2</span>
            <span>Create your framework templates and use layout inheritance the way your app expects.</span>
          </li>
          <li class=\"flex items-start gap-3\">
            <span class=\"mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-brand-500/10 text-brand-100 text-xs ring-1 ring-brand-400/30\">3</span>
            <span>Render with <code class=\"rounded bg-slate-950 px-1.5 py-0.5 text-slate-100\">\$view->render('welcome', ['name' => 'Marwa'])</code>.</span>
          </li>
    </div>
  </section>

  <section id=\"docs\" class=\"mx-auto mt-16 mb-16 max-w-7xl px-6 sm:px-8\">
    <div class=\"grid gap-6 lg:grid-cols-2\">
      <div class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-6 backdrop-blur\">
        <h3 class=\"text-lg font-semibold text-white\">Typical Controller</h3>
        <pre class=\"mt-4 overflow-auto rounded-2xl bg-slate-950/70 p-4 text-xs leading-6 text-slate-200\"><code>class WelcomeController {
  public function index() {
    return \$this->view->render('welcome', [
      'name' => 'Emran',
    ]);
  }
}</code></pre>
      </div>

      <div class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-6 backdrop-blur\">
        <h3 class=\"text-lg font-semibold text-white\">Template Helpers Used In Examples</h3>
        <div class=\"mt-4 grid gap-3 text-sm sm:grid-cols-2\">
          <div class=\"rounded-2xl bg-slate-950/70 p-4\"><code>";
        // line 136
        yield "{{ view('@Blog/teaser') }}";
        yield "</code></div>
          <div class=\"rounded-2xl bg-slate-950/70 p-4\"><code>";
        // line 137
        yield "{{ fragment('sidebar', 120, {...}) }}";
        yield "</code></div>
          <div class=\"rounded-2xl bg-slate-950/70 p-4\"><code>";
        // line 138
        yield "{{ push('scripts', scriptTag) }}";
        yield "</code></div>
          <div class=\"rounded-2xl bg-slate-950/70 p-4\"><code>";
        // line 139
        yield "{{ t('welcome.title') }}";
        yield "</code></div>
        </div>
      </div>
    </div>
  </section>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "myhome.twig";
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
        return array (  219 => 139,  215 => 138,  211 => 137,  207 => 136,  166 => 97,  164 => 93,  161 => 92,  159 => 88,  156 => 87,  154 => 83,  126 => 61,  73 => 7,  66 => 6,  55 => 4,  50 => 1,  48 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"layouts/base.twig\" %}
{% import \"components/card.twig\" as Card %}

{% block title %}Welcome — MarwaPHP{% endblock %}

{% block body %}
  <section class=\"mx-auto max-w-7xl px-6 py-14 sm:px-8\">
    <div class=\"grid gap-10 lg:grid-cols-[1.15fr_0.85fr] lg:items-center\">
      <div>
        <p class=\"inline-flex items-center gap-2 rounded-full border border-brand-400/30 bg-brand-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-brand-100\">
          MarwaPHP View Layer
        </p>
        <h1 class=\"mt-6 text-5xl font-extrabold tracking-tight text-white sm:text-6xl\">
          Professional example templates that still feel easy to maintain.
        </h1>
        <p class=\"mt-6 max-w-2xl text-lg leading-8 text-slate-300\">
          This landing page is intentionally product-like: clear hierarchy, attractive surfaces, and examples that show developers what the package can do without burying them in visual noise.
        </p>

        <div class=\"mt-8 flex flex-col gap-3 sm:flex-row\">
          <a href=\"#starter\" class=\"inline-flex items-center justify-center rounded-2xl bg-brand-500 px-6 py-3 text-sm font-semibold text-white shadow-glow transition hover:bg-brand-400\">
            Get Started
          </a>
          <a href=\"#docs\" class=\"inline-flex items-center justify-center rounded-2xl border border-white/12 bg-white/5 px-6 py-3 text-sm font-semibold text-slate-100 transition hover:bg-white/10\">
            Read Developer Notes
          </a>
        </div>

        <div class=\"mt-10 grid gap-4 sm:grid-cols-3\">
          <div class=\"rounded-3xl border border-white/10 bg-white/6 p-4\">
            <div class=\"text-3xl font-extrabold text-white\">PSR-16</div>
            <div class=\"mt-1 text-sm text-slate-400\">Fragment cache integration</div>
          </div>
          <div class=\"rounded-3xl border border-white/10 bg-white/6 p-4\">
            <div class=\"text-3xl font-extrabold text-white\">Themes</div>
            <div class=\"mt-1 text-sm text-slate-400\">Switch, preview, and apply flows</div>
          </div>
          <div class=\"rounded-3xl border border-white/10 bg-white/6 p-4\">
            <div class=\"text-3xl font-extrabold text-white\">Stacks</div>
            <div class=\"mt-1 text-sm text-slate-400\">Layout injection without coupling</div>
          </div>
        </div>
      </div>

      <div class=\"relative\">
        <div class=\"absolute -inset-8 rounded-[2rem] bg-brand-500/10 blur-3xl\"></div>
        <div class=\"relative space-y-4 rounded-[2rem] border border-white/10 bg-slate-900/75 p-6 shadow-glow backdrop-blur\">
          <div class=\"rounded-2xl border border-white/8 bg-slate-950/70 p-5\">
            <div class=\"text-xs uppercase tracking-[0.24em] text-slate-500\">Application Code</div>
            <pre class=\"mt-3 overflow-auto rounded-2xl bg-black/40 p-4 text-xs leading-6 text-slate-200\"><code>\$view->share('appName', 'Marwa\\View');
echo \$view->render('dashboard', [
    'user' => \$user,
]);</code></pre>
          </div>

          <div class=\"rounded-2xl border border-white/8 bg-slate-950/70 p-5\">
            <div class=\"text-xs uppercase tracking-[0.24em] text-slate-500\">Template API</div>
            <pre class=\"mt-3 overflow-auto rounded-2xl bg-black/40 p-4 text-xs leading-6 text-slate-200\"><code>{% verbatim %}{{ fragment('sidebar', 120, {
    template: 'partials/sidebar',
    data: { user: user }
}) }}{% endverbatim %}</code></pre>
          </div>

          <div class=\"rounded-2xl border border-white/8 bg-slate-950/70 p-5\">
            <div class=\"text-xs uppercase tracking-[0.24em] text-slate-500\">Developer Experience</div>
            <p class=\"mt-3 text-sm leading-7 text-slate-300\">
              Minimal app-facing API, isolated theme logic, namespaced views, and reusable layout stacks in one package.
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class=\"mt-16 flex justify-center\">
      <a href=\"#features\" class=\"inline-flex items-center gap-2 text-sm font-medium text-slate-400 transition hover:text-brand-100\">
        Explore features
      </a>
    </div>
  </section>

  <section id=\"features\" class=\"mx-auto mt-10 max-w-7xl px-6 sm:px-8\">
    <div class=\"grid gap-6 md:grid-cols-3\">
        {{ Card.panel(
          'Thin Rendering Boundary',
          'Keep Twig hidden from application code while still exposing ergonomic template features through Marwa\\\\View.',
          '<svg viewBox=\"0 0 24 24\" class=\"h-5 w-5 text-brand\"><path fill=\"currentColor\" d=\"M3 5h18v2H3V5m0 6h18v2H3v-2m0 6h18v2H3v-2Z\"/></svg>'
        ) }}
        {{ Card.panel(
          'Theme Switching',
          'Preview, apply, and revert independent themes while exposing manifest metadata to the UI layer.',
          '<svg viewBox=\"0 0 24 24\" class=\"h-5 w-5 text-brand\"><path fill=\"currentColor\" d=\"M12 1l9 4v6c0 5-3.8 9.7-9 11-5.2-1.3-9-6-9-11V5l9-4z\"/></svg>'
        ) }}
        {{ Card.panel(
          'Developer Utility Layer',
          'Fragment caching, translator helpers, namespaced module views, and stack injection keep templates productive.',
          '<svg viewBox=\"0 0 24 24\" class=\"h-5 w-5 text-brand\"><path fill=\"currentColor\" d=\"M12 2a10 10 0 100 20 10 10 0 000-20Zm1 5v5h5v2h-7V7h2Z\"/></svg>'
        ) }}
      </div>
  </section>

  <section id=\"starter\" class=\"mx-auto mt-16 max-w-7xl px-6 sm:px-8\">
    <div class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-8 backdrop-blur\">
      <h2 class=\"text-2xl font-bold text-white\">Start a fresh project</h2>
      <ol class=\"mt-5 space-y-4 text-sm text-slate-300\">
          <li class=\"flex items-start gap-3\">
            <span class=\"mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-brand-500/10 text-brand-100 text-xs ring-1 ring-brand-400/30\">1</span>
            <span>Install the package, configure view and cache paths, and wire your app container.</span>
          </li>
          <li class=\"flex items-start gap-3\">
            <span class=\"mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-brand-500/10 text-brand-100 text-xs ring-1 ring-brand-400/30\">2</span>
            <span>Create your framework templates and use layout inheritance the way your app expects.</span>
          </li>
          <li class=\"flex items-start gap-3\">
            <span class=\"mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-brand-500/10 text-brand-100 text-xs ring-1 ring-brand-400/30\">3</span>
            <span>Render with <code class=\"rounded bg-slate-950 px-1.5 py-0.5 text-slate-100\">\$view->render('welcome', ['name' => 'Marwa'])</code>.</span>
          </li>
    </div>
  </section>

  <section id=\"docs\" class=\"mx-auto mt-16 mb-16 max-w-7xl px-6 sm:px-8\">
    <div class=\"grid gap-6 lg:grid-cols-2\">
      <div class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-6 backdrop-blur\">
        <h3 class=\"text-lg font-semibold text-white\">Typical Controller</h3>
        <pre class=\"mt-4 overflow-auto rounded-2xl bg-slate-950/70 p-4 text-xs leading-6 text-slate-200\"><code>class WelcomeController {
  public function index() {
    return \$this->view->render('welcome', [
      'name' => 'Emran',
    ]);
  }
}</code></pre>
      </div>

      <div class=\"rounded-[2rem] border border-white/10 bg-slate-900/70 p-6 backdrop-blur\">
        <h3 class=\"text-lg font-semibold text-white\">Template Helpers Used In Examples</h3>
        <div class=\"mt-4 grid gap-3 text-sm sm:grid-cols-2\">
          <div class=\"rounded-2xl bg-slate-950/70 p-4\"><code>{{ \"{{ view('@Blog/teaser') }}\" }}</code></div>
          <div class=\"rounded-2xl bg-slate-950/70 p-4\"><code>{{ \"{{ fragment('sidebar', 120, {...}) }}\" }}</code></div>
          <div class=\"rounded-2xl bg-slate-950/70 p-4\"><code>{{ \"{{ push('scripts', scriptTag) }}\" }}</code></div>
          <div class=\"rounded-2xl bg-slate-950/70 p-4\"><code>{{ \"{{ t('welcome.title') }}\" }}</code></div>
        </div>
      </div>
    </div>
  </section>
{% endblock %}
", "myhome.twig", "/Users/memran/projects/php-projects/marwa-view/examples/basic/views/myhome.twig");
    }
}
