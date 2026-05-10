@extends('layouts.dashboard-layout')

@section('content')

<style>
.card {
    border-radius: 12px;
    max-width: 900px;
    margin: 10px auto;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.card-header {
    background: #ffd700;
    font-weight: 600;
}

.form-control, .form-select {
    border-radius: 8px;
}
</style>

<div class="container">

    <div class="card">

        <div class="card-header">
            <h3 class="mb-0">Add Blog</h3>
        </div>

        <div class="card-body">

            <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    {{-- TITLE --}}
                    <div class="col-md-6 mb-3">
                        <label>Title</label>
                        <input type="text" name="title" id="title"
                               class="form-control"
                               value="{{ old('title') }}" required>
                    </div>

                    {{-- SLUG --}}
                    <div class="col-md-6 mb-3">
                        <label>Slug</label>
                        <input type="text" name="slug" id="slug"
                               class="form-control"
                               value="{{ old('slug') }}" required>
                    </div>

                    {{-- CATEGORY (FIXED STRUCTURE) --}}
                    <div class="col-md-6 mb-3">
                        <label>Category</label>

                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>

                            @foreach($categories as $parent)
                                <option value="{{ $parent->id }}">
                                    {{ $parent->name }}
                                </option>

                                {{-- SUBCATEGORIES (DISPLAY ONLY) --}}
                                @foreach($parent->children ?? [] as $child)
                                    <option value="{{ $child->id }}">
                                        &nbsp;&nbsp;↳ {{ $child->name }}
                                    </option>
                                @endforeach
                            @endforeach

                        </select>
                    </div>

                    {{-- IMAGE --}}
                    <div class="col-md-6 mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                </div>

                {{-- CONTENT --}}
                <div class="mb-3">
                    <label>Content</label>
                    <textarea name="content" id="content" class="form-control" rows="6">
                        {{ old('content') }}
                    </textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    Add Blog
                </button>

            </form>

        </div>

    </div>

</div>

@endsection