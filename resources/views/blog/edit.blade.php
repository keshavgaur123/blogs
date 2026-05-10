@extends('layouts.dashboard-layout')

@section('content')

    <style>
        .card {
            border-radius: 12px;
            max-width: 900px;
            margin: 8px auto 20px auto;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: #ffc107;
            font-weight: 600;
            padding: 10px 15px;
        }

        form .form-control,
        form .form-select {
            border-radius: 8px;
            padding: 8px 10px;
        }

        button {
            border-radius: 8px;
            padding: 8px 18px;
        }
    </style>

    <div class="container">

        <div class="card">

            <div class="card-header">
                <h4 class="mb-0">Edit Blog</h4>
            </div>

            <div class="card-body">

                <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        {{-- TITLE --}}
                        <div class="col-md-6 mb-3">
                            <label>Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ old('title', $blog->title) }}" required>
                        </div>

                        {{-- SLUG --}}
                        <div class="col-md-6 mb-3">
                            <label>Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control"
                                value="{{ old('slug', $blog->slug) }}" required>
                        </div>

                        {{-- CATEGORY --}}
                        <div class="col-md-6 mb-3">
                            <label>Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category</option>

                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $blog->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        {{-- IMAGE --}}
                        <div class="col-md-6 mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">

                            @if($blog->image)
                                <small class="text-muted d-block mt-1">
                                    Current: {{ $blog->image }}
                                </small>
                            @endif
                        </div>

                    </div>

                    {{-- CONTENT --}}
                    <div class="mb-3">
                        <label>Content</label>

                        <textarea name="content" id="content" class="form-control"
                            rows="8">{{ old('content', $blog->content) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Update Blog
                    </button>

                </form>

            </div>
        </div>

    </div>

@endsection


@section('scripts')

    <script>
        CKEDITOR.replace('content', {
            height: 300
        });
    </script>

    <script>
        document.getElementById('title').addEventListener('keyup', function () {

            let slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');

            document.getElementById('slug').value = slug;
        });
    </script>

@endsection