@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Pages</div>
                <div class="card-body">
                    <h5 class="card-title">0</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Speakers</div>
                <div class="card-body">
                    <h5 class="card-title">0</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Sponsors</div>
                <div class="card-body">
                    <h5 class="card-title">0</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
