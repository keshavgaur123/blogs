@extends('layouts.dashboard-layout')

@section('content')

    @include('components.delete-modal')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        .table-responsive {
            padding: 12px;
            background: #fff;
            border-radius: 8px;
        }

        table.dataTable {
            width: 100% !important;
        }

        .row-parent {
            background: #000;
            color: #fff;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 4px;
            display: inline-block;
        }

        .row-child {
            background: #f8f9fa;
            padding: 3px 8px;
            border-radius: 4px;
            display: inline-block;
        }

        .border-blue {
            border-left: 4px solid #0d6efd;
        }

        .border-red {
            border-left: 4px solid #dc3545;
        }

        table.dataTable th,
        table.dataTable td {
            padding: 10px !important;
            vertical-align: middle;
            white-space: nowrap;
        }

        table.dataTable tbody tr:hover {
            background: #f8f9fa;
        }
    </style>

    <div class="page-wrapper">

        <h2>Manage Blogs</h2>

        <!-- ✅ BUTTON BAR (CATEGORY STYLE + EXPAND/COLLAPSE INCLUDED) -->
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/js/bootstrap.bundle.min.js"></script>

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

                    {
                        data: 'title'
                    },

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
                            return data ? data.substring(0, 60) + '...' : '';
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


        // =====================
        // FILTER SYSTEM
        // =====================
        function filterBlogs(type) {

            currentFilter = type;
            table.draw();
        }

        $.fn.dataTable.ext.search.push(function (settings, data, index) {

            let row = table.row(index).data();

            if (!row) return true;

            if (currentFilter === 'all') return true;

            if (currentFilter === 'parent') return row.category !== null;

            if (currentFilter === 'child') return row.category === null;

            return true;
        });


        // =====================
        // EXPAND / COLLAPSE (VISUAL MODE)
        // =====================
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