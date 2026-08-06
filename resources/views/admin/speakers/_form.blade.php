@csrf
@if(isset($speaker)) @method('PUT') @endif
<div class="row g-3">
    <div class="col-md-6"><label class="form-label fw-semibold" for="name">Full name</label><input id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $speaker->name ?? '') }}" required>@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
    <div class="col-md-6"><label class="form-label fw-semibold" for="designation">Designation</label><input id="designation" name="designation" class="form-control" value="{{ old('designation', $speaker->designation ?? '') }}" placeholder="e.g. Professor of Engineering"></div>
    <div class="col-md-6"><label class="form-label fw-semibold" for="organisation">Organisation</label><input id="organisation" name="organisation" class="form-control" value="{{ old('organisation', $speaker->organisation ?? '') }}"></div>
    <div class="col-md-3"><label class="form-label fw-semibold" for="sort_order">Display order</label><input id="sort_order" name="sort_order" type="number" min="0" class="form-control" value="{{ old('sort_order', $speaker->sort_order ?? 0) }}"></div>
    <div class="col-md-3"><label class="form-label fw-semibold" for="photo">Photo</label><input id="photo" name="photo" type="file" accept="image/*" class="form-control @error('photo') is-invalid @enderror">@error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
    <div class="col-12"><label class="form-label fw-semibold" for="bio">Biography</label><textarea id="bio" name="bio" rows="6" class="form-control">{{ old('bio', $speaker->bio ?? '') }}</textarea></div>
    <div class="col-12 d-flex flex-wrap gap-4">
        <div class="form-check"><input class="form-check-input" id="is_published" name="is_published" value="1" type="checkbox" @checked(old('is_published', $speaker->is_published ?? true))><label class="form-check-label" for="is_published">Published</label></div>
        <div class="form-check"><input class="form-check-input" id="is_featured" name="is_featured" value="1" type="checkbox" @checked(old('is_featured', $speaker->is_featured ?? false))><label class="form-check-label" for="is_featured">Feature on homepage</label></div>
    </div>
    @if(isset($speaker) && $speaker->photo)<div class="col-12"><img src="{{ Storage::url($speaker->photo) }}" alt="Current speaker portrait" class="rounded border" style="width:96px;height:96px;object-fit:cover;"></div>@endif
</div>
<div class="mt-4 d-flex gap-2"><button type="submit" class="btn btn-primary">Save speaker</button><a href="{{ route('admin.speakers.index') }}" class="btn btn-outline-secondary">Cancel</a></div>
