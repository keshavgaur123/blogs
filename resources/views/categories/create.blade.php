@extends('layouts.dashboard-layout')

@section('content')

    <style>
        .card {
            border-radius: 12px;
            max-width: 800px;
            margin: 20px auto;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            font-weight: 600;
        }

        .form-control {
            border-radius: 8px;
        }
    </style>

    <div class="container">

        {{-- GLOBAL VALIDATION ERRORS --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>
            </div>
        @endif

        <div class="card shadow">

            <div class="card-header bg-warning">
                <h4 class="mb-0">Add Category</h4>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('categories.store') }}" class="needs-validation" novalidate>

                    @csrf

                    {{-- PARENT CATEGORY --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Category Name (Parent)
                        </label>

                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" required>

                        <div class="invalid-feedback">
                            Please enter category name.
                        </div>

                        <x-input-error :messages="$errors->get('name')" class="mt-2" />

                    </div>

                    {{-- SUBCATEGORIES --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Subcategories
                        </label>

                        <div id="subcat-wrapper">

                            @if(old('subcategories'))

                                @foreach(old('subcategories') as $sub)

                                    <div class="subcat-item mb-2 d-flex gap-2">

                                        <input type="text" name="subcategories[]" class="form-control" value="{{ $sub }}"
                                            placeholder="Subcategory">

                                        <button type="button" class="btn btn-danger remove-sub">
                                            ×
                                        </button>

                                    </div>

                                @endforeach

                            @else

                                <div class="subcat-item mb-2 d-flex gap-2">

                                    <input type="text" name="subcategories[]" class="form-control" placeholder="Subcategory">

                                    <button type="button" class="btn btn-danger remove-sub">
                                        ×
                                    </button>

                                </div>

                            @endif

                        </div>

                        <button type="button" class="btn btn-sm btn-primary mt-2" id="add-sub-btn">

                            + Add More

                        </button>

                    </div>

                    {{-- SUBMIT --}}
                    <button type="submit" class="btn btn-info">
                        Save
                    </button>

                </form>

            </div>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // ADD SUBCATEGORY
            document.getElementById('add-sub-btn').addEventListener('click', function () {

                let html = `
                <div class="subcat-item mb-2 d-flex gap-2">

                    <input type="text"
                           name="subcategories[]"
                           class="form-control"
                           placeholder="Subcategory">

                    <button type="button"
                            class="btn btn-danger remove-sub">
                        ×
                    </button>

                </div>
            `;

                document.getElementById('subcat-wrapper')
                    .insertAdjacentHTML('beforeend', html);

            });

            // REMOVE SUBCATEGORY
            document.addEventListener('click', function (e) {

                if (e.target.classList.contains('remove-sub')) {

                    e.target.closest('.subcat-item').remove();

                }

            });

            // BOOTSTRAP VALIDATION
            (() => {

                'use strict';

                const forms = document.querySelectorAll('.needs-validation');

                Array.from(forms).forEach(form => {

                    form.addEventListener('submit', function (event) {

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