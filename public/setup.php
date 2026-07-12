<?php
/**
 * One-time Laravel setup script for shared hosting (no SSH)
 * DELETE THIS FILE immediately after running!
 */

// Security: simple password protection
$password = 'iscme2027setup';
if (!isset($_GET['key']) || $_GET['key'] !== $password) {
    die('<h2>Access Denied</h2><p>Add ?key=iscme2027setup to the URL</p>');
}

define('BASE_PATH', dirname(__DIR__));
$results = [];

// Helper function
function run($description, $callable) {
    global $results;
    try {
        $result = $callable();
        $results[] = ['status' => 'ok', 'msg' => $description . ': ' . ($result ?: 'Done')];
    } catch (\Exception $e) {
        $results[] = ['status' => 'error', 'msg' => $description . ': ERROR - ' . $e->getMessage()];
    }
}

// 1. Fix storage permissions
run('Storage permissions', function() {
    $dirs = [
        BASE_PATH . '/storage',
        BASE_PATH . '/storage/app',
        BASE_PATH . '/storage/app/public',
        BASE_PATH . '/storage/framework',
        BASE_PATH . '/storage/framework/cache',
        BASE_PATH . '/storage/framework/sessions',
        BASE_PATH . '/storage/framework/views',
        BASE_PATH . '/storage/logs',
        BASE_PATH . '/bootstrap/cache',
    ];
    foreach ($dirs as $dir) {
        if (!is_dir($dir)) mkdir($dir, 0775, true);
        chmod($dir, 0775);
    }
    return 'All storage directories set to 775';
});

// 2. Create storage symlink
run('Storage symlink', function() {
    $link = BASE_PATH . '/public/storage';
    $target = BASE_PATH . '/storage/app/public';
    if (is_link($link)) return 'Already exists';
    if (symlink($target, $link)) return 'Created successfully';
    return 'Could not create (may need manual creation)';
});

// 3. Run artisan via PHP CLI
$artisan = BASE_PATH . '/artisan';
$php = PHP_BINARY;

run('Config cache clear', function() use ($php, $artisan) {
    return shell_exec("$php $artisan config:clear 2>&1");
});

run('Config cache', function() use ($php, $artisan) {
    return shell_exec("$php $artisan config:cache 2>&1");
});

run('Route cache', function() use ($php, $artisan) {
    return shell_exec("$php $artisan route:cache 2>&1");
});

run('View cache', function() use ($php, $artisan) {
    return shell_exec("$php $artisan view:cache 2>&1");
});

run('Database migrate', function() use ($php, $artisan) {
    return shell_exec("$php $artisan migrate --force 2>&1");
});

run('Database seed', function() use ($php, $artisan) {
    return shell_exec("$php $artisan db:seed --force 2>&1");
});

// Check .env
run('.env file check', function() {
    $env = BASE_PATH . '/.env';
    if (file_exists($env)) {
        $content = file_get_contents($env);
        $appUrl = '';
        preg_match('/APP_URL=(.*)/', $content, $matches);
        return 'Found. APP_URL = ' . ($matches[1] ?? 'not set');
    }
    return '.env NOT FOUND - please upload it via File Manager!';
});
?>
<!DOCTYPE html>
<html>
<head>
    <title>ISCME Setup</title>
    <style>
        body { font-family: monospace; background: #0d1117; color: #e6edf3; padding: 30px; }
        h1 { color: #58a6ff; }
        .ok { color: #3fb950; }
        .error { color: #f85149; }
        .item { padding: 8px 12px; margin: 6px 0; border-radius: 6px; background: #161b22; border-left: 4px solid; }
        .item.ok { border-color: #3fb950; }
        .item.error { border-color: #f85149; }
        .warn { background: #2d1700; border: 1px solid #f0883e; border-radius: 8px; padding: 15px; margin-top: 20px; color: #f0883e; }
    </style>
</head>
<body>
    <h1>🚀 ISCME Laravel Setup</h1>
    <p>Running setup for: <strong><?= BASE_PATH ?></strong></p>
    <?php foreach ($results as $r): ?>
        <div class="item <?= $r['status'] ?>">
            <?= $r['status'] === 'ok' ? '✅' : '❌' ?> <?= htmlspecialchars($r['msg']) ?>
        </div>
    <?php endforeach; ?>
    <div class="warn">
        ⚠️ <strong>DELETE THIS FILE IMMEDIATELY!</strong><br>
        Go to cPanel File Manager → public/setup.php → Delete it now for security!
    </div>
</body>
</html>
