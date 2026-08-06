<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Speaker;
use App\Models\Sponsor;
use App\Models\Faq;
use App\Models\Media;
use App\Models\User;
use Illuminate\View\View;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Dashboard', [
            'totalPages' => Page::count(),
            'publishedPages' => Page::where('is_published', true)->count(),
            'draftPages' => Page::where('is_published', false)->count(),
            'adminUsers' => User::whereIn('role', ['super_admin', 'admin'])->count(),
            'speakers' => Speaker::count(),
            'sponsors' => Sponsor::count(),
            'faqs' => Faq::count(),
            'mediaCount' => Media::count(),
            'recentPages' => Page::latest('updated_at')->take(6)->get(),
        ]);
    }
}
