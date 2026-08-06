@extends('layouts.admin')

@section('title', 'Speakers')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div><p class="text-uppercase small fw-bold mb-1" style="letter-spacing: .12em; color: #1a73e8;">Conference content</p><h1 class="h3 mb-0">Speakers</h1></div>
    <a href="{{ route('admin.speakers.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Add speaker</a>
</div>

@if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light"><tr><th class="ps-3">Speaker</th><th>Organisation</th><th>Visibility</th><th>Order</th><th class="text-end pe-3">Actions</th></tr></thead>
            <tbody>
                @forelse ($speakers as $speaker)
                    <tr>
                        <td class="ps-3"><div class="d-flex align-items-center gap-3">
                            @if ($speaker->photo)<img src="{{ Storage::url($speaker->photo) }}" alt="" class="rounded-circle object-fit-cover" width="46" height="46">@else <span class="rounded-circle d-inline-flex align-items-center justify-content-center text-white fw-bold" style="width:46px;height:46px;background:#003d6c;">{{ strtoupper(substr($speaker->name, 0, 1)) }}</span>@endif
                            <div><strong>{{ $speaker->name }}</strong><div class="small text-muted">{{ $speaker->designation }}</div></div>
                        </div></td>
                        <td>{{ $speaker->organisation }}</td>
                        <td><span class="badge text-bg-{{ $speaker->is_published ? 'success' : 'secondary' }}">{{ $speaker->is_published ? 'Published' : 'Draft' }}</span>@if($speaker->is_featured)<span class="badge text-bg-info ms-1">Featured</span>@endif</td>
                        <td>{{ $speaker->sort_order }}</td>
                        <td class="text-end pe-3"><a href="{{ route('admin.speakers.edit', $speaker) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            @if(auth()->user()->hasRole(['super_admin', 'admin']))<form class="d-inline" method="POST" action="{{ route('admin.speakers.destroy', $speaker) }}" onsubmit="return confirm('Delete this speaker?');">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form>@endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-5">No speakers added yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($speakers->hasPages())<div class="card-body border-top">{{ $speakers->links() }}</div>@endif
</div>
@endsection
