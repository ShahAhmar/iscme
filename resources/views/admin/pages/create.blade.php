@extends('layouts.admin')

@section('title', 'Create Page - ISCME 2027')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-gray-800">Create New Page</h1>
    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary shadow-sm">Back to Pages</a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('admin.pages.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Page Title</label>
                <input type="text" class="form-control" id="title" name="title" required placeholder="e.g. Sponsors, Call for Papers">
            </div>
            
            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="is_published" name="is_published" checked>
                <label class="form-check-label" for="is_published">Publish Immediately</label>
            </div>
            
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Create & Open Builder</button>
        </form>
    </div>
</div>
@endsection
