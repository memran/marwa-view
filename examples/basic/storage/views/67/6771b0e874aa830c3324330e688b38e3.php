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

/* layouts/base.twig */
class __TwigTemplate_05feacabff12b084e59610c09be91438 extends Template
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
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!doctype html>
<html lang=\"en\" class=\"h-full bg-slate-950\">
  <head>
    <meta charset=\"utf-8\"/>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\"/>
    <title>";
        // line 6
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
    <meta name=\"csrf-token\" content=\"";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["csrf"]) || array_key_exists("csrf", $context) ? $context["csrf"] : (function () { throw new RuntimeError('Variable "csrf" does not exist.', 7, $this->source); })()), "html", null, true);
        yield "\">
    ";
        // line 8
        yield $this->env->getFunction('stack')->getCallable()("head");
        yield "
    <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
    <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
    <link href=\"https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap\" rel=\"stylesheet\">
    <script src=\"https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4\"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ['Manrope', 'system-ui', 'sans-serif'],
              mono: ['JetBrains Mono', 'monospace']
            },
            colors: {
              brand: {
                50: '#eef9ff',
                100: '#d9f1ff',
                200: '#b5e5ff',
                300: '#7fd2ff',
                400: '#42b8ff',
                500: '#1494f2',
                600: '#0d76c5',
                700: '#0d5f9c',
                800: '#114f7f',
                900: '#153f64'
              }
            },
            boxShadow: {
              glow: '0 24px 80px rgba(20, 148, 242, 0.25)'
            }
          }
        }
      }
    </script>
    <style>
      :root {
        color-scheme: dark;
      }
    </style>
  </head>
  <body class=\"min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(20,148,242,0.22),_transparent_32%),radial-gradient(circle_at_top_right,_rgba(96,165,250,0.16),_transparent_28%),linear-gradient(180deg,_#020617_0%,_#0f172a_45%,_#111827_100%)] text-slate-100 antialiased\">
    <div class=\"relative isolate min-h-screen overflow-hidden\">
      <div class=\"absolute inset-x-0 top-0 -z-10 h-72 bg-[radial-gradient(circle,_rgba(125,211,252,0.2),_transparent_55%)] blur-3xl\"></div>
      <div class=\"absolute left-1/2 top-40 -z-10 h-80 w-80 -translate-x-1/2 rounded-full bg-brand-500/10 blur-3xl\"></div>
      ";
        // line 52
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 53
        yield "    </div>
    ";
        // line 54
        yield $this->env->getFunction('stack')->getCallable()("scripts");
        yield "
  </body>
</html>
";
        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Untitled";
        yield from [];
    }

    // line 52
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "layouts/base.twig";
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
        return array (  131 => 52,  120 => 6,  111 => 54,  108 => 53,  106 => 52,  59 => 8,  55 => 7,  51 => 6,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!doctype html>
<html lang=\"en\" class=\"h-full bg-slate-950\">
  <head>
    <meta charset=\"utf-8\"/>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\"/>
    <title>{% block title %}Untitled{% endblock %}</title>
    <meta name=\"csrf-token\" content=\"{{ csrf }}\">
    {{ stack('head')|raw }}
    <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
    <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
    <link href=\"https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap\" rel=\"stylesheet\">
    <script src=\"https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4\"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ['Manrope', 'system-ui', 'sans-serif'],
              mono: ['JetBrains Mono', 'monospace']
            },
            colors: {
              brand: {
                50: '#eef9ff',
                100: '#d9f1ff',
                200: '#b5e5ff',
                300: '#7fd2ff',
                400: '#42b8ff',
                500: '#1494f2',
                600: '#0d76c5',
                700: '#0d5f9c',
                800: '#114f7f',
                900: '#153f64'
              }
            },
            boxShadow: {
              glow: '0 24px 80px rgba(20, 148, 242, 0.25)'
            }
          }
        }
      }
    </script>
    <style>
      :root {
        color-scheme: dark;
      }
    </style>
  </head>
  <body class=\"min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(20,148,242,0.22),_transparent_32%),radial-gradient(circle_at_top_right,_rgba(96,165,250,0.16),_transparent_28%),linear-gradient(180deg,_#020617_0%,_#0f172a_45%,_#111827_100%)] text-slate-100 antialiased\">
    <div class=\"relative isolate min-h-screen overflow-hidden\">
      <div class=\"absolute inset-x-0 top-0 -z-10 h-72 bg-[radial-gradient(circle,_rgba(125,211,252,0.2),_transparent_55%)] blur-3xl\"></div>
      <div class=\"absolute left-1/2 top-40 -z-10 h-80 w-80 -translate-x-1/2 rounded-full bg-brand-500/10 blur-3xl\"></div>
      {% block body %}{% endblock %}
    </div>
    {{ stack('scripts')|raw }}
  </body>
</html>
", "layouts/base.twig", "/Users/memran/projects/php-projects/marwa-view/examples/basic/views/layouts/base.twig");
    }
}
