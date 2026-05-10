@extends('layouts.dashboard-layout')

@section('content')

    <div class="card shadow">

        <div class="card-header bg-warning">
            <h4>Add Category</h4>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('categories.store') }}">
                @csrf

                <!-- Parent -->
                <div class="mb-3">
                    <label>Category Name (Parent)</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <!-- Subcategories -->
                <div class="mb-3">
                    <label>Subcategories</label>

                    <div id="subcat-wrapper">
                        <input type="text" name="subcategories[]" class="form-control mb-2" placeholder="Subcategory">
                    </div>

                    <button type="button" class="btn btn-sm btn-primary" onclick="addSub()">+ Add More</button>
                </div>

                <button class="btn btn-success">Save</button>

            </form>

        </div>
    </div>

    <script>
        function addSub() {
            document.getElementById('subcat-wrapper').insertAdjacentHTML(
                'beforeend',
                '<input type="text" name="subcategories[]" class="form-control mb-2" placeholder="Subcategory">'
            );
        }
    </script>

@endsection