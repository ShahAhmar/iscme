<?php
/**
 * GitHub Auto-Deployment Webhook
 * URL: https://iscme.gaftim.com/webhook.php
 */

define('WEBHOOK_SECRET', 'iscme-deploy-secret-2027');
define('REPO_PATH',      '/home2/gaftimco/iscme.gaftim.com');
define('REPO_URL',       'https://github.com/ShahAhmar/iscme.git');
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
$url  = REPO_URL;

// 1. Ensure remote URL is correct
$remoteSet = shell_exec("cd $path && $git remote set-url origin $url 2>&1");

// 2. Fetch latest from remote
$fetch = shell_exec("cd $path && $git fetch origin 2>&1");

// 3. Hard reset to origin/main
$reset = shell_exec("cd $path && $git reset --hard origin/" . GIT_BRANCH . " 2>&1");

// 4. Fallback: if git failed, download critical files via curl
$gitWorked = strpos($reset, 'HEAD is now at') !== false;
$fallback  = '';
if (!$gitWorked) {
    $files = [
        'routes/web.php',
        'public/webhook.php',
        '.cpanel.yml',
    ];
    foreach ($files as $file) {
        $rawUrl  = "https://raw.githubusercontent.com/ShahAhmar/iscme/main/$file";
        $content = @file_get_contents($rawUrl);
        if ($content !== false) {
            $dest = $path . '/' . $file;
            @mkdir(dirname($dest), 0755, true);
            file_put_contents($dest, $content);
            $fallback .= "Downloaded: $file\n";
        }
    }
}

// 5. Clear route cache directly
$routeCache = $path . '/bootstrap/cache/routes-v7.php';
if (file_exists($routeCache)) unlink($routeCache);
if (file_exists($path . '/bootstrap/cache/config.php')) unlink($path . '/bootstrap/cache/config.php');

// 6. Try artisan
$artisan = shell_exec("cd $path && $php artisan optimize:clear 2>&1");

// 7. Log
$commit = shell_exec("cd $path && $git log --oneline -1 2>&1");
$log = date('Y-m-d H:i:s') . " | DEPLOYED: $commit\nFETCH: $fetch\nRESET: $reset\nFALLBACK: $fallback\n---\n";
file_put_contents($path . '/storage/logs/deploy.log', $log, FILE_APPEND | LOCK_EX);

echo json_encode([
    'success'    => true,
    'commit'     => trim($commit),
    'remoteSet'  => trim($remoteSet),
    'fetch'      => trim($fetch),
    'reset'      => trim($reset),
    'gitWorked'  => $gitWorked,
    'fallback'   => trim($fallback),
    'artisan'    => trim($artisan),
    'time'       => date('Y-m-d H:i:s'),
]);

