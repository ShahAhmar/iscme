<?php

use App\Models\Page;

$page = Page::where('slug', 'home')->first();

if (!$page) {
    echo "Page not found!\n";
    exit;
}

$html = $page->html;

// Fix overlay: change z-index:-1 to z-index:1 so it appears above the video (z=0) but below text
$html = str_replace('z-index:-1;', 'z-index:1;', $html);

// Also fix any z-index:-2 remnants
$html = str_replace('z-index:-2;', 'z-index:0;', $html);

$page->html = $html;
$page->save();

echo "Done! Overlay z-index updated.\n";
