@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap gap-3 align-items-center pt-2 pb-4 mb-2 border-bottom">
        <div>
            <p class="text-uppercase small fw-bold mb-1" style="letter-spacing: .12em; color: #1a73e8;">Content overview</p>
            <h1 class="h2 mb-0">Welcome back, {{ auth()->user()->name }}</h1>
        </div>
        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Create page</a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small fw-semibold text-uppercase">Total pages</div>
                    <div class="display-6 fw-bold mt-1" style="color: #003d6c;">{{ $totalPages }}</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small fw-semibold text-uppercase">Published</div>
                    <div class="display-6 fw-bold mt-1 text-success">{{ $publishedPages }}</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small fw-semibold text-uppercase">Drafts</div>
                    <div class="display-6 fw-bold mt-1 text-warning">{{ $draftPages }}</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small fw-semibold text-uppercase">Speakers / sponsors / FAQs</div>
                    <div class="display-6 fw-bold mt-1" style="color: #1a73e8;">{{ $speakers }} / {{ $sponsors }} / {{ $faqs }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h2 class="h5 mb-0">Recently updated pages</h2>
            <a href="{{ route('admin.pages.index') }}" class="small text-decoration-none">Manage pages</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light"><tr><th class="ps-3">Page</th><th>Status</th><th>Last updated</th><th class="text-end pe-3">Action</th></tr></thead>
                <tbody>
                    @forelse ($recentPages as $page)
                        <tr>
                            <td class="ps-3"><strong>{{ $page->title }}</strong><div class="small text-muted">/{{ $page->slug }}</div></td>
                            <td><span class="badge text-bg-{{ $page->is_published ? 'success' : 'secondary' }}">{{ $page->is_published ? 'Published' : 'Draft' }}</span></td>
                            <td class="text-muted">{{ $page->updated_at->diffForHumans() }}</td>
                            <td class="text-end pe-3"><a class="btn btn-sm btn-outline-primary" href="{{ route('admin.pages.builder', $page) }}">Open builder</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-5">No pages yet. Create your first page to begin.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
