<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Speaker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Inertia\Inertia;
use Inertia\Response;

class SpeakerController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Speakers/Index', [
            'speakers' => Speaker::orderBy('sort_order')->orderBy('name')->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.speakers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $speaker = Speaker::create($this->validatedData($request));

        return redirect()->route('admin.speakers.edit', $speaker)->with('success', 'Speaker created successfully.');
    }

    public function edit(Speaker $speaker): View
    {
        return view('admin.speakers.edit', compact('speaker'));
    }

    public function update(Request $request, Speaker $speaker): RedirectResponse
    {
        $speaker->update($this->validatedData($request, $speaker));

        return back()->with('success', 'Speaker updated successfully.');
    }

    public function destroy(Speaker $speaker): RedirectResponse
    {
        if ($speaker->photo) {
            Storage::disk('public')->delete($speaker->photo);
        }

        $speaker->delete();

        return redirect()->route('admin.speakers.index')->with('success', 'Speaker deleted successfully.');
    }

    private function validatedData(Request $request, ?Speaker $speaker = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'organisation' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:10000'],
            'photo' => ['nullable', 'image', 'max:4096'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('photo')) {
            if ($speaker?->photo) {
                Storage::disk('public')->delete($speaker->photo);
            }
            $data['photo'] = $request->file('photo')->store('speakers', 'public');
        } else {
            unset($data['photo']);
        }

        return $data;
    }
}
