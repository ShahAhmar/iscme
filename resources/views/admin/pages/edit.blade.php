@extends('layouts.admin')

@section('title', 'Page settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-uppercase small fw-bold mb-1" style="letter-spacing: .12em; color: #1a73e8;">Page settings</p>
        <h1 class="h3 mb-0">{{ $page->title }}</h1>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.pages.builder', $page) }}" class="btn btn-primary">Open builder</a>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>
</div>

<div class="card border-0 shadow-sm" style="max-width: 720px;">
    <div class="card-body p-4">
        <form action="{{ route('admin.pages.update', $page) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label fw-semibold">Page title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $page->title) }}" required maxlength="255">
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <div class="form-text">Public URL: /{{ $page->slug }}. The URL remains stable when the title changes.</div>
            </div>
            <div class="form-check mb-4">
                <input type="checkbox" class="form-check-input" id="is_published" name="is_published" value="1" @checked(old('is_published', $page->is_published))>
                <label class="form-check-label" for="is_published">Publish this page</label>
            </div>
            <button type="submit" class="btn btn-primary">Save settings</button>
        </form>
    </div>
</div>
@endsection
