@extends('layouts.dashboard-layout')

<style>
    /* PAGE WRAPPER */
    .page-wrapper {
        padding: 20px;
        padding-left: 20%;
    }

    /* TABLE CONTAINER */
    .table-container {
        width: auto;
        overflow-x: auto;
        background: #fff;
        padding: 15px;
        /* padding-left: 15%; */
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }

    /* TABLE STYLE */
    table {
        width: auto;
        border-collapse: collapse;
    }

    table th {
        background: #198754;
        color: #fff;
        padding: 10px;
        text-align: left;
        white-space: nowrap;
    }

    table td {
        padding: 10px;
        vertical-align: middle;
        white-space: nowrap;
    }

    /* BUTTONS */
    .btn {
        padding: 5px;
        font-size: 13px;
        border-radius: 4px;
    }

    /* ACTION COLUMN */
    .action-btns {
        display: flex;
        gap: 8px;
    }

    /* RESPONSIVE HEIGHT CONTROL */
    .table-container {
        max-height: 70vh;
        overflow-y: auto;
    }
</style>
@include('components.delete-modal')
<div class="page-wrapper">

    <h2 class="mb-3">Manage Categories</h2>

    <div class="table-container">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th style="width:80px;">S.NO</th>
                    <th>Category Name</th>
                    <th style="width:50px;">Created At</th>
                    <th style="width:50px;">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categories as $key => $category)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->created_at }}</td>

                        <td>
                            <div class="action-btns">

                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">
                                    Edit
                                </a>

                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    {{-- <button class="btn btn-danger" onclick="return confirm('Delete this category?')">
                                        Delete
                                    </button> --}}
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        onclick="setDeleteAction('{{ route('categories.destroy', $category->id) }}')">
                                        Delete
                                    </button>
                                </form>



                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>