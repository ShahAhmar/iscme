<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

use Inertia\Inertia;
use Inertia\Response;

class SponsorController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Sponsors/Index', [
            'sponsors' => Sponsor::orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }

    public function create(): View { return view('admin.sponsors.create'); }

    public function store(Request $request): RedirectResponse
    {
        Sponsor::create($this->validatedData($request));
        return back()->with('success', 'Sponsor created successfully.');
    }

    public function edit(Sponsor $sponsor): View { return view('admin.sponsors.edit', compact('sponsor')); }

    public function update(Request $request, Sponsor $sponsor): RedirectResponse
    {
        $sponsor->update($this->validatedData($request, $sponsor));
        return back()->with('success', 'Sponsor updated successfully.');
    }

    public function destroy(Sponsor $sponsor): RedirectResponse
    {
        if ($sponsor->logo) Storage::disk('public')->delete($sponsor->logo);
        $sponsor->delete();
        return back()->with('success', 'Sponsor deleted successfully.');
    }

    private function validatedData(Request $request, ?Sponsor $sponsor = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'], 'tier' => ['nullable', 'string', 'max:100'],
            'website_url' => ['nullable', 'url', 'max:2048'], 'logo' => ['nullable', 'image', 'max:4096'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);
        $data['is_published'] = $request->boolean('is_published');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        if ($request->hasFile('logo')) {
            if ($sponsor?->logo) Storage::disk('public')->delete($sponsor->logo);
            $data['logo'] = $request->file('logo')->store('sponsors', 'public');
        } else unset($data['logo']);
        return $data;
    }
}
