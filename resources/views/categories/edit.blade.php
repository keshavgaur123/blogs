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
            <h4>Edit Category</h4>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('categories.update', $category->id) }}">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Category Name</label>

                    <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
                </div>

                <button class="btn btn-success">
                    Update
                </button>

            </form>

        </div>
    </div>

@endsection