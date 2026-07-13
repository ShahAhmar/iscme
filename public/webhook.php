<?php
/**
 * GitHub Auto-Deployment Webhook
 * Place in: public/webhook.php
 */

// ─── CONFIGURE THIS ─────────────────────────────────────────────
define('WEBHOOK_SECRET', 'iscme-deploy-secret-2027');   // Same secret you add in GitHub
define('REPO_PATH',      '/home2/gaftimco/iscme.gaftim.com'); // Your repo root on server
define('GIT_BRANCH',     'main');
// ────────────────────────────────────────────────────────────────

header('Content-Type: application/json');

// Only accept POST from GitHub
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die(json_encode(['error' => 'Method not allowed']));
}

// Verify GitHub HMAC signature
$payload   = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
$expected  = 'sha256=' . hash_hmac('sha256', $payload, WEBHOOK_SECRET);

if (!hash_equals($expected, $signature)) {
    http_response_code(401);
    die(json_encode(['error' => 'Invalid signature']));
}

// Only deploy on push to main branch
$data = json_decode($payload, true);
if (($data['ref'] ?? '') !== 'refs/heads/' . GIT_BRANCH) {
    die(json_encode(['message' => 'Not main branch — skipped']));
}

// Run git pull
$output  = shell_exec('git -C ' . escapeshellarg(REPO_PATH) . ' pull origin ' . GIT_BRANCH . ' 2>&1');

// Log it
$log = date('Y-m-d H:i:s') . " | DEPLOY\n" . $output . "\n---\n";
file_put_contents(REPO_PATH . '/storage/logs/deploy.log', $log, FILE_APPEND);

echo json_encode([
    'success' => true,
    'output'  => $output,
    'time'    => date('Y-m-d H:i:s'),
]);
