<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

use Inertia\Inertia;
use Inertia\Response;

class FaqController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Faqs/Index', [
            'faqs' => Faq::orderBy('sort_order')->get(),
        ]);
    }
    public function create(): View { return view('admin.faqs.create'); }
    public function store(Request $request): RedirectResponse { $faq = Faq::create($this->validatedData($request)); return back()->with('success', 'FAQ created successfully.'); }
    public function edit(Faq $faq): View { return view('admin.faqs.edit', compact('faq')); }
    public function update(Request $request, Faq $faq): RedirectResponse { $faq->update($this->validatedData($request)); return back()->with('success', 'FAQ updated successfully.'); }
    public function destroy(Faq $faq): RedirectResponse { $faq->delete(); return back()->with('success', 'FAQ deleted successfully.'); }
    private function validatedData(Request $request): array
    {
        $data = $request->validate(['question' => ['required','string','max:500'], 'answer' => ['required','string','max:20000'], 'category' => ['nullable','string','max:100'], 'sort_order' => ['nullable','integer','min:0','max:9999']]);
        $data['is_published'] = $request->boolean('is_published'); $data['sort_order'] = $data['sort_order'] ?? 0;
        return $data;
    }
}
