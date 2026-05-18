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

    {{-- FIX: Add global error display (important for server-side validation) --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}" required>

                        {{-- FIX: show server-side validation error --}}
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    {{-- SLUG --}}
                    <div class="col-md-6 mb-3">
                        <label>Slug</label>

                        <input type="text"
                               name="slug"
                               id="slug"
                               class="form-control @error('slug') is-invalid @enderror"
                               value="{{ old('slug') }}"
                               required>

                        {{-- FIX: show slug validation error (if exists) --}}
                        <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                    </div>

                    {{-- CATEGORY --}}
                    <div class="col-md-6 mb-3">
                        <label>Category</label>

                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>

                            <option value="">Select Category</option>

                            @foreach($categories as $parent)
                                <option value="{{ $parent->id }}">
                                    {{ $parent->name }}
                                </option>

                                @foreach($parent->children ?? [] as $child)
                                    <option value="{{ $child->id }}">
                                        &nbsp;&nbsp;↳ {{ $child->name }}
                                    </option>
                                @endforeach
                            @endforeach

                        </select>

                        {{-- FIX: category validation error --}}
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    {{-- IMAGE --}}
                    <div class="col-md-6 mb-3">
                        <label>Image</label>

                        <input type="file" name="image"
                               class="form-control @error('image') is-invalid @enderror">

                        {{-- FIX: image validation error --}}
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                </div>

                {{-- CONTENT --}}
                <div class="mb-3">
                    <label>Content</label>

                    <textarea name="content" id="content"
                              class="form-control @error('content') is-invalid @enderror"
                              rows="6">{{ old('content') }}</textarea>

                    {{-- FIX: content validation error --}}
                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                </div>

                <button type="submit" class="btn btn-success">
                    Add Blog
                </button>

            </form>

        </div>

    </div>

</div>

    
<script>
document.addEventListener("DOMContentLoaded", function () {

    // FIX: check if element exists before initializing
    if (document.getElementById('content')) {
        CKEDITOR.replace('content', {
            height: 300
        });
    }

});
</script>

{{-- AUTO SLUG GENERATOR --}}
<script>
document.getElementById('title').addEventListener('input', function () {
    let slug = this.value
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');

    document.getElementById('slug').value = slug;
});
</script>

@endsection