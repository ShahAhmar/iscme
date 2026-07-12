<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Inertia\Inertia;

class FrontendController extends Controller
{
    public function show($slug = null)
    {
        if (!$slug) {
            $slug = 'home';
        }
        $page = Page::where('slug', $slug)->where('is_published', true)->firstOrFail();
        return Inertia::render('Page', compact('page'));
    }
}
