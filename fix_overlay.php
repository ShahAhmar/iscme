<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Page;

$page = Page::where('slug', 'home')->first();
if (!$page) { echo "Not found"; exit; }

$html = $page->html;

// Replace ANY existing overlay style on the position-absolute div inside the hero section
// Pattern: looking for the overlay div and fixing its background
$patterns = [
    'background: transparent; top:0; left:0; z-index:0;',
    'background: rgba(0, 0, 0, 0.45); top:0; left:0; z-index:0;',
    'background: linear-gradient(to right, rgba(0,15,40,0.55) 0%, rgba(0,15,40,0.25) 60%, rgba(0,15,40,0.05) 100%); top:0; left:0; z-index:0;',
    'background: rgba(0,0,0,0.4); top:0; left:0; z-index:0;',
    'background: linear-gradient(135deg, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.60) 100%); top:0; left:0; z-index:1;',
];

$correctOverlay = 'background: linear-gradient(to right, rgba(5,20,55,0.60) 0%, rgba(5,20,55,0.30) 55%, rgba(5,20,55,0.05) 100%); top:0; left:0; z-index:0;';

$replaced = false;
foreach ($patterns as $pattern) {
    if (strpos($html, $pattern) !== false) {
        $html = str_replace($pattern, $correctOverlay, $html);
        $replaced = true;
        echo "Replaced: $pattern\n";
    }
}

if (!$replaced) {
    echo "WARNING: No overlay pattern matched. Current overlay in DB:\n";
    // Find the position-absolute div inside parallax-container
    $pos = strpos($html, 'position-absolute w-100 h-100');
    if ($pos !== false) {
        echo substr($html, $pos - 5, 300) . "\n";
    }
}

// Also fix the glass card style
$glassOld1 = 'background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.2); backdrop-filter:blur(12px);';
$glassOld2 = 'background: rgba(255,255,255,0.12); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.35); box-shadow: 0 8px 32px rgba(0,0,0,0.15); position: relative; overflow: hidden; z-index: 1;';
$glassOld3 = "background: url('/container-bg.png') no-repeat center center / cover; border: 1px solid rgba(255,255,255,0.2); position: relative; overflow: hidden; z-index: 1;";
$glassCorrect = 'background: rgba(255,255,255,0.10); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.30); box-shadow: 0 8px 32px rgba(0,0,0,0.12); position: relative; overflow: hidden; z-index: 1;';

foreach ([$glassOld1, $glassOld2, $glassOld3] as $old) {
    if (strpos($html, $old) !== false) {
        $html = str_replace($old, $glassCorrect, $html);
        echo "Glass card style updated.\n";
    }
}

$page->html = $html;
$page->save();
echo "\nDone! Check localhost now.\n";
