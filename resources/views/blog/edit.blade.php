@extends('layouts.dashboard-layout')

@section('content')
<style>
    /* ===== TABLE WRAPPER ===== */
    .table-responsive {
        width: auto;
        display: block;
        /* IMPORTANT: remove flex */
        padding: 0 10px;
    }

    /* ===== DATATABLE WRAPPER FIX ===== */
    .dataTables_wrapper {
        display: block !important;
        width: 100% !important;
    }

    /* ===== TABLE WIDTH CONTROL ===== */
    table.dataTable {
        width: 100% !important;
    }

    /* ===== OPTIONAL: keep spacing clean ===== */
    .dataTables_length,
    .dataTables_filter {
        font-size: 12px;
        margin-bottom: 8px;
    }

    /* ===== TABLE CELLS ===== */
    table.dataTable th,
    table.dataTable td {
        padding: 6px 8px !important;
        white-space: nowrap;
        vertical-align: middle;
    }
</style>

<h3>Manage Blogs</h3>

<div class="table-responsive">

    <table id="blogTable" class="table table-bordered table-striped">

        <thead class="table-success">
            <tr>
                <th>S.NO.</th>
                <!-- <th>ID</th> -->
                <th class="title-col">Title</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>


    </table>
</div>

@endsection

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


