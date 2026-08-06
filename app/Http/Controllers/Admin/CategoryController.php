<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Categories/Index', ['categories' => Category::withCount('posts')->orderBy('name')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        Category::create($this->data($request));
        return back()->with('success', 'Category created.');
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $category->update($this->data($request, $category));
        return back()->with('success', 'Category updated.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return back()->with('success', 'Category deleted. Posts were moved to Uncategorised.');
    }

    private function data(Request $request, ?Category $category = null): array
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:100'], 'slug' => ['nullable', 'string', 'max:100'], 'description' => ['nullable', 'string', 'max:1000']]);
        $slug = Str::slug($data['slug'] ?: $data['name']);
        if (Category::where('slug', $slug)->when($category, fn ($query) => $query->whereKeyNot($category->id))->exists()) {
            throw ValidationException::withMessages(['slug' => 'This slug is already in use.']);
        }
        $data['slug'] = $slug;
        return $data;
    }
}
