<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->get();
        return view('admin.pages.index', compact('pages'));
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
            'html' => '<div class="container py-5 mt-5"><h1>' . $request->title . '</h1><p>Start building your page here...</p></div>',
            'css' => '',
            'components' => '[]',
            'styles' => '[]',
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
        return view('builder', compact('page'));
    }

    public function saveBuilder(Request $request, Page $page)
    {
        $page->update([
            'html' => $request->html,
            'css' => $request->css,
            'components' => $request->components,
            'styles' => $request->styles,
        ]);

        return response()->json(['success' => true]);
    }
}
