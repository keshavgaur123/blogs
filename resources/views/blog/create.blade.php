@extends('layouts.dashboard-layout')

@section('content')
    <style>
        /* Layout wrapper */
        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar styling */
        .sidebar {
            width: 250px;
            /* adjust as needed */
            flex-shrink: 0;
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            position: fixed;
            /* keeps sidebar fixed */
            height: 100%;
        }

        /* Main content next to sidebar */
        .main-content {
            margin-left: 290px;
            /* same as sidebar width */
            flex-grow: 1;
            padding: 20px;
            background-color: #f4f6f9;
        }

        /* Container adjustments */
        .container.my-5 {
            padding-left: 0;
            padding-right: 0;
        }

        /* Card styling */
        .card {
            border-radius: 12px;
            overflow: hidden;
            width: auto;
            max-width: 900px;
            margin-left: 0;
            /* left-align inside main content */
            margin-right: auto;
            margin-bottom: 40px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        /* Card header */
        .card-header {
            padding: 10px 15px;
            font-weight: 500;
            font-size: 1.1rem;
            background-color: #ffd700;
            /* yellow */
            color: #000;
        }

        /* Card body */
        .card-body {
            padding: 15px 20px;
        }

        /* Form inputs */
        form .form-control,
        form .form-select {
            border-radius: 8px;
            padding: 10px 12px;
            width: auto;
            font-size: 0.95rem;
        }

        /* Submit button */
        form button {
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        form button:hover {
            background-color: #ffd700;
            /* darker yellow */
            transform: scale(1.03);
        }

        /* Alerts */
        .alert {
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: auto;
                height: auto;
            }

            .main-content {
                margin-left: 0;
                padding: 10px;
            }

            .card {
                max-width: 100%;
            }
        }
    </style>


    <div class="container my-5">
        <div class="card shadow">
            <div class="card-header bg-warning text-black">
                <h3 class="mb-0">Add Blog</h3>
            </div>

            <div class="card-body">

                <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    @csrf

                    <div class="row">

                        <!-- Title -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"
                                required>

                            <div class="invalid-feedback">
                                Please provide a title.
                            </div>
                        </div>

                        <!-- Slug (NEW) -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}"
                                required>

                            <div class="invalid-feedback">
                                Please provide a slug.
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>

                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category</option>

                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>

                            <div class="invalid-feedback">
                                Please select a category.
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <!-- Image -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                    </div>

                    <!-- Content -->
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea name="content" class="form-control" rows="6" required>{{ old('content') }}</textarea>

                        <div class="invalid-feedback">
                            Please enter content.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Add Blog
                    </button>

                </form>

            </div>
        </div>
    </div>

    <!-- AUTO SLUG SCRIPT -->
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