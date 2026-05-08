@extends('layouts.dashboard-layout')

@section('content')

<style>
    /* .card {
        max-width: 550px;
        padding-left: -50px;
        margin: auto;
    } */

     body {
        background-color: #f4f6f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: 100vh;
        padding: 20px 15px;
    }

    .card {
        width: 100%;
        max-width: 550px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        margin: 0;
    }

    .card-header {
        padding: 10px 15px;
        font-weight: 400;
        font-size: 1rem;
        background-color: #ffd700;
    }

    .card-body {
        padding: 25px;
    }

    form .form-control,
    form .form-select {
        border-radius: 8px;
        padding: 10px 12px;
        width: 100%;
    }

    form button {
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .alert {
        border-radius: 8px;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .container {
            padding: 10px;
        }

        .card {
            max-width: 100%;
        }

        .card-body {
            padding: 15px;
        }

        form button {
            width: 100%;
            margin-top: 10px;
        }
    }
</style>

<div class="card shadow">

    <div class="card-header bg-warning">
        <h4>Add Category</h4>
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <div class="mb-3">
                <label>Category Name</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       required>
            </div>

            <button class="btn btn-success">Save</button>

        </form>

    </div>
</div>

@endsection