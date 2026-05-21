@extends('layouts.dashboard-layout')

@section('content')

    <div class="card shadow">

        <div class="card-header bg-warning">
            <h4>Edit Category</h4>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('categories.update', $category->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Parent Category</label>

                    <select name="parent_id" class="form-control">
                        <option value="">Main Category</option>

                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
                </div>

                <button class="btn btn-info">Update</button>

            </form>

        </div>
    </div>

@endsection