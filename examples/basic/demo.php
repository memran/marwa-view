<?php

declare(strict_types=1);

// -----------------------------------------------------------------------------
// Grab the View instance from bootstrap.php
// -----------------------------------------------------------------------------
/** @var \Marwa\View\View $view */
$view = require __DIR__ . '/bootstrap.php';

// -----------------------------------------------------------------------------
// Mock data you'd normally get from DB / services
// -----------------------------------------------------------------------------

$user = [
    'id'               => 42,
    'name'             => 'Riley Harper',
    'email'            => 'riley.harper@example.test',
    'role'             => 'admin',
    'is_admin'         => true,
    'created_at'       => new DateTimeImmutable('2024-01-15 10:30:00'),
    'session_minutes'  => 187, // ~3.1 hrs
];

$clients = [
    [
        'name'             => 'Northwind Fiber',
        'active'           => true,
        'revenue_monthly'  => 12000.75,
    ],
    [
        'name'             => 'BluePeak Systems',
        'active'           => true,
        'revenue_monthly'  => 8750.00,
    ],
    [
        'name'             => 'Summit Commerce',
        'active'           => false,
        'revenue_monthly'  => 2300.00,
    ],
];

$system = [
    'uptime_hours'    => 512,
    'sessions'        => 58,
    'db_latency_ms'   => 4.2,
];

$notices = [
    ['message' => 'Your subscription will auto-renew on Nov 1'],
    ['message' => 'Security advisory: rotate API keys'],
    ['message' => 'New feature released: PSR-16 fragment cache'],
];

// -----------------------------------------------------------------------------
// Now render the big demo template
// -----------------------------------------------------------------------------

$html = $view->render('full-demo', [
    'user'     => $user,
    'clients'  => $clients,
    'system'   => $system,
    'notices'  => $notices,
]);

// Output to browser / CLI
echo $html;
