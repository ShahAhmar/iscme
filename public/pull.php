<?php
/**
 * Auto-Pull Deployment Script for GitHub Actions trigger
 * URL: https://iscme.gaftim.com/pull.php
 */

define('REPO_PATH', '/home2/gaftimco/iscme.gaftim.com');
define('REPO_URL',  'https://github.com/ShahAhmar/iscme.git');
define('GIT_BRANCH','main');
define('GIT_BIN',   '/usr/bin/git');
define('PHP_BIN',   '/usr/bin/php');

header('Content-Type: application/json');

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

// 4. Fallback: if git failed, download critical files
$gitWorked = strpos($reset, 'HEAD is now at') !== false;
$fallback  = '';
if (!$gitWorked) {
    $files = [
        'routes/web.php',
        'app/Http/Controllers/RegistrationController.php',
        'app/Http/Controllers/AdminController.php',
        'resources/views/admin/dashboard.blade.php',
        'public/webhook.php',
        'public/pull.php',
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

// 5. Clear route & config cache directly
if (file_exists($path . '/bootstrap/cache/routes-v7.php')) @unlink($path . '/bootstrap/cache/routes-v7.php');
if (file_exists($path . '/bootstrap/cache/config.php')) @unlink($path . '/bootstrap/cache/config.php');

// 6. Run artisan optimize:clear
$artisan = shell_exec("cd $path && $php artisan optimize:clear 2>&1");

// 7. Log deployment
$commit = shell_exec("cd $path && $git log --oneline -1 2>&1");
$log = date('Y-m-d H:i:s') . " | PULL DEPLOYED: $commit\nFETCH: $fetch\nRESET: $reset\nFALLBACK: $fallback\n---\n";
@file_put_contents($path . '/storage/logs/deploy.log', $log, FILE_APPEND | LOCK_EX);

echo json_encode([
    'success'    => true,
    'commit'     => trim($commit),
    'fetch'      => trim($fetch),
    'reset'      => trim($reset),
    'gitWorked'  => $gitWorked,
    'fallback'   => trim($fallback),
    'artisan'    => trim($artisan),
    'time'       => date('Y-m-d H:i:s'),
], JSON_PRETTY_PRINT);
