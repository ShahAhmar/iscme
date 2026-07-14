<?php
/**
 * GitHub Auto-Deployment Webhook
 * URL: https://iscme.gaftim.com/webhook.php
 */

define('WEBHOOK_SECRET', 'iscme-deploy-secret-2027');
define('REPO_PATH',      '/home2/gaftimco/iscme.gaftim.com');
define('GIT_BRANCH',     'main');

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
if (($data['ref'] ?? '') !== 'refs/heads/' . GIT_BRANCH) {
    die(json_encode(['message' => 'Not main branch — skipped']));
}

$repo = escapeshellarg(REPO_PATH);

// 1. Pull latest code
$pull = shell_exec("cd $repo && git pull origin " . GIT_BRANCH . " 2>&1");

// 2. Clear Laravel caches
$clear = shell_exec("cd $repo && php artisan optimize:clear 2>&1");

// 3. Log
$log = date('Y-m-d H:i:s') . " | DEPLOY\n$pull\n$clear\n---\n";
file_put_contents(REPO_PATH . '/storage/logs/deploy.log', $log, FILE_APPEND);

echo json_encode([
    'success' => true,
    'pull'    => $pull,
    'clear'   => $clear,
    'time'    => date('Y-m-d H:i:s'),
]);
