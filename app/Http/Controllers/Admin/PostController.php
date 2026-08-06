<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function index(): Response { return Inertia::render('Admin/Posts/Index', ['posts' => Post::with(['author:id,name','category:id,name'])->latest()->paginate(20)]); }
    public function create(): Response { return Inertia::render('Admin/Posts/Editor', ['post' => null, 'categories' => Category::orderBy('name')->get()]); }
    public function store(Request $request): RedirectResponse { $post = Post::create($this->data($request)); return redirect()->route('admin.posts.edit', $post)->with('success', 'Post created.'); }
    public function edit(Post $post): Response { return Inertia::render('Admin/Posts/Editor', ['post' => $post, 'categories' => Category::orderBy('name')->get()]); }
    public function update(Request $request, Post $post): RedirectResponse { $post->update($this->data($request, $post)); return back()->with('success', 'Post updated.'); }
    public function destroy(Post $post): RedirectResponse { $post->delete(); return redirect()->route('admin.posts.index')->with('success', 'Post deleted.'); }
    private function data(Request $request, ?Post $post = null): array {
        $data = $request->validate(['title'=>['required','string','max:255'],'slug'=>['nullable','string','max:255'],'excerpt'=>['nullable','string','max:1000'],'body'=>['nullable','string'],'featured_image'=>['nullable','string','max:255'],'category_id'=>['nullable','exists:categories,id'],'status'=>['required','in:draft,published,scheduled'],'published_at'=>['nullable','date'],'seo_title'=>['nullable','string','max:255'],'seo_description'=>['nullable','string','max:500']]);
        $slug = Str::slug($data['slug'] ?: $data['title']); $base = $slug; $i = 2; while (Post::where('slug',$slug)->when($post, fn($q) => $q->whereKeyNot($post->id))->exists()) $slug = $base.'-'.$i++;
        $data['slug'] = $slug; $data['author_id'] = $post?->author_id ?? $request->user()->id; if ($data['status'] === 'published' && ! $data['published_at']) $data['published_at'] = now(); return $data;
    }
}
