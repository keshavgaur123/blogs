@extends('layouts.dashboard-layout')

@section('content')

    <style>
        .card {
            border-radius: 12px;
            max-width: 900px;
            margin: 10px auto;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: #ffd700;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
        }

        .ck-editor__editable {
            min-height: 300px;
        }

        /* =========================
           WRAPPER
        ========================= */
        #cke_content.cke_chrome {
            border-radius: 6px !important;
            border: 1px solid #111 !important;
            background: #000 !important;
        }

        /* =========================
           TOOLBAR
        ========================= */
        #cke_content .cke_top {
            background: #000 !important;
            border-bottom: 1px solid #222 !important;
        }

        /* toolbar groups */
        #cke_content .cke_toolgroup {
            background: #111 !important;
            border: 1px solid #222 !important;
        }

        /* buttons */
        #cke_content .cke_button,
        #cke_content a.cke_button {
            color: #ffd400 !important;
            /* yellow icons/text */
        }

        /* hover */
        #cke_content .cke_button:hover,
        #cke_content a.cke_button:hover {
            background: #ffd400 !important;
            color: #000 !important;
        }

        /* active button */
        #cke_content .cke_button_on {
            background: #ffd400 !important;
            color: #000 !important;
        }

        /* =========================
           EDITOR AREA
        ========================= */
        #cke_content .cke_contents {
            background: #000 !important;
        }

        /* iframe */
        #cke_content iframe {
            background: #000 !important;
        }

        /* =========================
           STATUS BAR
        ========================= */
        #cke_content .cke_bottom {
            background: #000 !important;
            border-top: 1px solid #222 !important;
            color: #777 !important;
        }
    </style>

    <div class="container">

        {{-- GLOBAL SERVER VALIDATION ERRORS --}}
        {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif --}}

        <div class="card">

            <div class="card-header">
                <h3 class="mb-0">Add Blog</h3>
            </div>

            <div class="card-body">

                <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate>

                    @csrf

                    <div class="row">

                        {{-- TITLE --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Title</label>

                            <input type="text" name="title" id="title"
                                class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                                required>

                            <div class="invalid-feedback">
                                Please enter blog title.
                            </div>

                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        {{-- SLUG --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Slug</label>

                            <input type="text" name="slug" id="slug"
                                class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" required>

                            <div class="invalid-feedback">
                                Please enter slug.
                            </div>

                            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                        </div>

                        {{-- CATEGORY --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>

                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror"
                                required>

                                <option value="">Select Category</option>

                                @foreach($categories as $parent)

                                    <option value="{{ $parent->id }}" {{ old('category_id') == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->name }}
                                    </option>

                                    @foreach($parent->children ?? [] as $child)

                                        <option value="{{ $child->id }}" {{ old('category_id') == $child->id ? 'selected' : '' }}>
                                            &nbsp;&nbsp;↳ {{ $child->name }}
                                        </option>

                                    @endforeach

                                @endforeach

                            </select>

                            <div class="invalid-feedback">
                                Please select category.
                            </div>

                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        {{-- IMAGE --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Image</label>

                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                accept="image/*">

                            <div class="invalid-feedback">
                                Please upload a valid image.
                            </div>

                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                    </div>

                    {{-- CONTENT --}}
                    <div class="mb-3">
                        <label class="form-label">Content</label>

                        <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror"
                            rows="6" required>{{ old('content') }}</textarea>

                        <div class="invalid-feedback">
                            Please enter blog content.
                        </div>

                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <button type="submit" class="btn btn-success">
                        Add Blog
                    </button>

                </form>

            </div>

        </div>

    </div>

    {{-- CKEDITOR --}}


    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>



    {{--
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script> --}}


    <script>
        CKEDITOR.replace('content');
        CKEDITOR.config.versionCheck = false;
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function () {

            // CKEDITOR
            ClassicEditor
                .create(document.querySelector('#content'))
                .catch(console.error);

            // AUTO SLUG GENERATOR
            document.getElementById('title').addEventListener('input', function () {

                let slug = this.value
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');

                document.getElementById('slug').value = slug;

            });

            // BOOTSTRAP VALIDATION
            (() => {

                'use strict';

                const forms = document.querySelectorAll('.needs-validation');

                Array.from(forms).forEach(form => {

                    form.addEventListener('submit', event => {

                        if (!form.checkValidity()) {

                            event.preventDefault();
                            event.stopPropagation();

                        }

                        form.classList.add('was-validated');

                    }, false);

                });

            })();

        });
    </script>

@endsection