@extends('layouts.dashboard-layout')

@section('content')

    @include('components.delete-modal')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        /* =========================
                                                               DATA TABLE WRAPPER
                                                            ========================= */
        .table-responsive {
            padding: 12px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        /* =========================
                                                               BASE TABLE
                                                            ========================= */
        /* table.dataTable {
                                                    width: 800px;
                                                    border-collapse: collapse !important;
                                                } */
        table.dataTable {
            width: auto !important;
            max-width: 800px;
            margin: 0 auto;
        }

        /* table.dataTable th,
                                        table.dataTable td {
                                            padding: 12px !important;
                                            vertical-align: middle;
                                            white-space: nowrap;
                                        } */
        table.dataTable th,
        table.dataTable td {
            padding: 8px 12px !important;
            font-size: 13px !important;
            white-space: nowrap;
        }

        /* =========================
                                                               ROW HOVER
                                                            ========================= */
        table.dataTable tbody tr:hover {
            background: #f8f9fa !important;
            transition: 0.2s;
        }

        /* =========================
                                                               CATEGORY BADGES
                                                            ========================= */
        .row-parent {
            background: #000;
            color: #fff;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 6px;
            display: inline-block;
            font-size: 13px;
        }

        .row-child {
            background: #f1f3f5;
            padding: 4px 10px;
            border-radius: 6px;
            display: inline-block;
            font-size: 13px;
            color: #333;
        }


        .border-blue {
            border-left: 4px solid #0d6efd;
        }

        .border-red {
            border-left: 4px solid #dc3545;
        }

        /* =========================
                                                               SEARCH BAR
                                                            ========================= */
        .dataTables_filter {
            float: right;
            text-align: right;
            margin-bottom: 10px;
        }

        .dataTables_filter label {
            font-weight: 600;
            color: #333;
        }

        .dataTables_filter input {
            border-radius: 8px !important;
            border: 1px solid #ddd !important;
            padding: 6px 12px !important;
            margin-left: 8px;
            outline: none;
            transition: 0.2s;
        }

        .dataTables_filter input:focus {
            border-color: #0d6efd !important;
            box-shadow: 0 0 5px rgba(13, 110, 253, 0.3);
        }

        /* =========================
                                                               PAGINATION
                                                            ========================= */
        .dataTables_paginate {
            margin-top: 15px;
            text-align: center;
        }

        .dataTables_paginate .paginate_button {
            border-radius: 6px !important;
            margin: 0 3px !important;
            padding: 5px 10px !important;
            border: 1px solid #dee2e6 !important;
            background: #fff !important;
            color: #333 !important;
            transition: 0.2s;
        }

        .dataTables_paginate .paginate_button:hover {
            background: #0d6efd !important;
            color: #fff !important;
            border-color: #0d6efd !important;
        }

        .dataTables_paginate .paginate_button.current {
            background: #0d6efd !important;
            color: #fff !important;
            border-color: #0d6efd !important;
        }

        .dataTables_paginate .paginate_button.disabled {
            opacity: 0.5 !important;
        }

        /* =========================
                                                               INFO TEXT
                                                            ========================= */
        .dataTables_info {
            font-size: 14px;
            color: #666;
            margin-top: 10px;
        }

        /* =========================
                                                               WRAPPER CLEANUP
                                                            ========================= */
        .dataTables_wrapper {
            padding-top: 10px;
        }

        /* spacing consistency */
        .dataTables_length,
        .dataTables_filter,
        .dataTables_info,
        .dataTables_paginate {
            margin-bottom: 10px;
        }
    </style>

    <div class="page-wrapper">

        <h2>Manage Blogs</h2>

        <div class="mb-3 d-flex gap-2">
            <button class="btn btn-dark btn-sm" onclick="filterBlogs('all')">All</button>
            <button class="btn btn-primary btn-sm" onclick="filterBlogs('parent')">Parent</button>
            <button class="btn btn-warning btn-sm" onclick="filterBlogs('child')">Subcategory</button>
            <button class="btn btn-secondary btn-sm" onclick="toggleView()">Expand / Collapse</button>
        </div>

        <div class="table-responsive">

            <table id="blogTable" class="table table-bordered table-striped">

                <thead class="table-success">
                    <tr>
                        <th>S.NO</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>

        </div>

    </div>

@endsection


@section('scripts')

    <script>

        let table;
        let currentFilter = 'all';
        let expanded = true;

        function setDelete(id) {
            document.getElementById('deleteForm').action = '/blogs/' + id;
        }

        $(document).ready(function () {

            table = $('#blogTable').DataTable({

                processing: true,

                ajax: {
                    url: "{{ route('blogs.data') }}",
                    dataSrc: "data"
                },

                columns: [

                    {
                        data: null,
                        render: (d, t, r, m) => m.row + 1
                    },

                    { data: 'title' },

                    {
                        data: 'category',
                        render: function (data) {

                            let name = data ? data.name : 'Main';

                            let cls = data
                                ? 'row-parent border-blue'
                                : 'row-child border-red';

                            return `<span class="${cls}">${name}</span>`;
                        }
                    },

                    {
                        data: 'content',
                        render: function (data) {

                            // FIX: strip HTML safely (CKEditor content fix)
                            return data
                                ? $('<div>').html(data).text().substring(0, 60) + '...'
                                : '';
                        }
                    },

                    {
                        data: 'created_at',
                        render: function (data) {
                            return data ? new Date(data).toLocaleString() : '';
                        }
                    },

                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {

                            return `
                                                                  <div style="display:flex;gap:8px">

                                                                                            <a href="/blogs/${data.id}/edit"
                                                                                               class="btn btn-primary btn-sm">
                                                                                               Edit
                                                                                            </a>

                                                                                            <button class="btn btn-danger btn-sm"
                                                                                                    onclick="setDelete(${data.id})"
                                                                                                    data-bs-toggle="modal"
                                                                                                    data-bs-target="#deleteModal">
                                                                                                Delete
                                                                                            </button>

                                                                                        </div>
                                                                                        `;
                        }
                    }

                ]

            });

        });


        // FILTER SYSTEM FIXED
        function filterBlogs(type) {
            currentFilter = type;
            table.draw();
        }

        $.fn.dataTable.ext.search.push(function (settings, data, index) {

            let row = table.row(index).data();

            if (!row) return true;

            if (currentFilter === 'all') return true;

            // FIXED CATEGORY LOGIC
            if (currentFilter === 'parent') {
                return row.category && row.category.parent_id === null;
            }

            if (currentFilter === 'child') {
                return row.category && row.category.parent_id !== null;
            }

            return true;
        });


        // EXPAND / COLLAPSE
        function toggleView() {

            expanded = !expanded;

            if (expanded) {

                $('#blogTable tbody span').css({
                    "opacity": "1",
                    "transform": "scale(1)"
                });

            } else {

                $('#blogTable tbody span').css({
                    "opacity": "0.6"
                });

            }
        }

    </script>

@endsection