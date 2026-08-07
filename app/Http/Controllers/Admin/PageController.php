<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Vite;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function index(): Response
    {
        $pages = Page::latest()->get();
        return Inertia::render('Admin/Pages/Index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $slug = Str::slug($request->title);
        
        // Ensure unique slug
        $originalSlug = $slug;
        $count = 1;
        while (Page::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $page = Page::create([
            'title' => $request->title,
            'slug' => $slug,
            'is_published' => $request->has('is_published'),
            'html' => '<section class="py-5 text-white" style="background: linear-gradient(135deg, #071e3d, #003d6c);"><div class="container py-5 text-center"><h1 class="display-4 fw-bold mb-3">' . e($request->title) . '</h1><p class="lead" style="max-width:700px; margin:0 auto;">Welcome to ' . e($request->title) . '. Customize this page using the visual drag-and-drop builder.</p></div></section><section class="py-5 bg-white"><div class="container py-4"><div class="row g-4"><div class="col-md-6"><h3 class="fw-bold mb-3" style="color:#003d6c;">Overview</h3><p class="text-muted" style="line-height:1.8;">Add your detailed page content, guidelines, or announcements here.</p></div><div class="col-md-6"><div class="card border-0 shadow-sm p-4 rounded-4" style="background:#f8f9fa;"><h5 class="fw-bold mb-2 text-primary">Key Highlights</h5><p class="text-muted mb-0">Highlight important dates, contact details, or conference topics.</p></div></div></div></div></section>',
            'css' => '',
            'components' => [],
            'styles' => [],
        ]);

        return redirect()->route('admin.pages.builder', $page->id)->with('success', 'Page created! Start building now.');
    }
    
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $page->update([
            'title' => $request->title,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }

    public function builder(Page $page)
    {
        // If page has no custom CSS, fallback to home page CSS for shared styles
        if (empty(trim($page->css ?? ''))) {
            $homePage = Page::where('slug', 'home')->first();
            if ($homePage && !empty($homePage->css)) {
                $page->css = $homePage->css;
            }
        }

        $canvasStyles = [
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
            'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css',
            'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;600;700&family=Inter:wght@400;500;700&display=swap',
        ];

        try {
            $canvasStyles[] = Vite::asset('resources/scss/app.scss');
        } catch (\Throwable $e) {
            // Ignore if Vite manifest is not available
        }

        return view('builder', [
            'page' => $page,
            'canvasStyles' => array_values(array_unique($canvasStyles)),
        ]);
    }

    public function saveBuilder(Request $request, Page $page)
    {
        $data = $request->validate([
            'html' => ['nullable', 'string'],
            'css' => ['nullable', 'string'],
            'components' => ['nullable'],
            'styles' => ['nullable'],
        ]);

        $page->update([
            'html' => $data['html'] ?? '',
            'css' => $data['css'] ?? '',
            'components' => is_array($data['components'] ?? null) ? $data['components'] : [],
            'styles' => is_array($data['styles'] ?? null) ? $data['styles'] : [],
        ]);

        return response()->json(['success' => true]);
    }
}
