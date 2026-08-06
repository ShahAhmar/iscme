@extends('layouts.admin')
@section('title','Edit sponsor')
@section('content')
<div class="mb-4"><p class="text-uppercase small fw-bold mb-1" style="letter-spacing:.12em;color:#1a73e8;">Conference content</p><h1 class="h3 mb-0">Edit sponsor</h1></div>@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif<div class="card border-0 shadow-sm" style="max-width:900px"><div class="card-body p-4"><form method="POST" action="{{ route('admin.sponsors.update',$sponsor) }}" enctype="multipart/form-data">@include('admin.sponsors._form')</form></div></div>
@endsection
