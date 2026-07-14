<?php
// TEMPORARY - Cache clear script
header('Content-Type: text/plain');

$base = '/home2/gaftimco/iscme.gaftim.com';

echo "=== Clearing Laravel Caches ===\n\n";

// 1. Delete route cache file directly
$routeCache = $base . '/bootstrap/cache/routes-v7.php';
if (file_exists($routeCache)) {
    unlink($routeCache);
    echo "✅ Route cache deleted\n";
} else {
    echo "ℹ️  No route cache file found\n";
}

// 2. Delete config cache
$configCache = $base . '/bootstrap/cache/config.php';
if (file_exists($configCache)) {
    unlink($configCache);
    echo "✅ Config cache deleted\n";
}

// 3. Clear compiled views
$views = glob($base . '/storage/framework/views/*.php');
foreach ($views as $view) {
    unlink($view);
}
echo "✅ Compiled views cleared (" . count($views) . " files)\n";

// 4. Try php artisan
$out = shell_exec("cd $base && php artisan optimize:clear 2>&1");
echo "\n=== php artisan optimize:clear ===\n$out\n";

// 5. Show bootstrap/cache contents
echo "=== bootstrap/cache contents ===\n";
$files = scandir($base . '/bootstrap/cache');
foreach ($files as $f) {
    if ($f !== '.' && $f !== '..') echo "  $f\n";
}

echo "\nDone!\n";
