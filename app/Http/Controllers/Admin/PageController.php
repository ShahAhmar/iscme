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
            'html' => '<div class="container py-5 mt-5"><h1>' . e($request->title) . '</h1><p>Start building your page here...</p></div>',
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
        return view('builder', [
            'page' => $page,
            'canvasStyles' => [
                Vite::asset('resources/scss/app.scss'),
                'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css',
                'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;600;700&family=Inter:wght@400;500;700&display=swap',
            ],
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
