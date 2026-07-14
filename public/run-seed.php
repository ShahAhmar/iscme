<?php
// One-time seeder script — DELETE after use
$secret = 'iscme-seed-2027';
if (($_GET['key'] ?? '') !== $secret) {
    http_response_code(403);
    die('Forbidden');
}

$output = shell_exec('cd /home2/gaftimco/iscme.gaftim.com && /usr/bin/php artisan db:seed --class=PageSeeder --force 2>&1');
echo '<pre>' . htmlspecialchars($output) . '</pre>';
echo '<b>Done! Delete this file after verifying.</b>';
