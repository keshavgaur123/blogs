@extends('layouts.dashboard-layout')

@section('content')

<style>
    .card {
        max-width: 550px;
        margin: auto;
    }
</style>

<div class="card shadow">

    <div class="card-header bg-warning">
        <h4>Add Category</h4>
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <div class="mb-3">
                <label>Category Name</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       required>
            </div>

            <button class="btn btn-success">Save</button>

        </form>

    </div>
</div>

@endsection