@extends('layouts.admin')

@section('title', 'Pages')

@section('content')
<div class="d-flex flex-wrap justify-content-between gap-3 align-items-end mb-4">
    <div><h1 class="admin-page-title">Pages</h1><p class="admin-subtitle">Create, publish and visually edit every website page.</p></div>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary admin-btn"><i class="bi bi-plus-lg me-1"></i>New page</a>
</div>
@if(session('success'))<div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>@endif
<section class="admin-card">
    <div class="admin-card-header"><div><strong>All pages</strong><span class="text-muted small ms-2">{{ $pages->count() }} total</span></div><div class="admin-search"><i class="bi bi-search"></i><input type="search" class="form-control" placeholder="Search pages" data-table-search="#pages-table"></div></div>
    <div class="table-responsive"><table class="table admin-table" id="pages-table"><thead><tr><th>Page</th><th>URL</th><th>Status</th><th>Last updated</th><th class="text-end">Actions</th></tr></thead><tbody>
        @forelse($pages as $page)
            <tr><td><div class="d-flex align-items-center gap-3"><span class="rounded-3 d-inline-grid place-items-center" style="width:36px;height:36px;background:#eaf3fb;color:#1769aa;"><i class="bi bi-file-earmark-text"></i></span><div><strong>{{ $page->title }}</strong><div class="small text-muted">Website page</div></div></div></td><td><code class="text-secondary">/{{ $page->slug === 'home' ? '' : $page->slug }}</code></td><td>@if($page->is_published)<span class="admin-status live"><i class="bi bi-check-circle-fill"></i>Published</span>@else<span class="admin-status draft"><i class="bi bi-clock-fill"></i>Draft</span>@endif</td><td><span class="text-muted small">{{ $page->updated_at->diffForHumans() }}</span></td><td class="text-end"><div class="d-inline-flex gap-1"><a title="Open visual builder" href="{{ route('admin.pages.builder',$page) }}" class="admin-icon-button"><i class="bi bi-magic"></i></a><a title="Page settings" href="{{ route('admin.pages.edit',$page) }}" class="admin-icon-button"><i class="bi bi-gear"></i></a><a title="View page" href="/{{ $page->slug === 'home' ? '' : $page->slug }}" target="_blank" class="admin-icon-button"><i class="bi bi-box-arrow-up-right"></i></a>@if(auth()->user()->hasRole(['super_admin','admin']))<form method="POST" class="d-inline" action="{{ route('admin.pages.destroy',$page) }}" onsubmit="return confirm('Delete {{ addslashes($page->title) }}?');">@csrf @method('DELETE')<button title="Delete page" class="admin-icon-button text-danger" type="submit"><i class="bi bi-trash3"></i></button></form>@endif</div></td></tr>
        @empty<tr><td colspan="5" class="text-center text-muted py-5">No pages found. <a href="{{ route('admin.pages.create') }}">Create the first page</a>.</td></tr>@endforelse
    </tbody></table></div>
</section>
@endsection
