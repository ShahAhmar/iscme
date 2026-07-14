<?php
// TEMPORARY DEBUG FILE - DELETE AFTER CHECKING
header('Content-Type: application/json');

$info = [
    'php_version'     => PHP_VERSION,
    'whoami'          => shell_exec('whoami 2>&1'),
    'shell_exec_ok'   => function_exists('shell_exec') && !in_array('shell_exec', array_map('trim', explode(',', ini_get('disable_functions')))),
    'exec_ok'         => function_exists('exec') && !in_array('exec', array_map('trim', explode(',', ini_get('disable_functions')))),
    'disable_funcs'   => ini_get('disable_functions'),
    'git_path'        => shell_exec('which git 2>&1') ?? shell_exec('where git 2>&1'),
    'git_version'     => shell_exec('git --version 2>&1'),
    'repo_path_exists'=> is_dir('/home2/gaftimco/iscme.gaftim.com'),
    'repo_git_exists' => is_dir('/home2/gaftimco/iscme.gaftim.com/.git'),
    'current_dir'     => __DIR__,
    'git_status'      => shell_exec('cd /home2/gaftimco/iscme.gaftim.com && git status 2>&1'),
    'git_log'         => shell_exec('cd /home2/gaftimco/iscme.gaftim.com && git log --oneline -3 2>&1'),
];

echo json_encode($info, JSON_PRETTY_PRINT);
