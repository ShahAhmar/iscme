<?php
/**
 * GitHub Auto-Deployment Webhook
 * URL: https://iscme.gaftim.com/webhook.php
 */

define('WEBHOOK_SECRET', 'iscme-deploy-secret-2027');
define('REPO_PATH',      '/home2/gaftimco/iscme.gaftim.com');
define('GIT_BRANCH',     'main');
define('GIT_BIN',        '/usr/bin/git');
define('PHP_BIN',        '/usr/bin/php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die(json_encode(['error' => 'Method not allowed']));
}

$payload   = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
$expected  = 'sha256=' . hash_hmac('sha256', $payload, WEBHOOK_SECRET);

if (!hash_equals($expected, $signature)) {
    http_response_code(401);
    die(json_encode(['error' => 'Invalid signature']));
}

$data = json_decode($payload, true);
$ref  = $data['ref'] ?? '';
if ($ref !== 'refs/heads/' . GIT_BRANCH) {
    die(json_encode(['message' => "Skipped: ref=$ref"]));
}

$path = REPO_PATH;
$git  = GIT_BIN;
$php  = PHP_BIN;

// 1. Fetch latest from remote
$fetch = shell_exec("cd $path && $git fetch origin 2>&1");

// 2. Hard reset to origin/main (more reliable than pull)
$reset = shell_exec("cd $path && $git reset --hard origin/" . GIT_BRANCH . " 2>&1");

// 3. Clear route cache file directly (fastest, no artisan needed)
$routeCache = $path . '/bootstrap/cache/routes-v7.php';
$routeCleared = false;
if (file_exists($routeCache)) {
    unlink($routeCache);
    $routeCleared = true;
}

// 4. Clear config cache
$configCache = $path . '/bootstrap/cache/config.php';
if (file_exists($configCache)) { unlink($configCache); }

// 5. Try artisan optimize:clear
$artisan = shell_exec("cd $path && $php artisan optimize:clear 2>&1");

// 6. Log everything
$commit = shell_exec("cd $path && $git log --oneline -1 2>&1");
$log = date('Y-m-d H:i:s') . " | DEPLOYED: $commit\nFETCH: $fetch\nRESET: $reset\nARTISAN: $artisan\n---\n";
file_put_contents($path . '/storage/logs/deploy.log', $log, FILE_APPEND | LOCK_EX);

echo json_encode([
    'success'       => true,
    'commit'        => trim($commit),
    'fetch'         => trim($fetch),
    'reset'         => trim($reset),
    'route_cleared' => $routeCleared,
    'artisan'       => trim($artisan),
    'time'          => date('Y-m-d H:i:s'),
]);
