@extends('layouts.admin')

@section('title', 'Pages Management - ISCME 2027')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-gray-800">Pages</h1>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New Page</a>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Pages</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                    <tr>
                        <td>{{ $page->title }}</td>
                        <td>/{{ $page->slug }}</td>
                        <td>
                            @if($page->is_published)
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.pages.builder', $page->id) }}" class="btn btn-sm btn-info text-white"><i class="bi bi-palette"></i> Edit with Builder</a>
                            
                            <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this page?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Delete</button>
                            </form>
                            
                            <a href="/{{ $page->slug }}" target="_blank" class="btn btn-sm btn-secondary"><i class="bi bi-eye"></i> View</a>
                        </td>
                    </tr>
                    @endforeach
                    @if($pages->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">No pages found. <a href="{{ route('admin.pages.create') }}">Create one now!</a></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
