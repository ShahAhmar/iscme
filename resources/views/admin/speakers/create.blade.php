@extends('layouts.admin')

@section('title', 'Add speaker')

@section('content')
<div class="mb-4"><p class="text-uppercase small fw-bold mb-1" style="letter-spacing: .12em; color: #1a73e8;">Conference content</p><h1 class="h3 mb-0">Add speaker</h1></div>
<div class="card border-0 shadow-sm" style="max-width:900px;"><div class="card-body p-4"><form method="POST" action="{{ route('admin.speakers.store') }}" enctype="multipart/form-data">@include('admin.speakers._form')</form></div></div>
@endsection
