<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Page;

$page = Page::where('slug', 'home')->first();
if (!$page) { echo "Not found"; exit; }

$html = $page->html;

// Fix 1: Reduce the dark overlay so hero-bg.png image is clearly visible
// Reference image shows a light gray/blue tech globe background - overlay should be very light
$html = str_replace(
    'background: rgba(0, 0, 0, 0.45); top:0; left:0; z-index:0;',
    'background: linear-gradient(to right, rgba(0,15,40,0.55) 0%, rgba(0,15,40,0.25) 60%, rgba(0,15,40,0.05) 100%); top:0; left:0; z-index:0;',
    $html
);

$page->html = $html;
$page->save();
echo "Done! Overlay updated to match reference image.\n";
