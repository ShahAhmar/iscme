<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class MediaController extends Controller
{
    public function index(Request $request): Response
    {
        $query = Media::query()->latest();
        if ($request->filled('type')) $query->where('mime_type', 'like', $request->string('type').'%');
        return Inertia::render('Admin/Media/Index', ['media' => $query->paginate(36)->withQueryString()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(['files' => ['required', 'array', 'max:20'], 'files.*' => ['file', 'max:20480'], 'folder' => ['nullable', 'string', 'max:100']]);
        foreach ($request->file('files') as $file) {
            $path = $file->store('media/'.now()->format('Y/m'), 'public');
            Media::create(['original_name' => $file->getClientOriginalName(), 'path' => $path, 'disk' => 'public', 'mime_type' => $file->getMimeType(), 'size' => $file->getSize(), 'folder' => $request->input('folder'), 'uploaded_by' => $request->user()->id]);
        }
        return back()->with('success', 'Media uploaded successfully.');
    }

    public function update(Request $request, Media $media): RedirectResponse
    {
        $media->update($request->validate(['alt_text' => ['nullable', 'string', 'max:255'], 'caption' => ['nullable', 'string', 'max:2000'], 'folder' => ['nullable', 'string', 'max:100']]));
        return back()->with('success', 'Media details updated.');
    }

    public function destroy(Media $media): RedirectResponse
    {
        Storage::disk($media->disk)->delete($media->path); $media->delete();
        return back()->with('success', 'Media item deleted.');
    }
}
