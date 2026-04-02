<?php

declare(strict_types=1);

$sections = [
    'Basic Examples' => [
        ['label' => 'Basic Overview', 'path' => '/basic/index.php', 'summary' => 'Landing page for basic renderer examples.'],
        ['label' => 'Simple Demo', 'path' => '/basic/render-demo.php', 'summary' => 'Extensions, fragments, and sub-view rendering.'],
        ['label' => 'Full Demo', 'path' => '/basic/demo.php', 'summary' => 'Namespaced views, stacks, JSON helpers, and formatting.'],
    ],
    'Theme Examples' => [
        ['label' => 'Theme Overview', 'path' => '/theme/index.php', 'summary' => 'Theme example launcher and navigation hub.'],
        ['label' => 'Theme Demo', 'path' => '/theme/theme.php', 'summary' => 'Manual theme registry example.'],
        ['label' => 'Switch Theme', 'path' => '/theme/switch-theme.php', 'summary' => 'Preview, apply, and revert theme workflow.'],
        ['label' => 'Admin Preview Alias', 'path' => '/theme/admin-theme-preview.php', 'summary' => 'Alias entry point for the admin preview flow.'],
        ['label' => 'Documentation Browser', 'path' => '/theme/docs.php', 'summary' => 'Theme-styled docs browser for tutorials and API notes.'],
    ],
];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Examples Index</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>
  <body class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(20,148,242,0.22),_transparent_32%),linear-gradient(180deg,_#020617_0%,_#0f172a_45%,_#111827_100%)] font-[Manrope] text-slate-100 antialiased">
    <main class="mx-auto max-w-7xl px-6 py-14 sm:px-8">
      <section class="rounded-[2rem] border border-white/10 bg-slate-900/70 p-8 shadow-2xl shadow-sky-950/20 backdrop-blur sm:p-10">
        <div class="inline-flex rounded-full border border-sky-400/30 bg-sky-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-sky-100">
          Example Browser
        </div>
        <h1 class="mt-5 text-5xl font-extrabold tracking-tight text-white">Browse every shipped example from one place.</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-slate-300">
          This page is intended for local development with <code class="rounded bg-slate-950 px-2 py-1 font-[JetBrains_Mono] text-sm text-slate-100">php -S 127.0.0.1:8000 -t examples</code>.
        </p>
      </section>

      <div class="mt-8 grid gap-8 lg:grid-cols-2">
        <?php foreach ($sections as $title => $links): ?>
          <section class="rounded-[2rem] border border-white/10 bg-slate-900/70 p-8 backdrop-blur">
            <h2 class="text-2xl font-bold tracking-tight text-white"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h2>
            <div class="mt-6 space-y-4">
              <?php foreach ($links as $link): ?>
                <a href="<?= htmlspecialchars($link['path'], ENT_QUOTES, 'UTF-8') ?>" class="block rounded-3xl border border-white/10 bg-white/5 p-5 transition hover:border-sky-300/40 hover:bg-white/8">
                  <div class="flex items-center justify-between gap-4">
                    <div>
                      <div class="text-lg font-semibold text-white"><?= htmlspecialchars($link['label'], ENT_QUOTES, 'UTF-8') ?></div>
                      <p class="mt-2 text-sm leading-6 text-slate-400"><?= htmlspecialchars($link['summary'], ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                    <code class="rounded-2xl bg-slate-950 px-3 py-2 font-[JetBrains_Mono] text-xs text-slate-300"><?= htmlspecialchars($link['path'], ENT_QUOTES, 'UTF-8') ?></code>
                  </div>
                </a>
              <?php endforeach; ?>
            </div>
          </section>
        <?php endforeach; ?>
      </div>
    </main>
  </body>
</html>
