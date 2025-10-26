<?php
$view = require __DIR__ . '/bootstrap.php';

$html = $view->render('simple-demo', [
    'title' => 'Simple Demo Page',
    'user' => [
        'name' => 'Mohammad Emran',
        'role' => 'admin',
    ],
    'clients' => [
        ['name' => 'GOTI Internet', 'active' => true, 'revenue_monthly' => 12000],
        ['name' => 'Shop24.com.bd', 'active' => false, 'revenue_monthly' => 3500],
    ],
]);
echo $html;
