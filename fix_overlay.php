<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Page;

$page = Page::where('slug', 'home')->first();
if (!$page) { echo "Not found"; exit; }

$html = $page->html;

// Fix 1: Remove the overlay completely (set to transparent)
$html = str_replace(
    'background: linear-gradient(to right, rgba(0,15,40,0.55) 0%, rgba(0,15,40,0.25) 60%, rgba(0,15,40,0.05) 100%); top:0; left:0; z-index:0;',
    'background: transparent; top:0; left:0; z-index:0;',
    $html
);

// Fix 2: Make the dates container glassmorphism style
$html = str_replace(
    'background: url(\'/container-bg.png\') no-repeat center center / cover; border: 1px solid rgba(255,255,255,0.2); position: relative; overflow: hidden; z-index: 1;',
    'background: rgba(255,255,255,0.12); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.35); box-shadow: 0 8px 32px rgba(0,0,0,0.15); position: relative; overflow: hidden; z-index: 1;',
    $html
);

$page->html = $html;
$page->save();
echo "Done! Overlay removed and glass effect applied.\n";
