@extends('layouts.dashboard-layout')

@section('content')

    @include('components.delete-modal')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        .table-responsive {
            width: 100%;
            padding: 10px;
        }

        .dataTables_wrapper {
            width: 100% !important;
        }

        table.dataTable {
            width: 100% !important;
        }

        .dataTables_length,
        .dataTables_filter {
            font-size: 13px;
            margin-bottom: 10px;
        }

        table.dataTable th,
        table.dataTable td {
            padding: 8px !important;
            white-space: nowrap;
            vertical-align: middle;
        }
    </style>

    <h3>Manage Blogs</h3>

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

@endsection


@section('scripts')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>

        function setDelete(id) {
            document.getElementById('deleteForm').action = '/blogs/' + id;
        }

        $(document).ready(function () {

            $('#blogTable').DataTable({

                processing: true,

                ajax: {
                    url: "{{ route('blogs.data') }}",
                    dataSrc: "data"
                },

                columns: [

                    // S.NO
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },

                    // TITLE
                    {
                        data: 'title'
                    },

                    // CATEGORY (IMPORTANT FIX)
                    {
                        data: 'category',
                        render: function (data) {
                            return data ? data.name : '<span class="badge bg-secondary">No Category</span>';
                        }
                    },

                    // CONTENT PREVIEW
                    {
                        data: 'content',
                        render: function (data) {
                            return data ? data.substring(0, 60) + '...' : '';
                        }
                    },

                    // CREATED AT (FIXED FORMAT)
                    {
                        data: 'created_at',
                        render: function (data) {
                            return data ? new Date(data).toLocaleString() : '';
                        }
                    },

                    // ACTION
                    {
                        data: null,
                        orderable: false,
                        searchable: false,

                        render: function (data) {

                            return `
                            <a href="/blogs/${data.id}/edit"
                               class="btn btn-primary btn-sm">
                               Edit
                            </a>

                            <button type="button"
                                    class="btn btn-danger btn-sm"
                                    onclick="setDelete(${data.id})"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                Delete
                            </button>
                        `;
                        }
                    }

                ]

            });

        });

    </script>

@endsection