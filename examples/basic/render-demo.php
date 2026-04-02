<?php

declare(strict_types=1);

$view = require __DIR__ . '/bootstrap.php';

$html = $view->render('simple-demo', [
    'title' => 'Simple Demo Page',
    'user' => [
        'name' => 'Jordan Vale',
        'role' => 'admin',
    ],
    'clients' => [
        ['name' => 'Northwind Fiber', 'active' => true, 'revenue_monthly' => 12000],
        ['name' => 'BluePeak Retail', 'active' => false, 'revenue_monthly' => 3500],
    ],
]);

echo $html;
