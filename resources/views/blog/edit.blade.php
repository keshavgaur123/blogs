@extends('layouts.dashboard-layout')

@section('content')

    <div class="container my-5">

        <div class="card shadow">

            <div class="card-header bg-warning text-dark">
                <h3 class="mb-0">Edit Blog</h3>
            </div>

            <div class="card-body">

                <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        {{-- TITLE --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}"
                                required>
                        </div>

                        {{-- SLUG --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control"
                                value="{{ old('slug', $blog->slug) }}" required>
                        </div>

                        {{-- CATEGORY --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>

                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category</option>

                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $blog->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- IMAGE --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                    </div>

                    {{-- CONTENT (CKEDITOR) --}}
                    <div class="mb-3">
                        <label class="form-label">Content</label>

                        <textarea name="content" id="content" class="form-control" rows="8">
                            {{ old('content', $blog->content) }}
                        </textarea>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Update Blog
                    </button>

                </form>

            </div>
        </div>

    </div>

@endsection

{{-- CKEDITOR --}}
@section('scripts')


    <script>
        CKEDITOR.replace('content', {
            height: 300,
            removeButtons: 'PasteFromWord'
        });
    </script>

@endsection