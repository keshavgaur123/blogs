@extends('layouts.dashboard-layout')

@section('content')
    @include('components.delete-modal')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        /* ===== TABLE WRAPPER ===== */
        .table-responsive {
            width: 100%;
            padding: 10px;
        }

        /* ===== DATATABLE WRAPPER FIX ===== */
        .dataTables_wrapper {
            width: 100% !important;
        }

        /* ===== TABLE STYLE ===== */
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

        h3 {
            margin: 15px 0;
            font-weight: 600;
        }
    </style>

    <h3>Manage Blogs</h3>

    <div class="table-responsive">

        <table id="blogTable" class="table table-bordered table-striped">

            <thead class="table-success">
                <tr>
                    <th>S.NO</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>

        </table>

    </div>

@endsection
@include('components.delete-modal')
{{-- @section('scripts')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
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

                    { data: 'title' },

                    {
                        data: 'content',
                        render: function (data) {
                            return data ? data.substring(0, 50) + '...' : '';
                        }
                    },

                    { data: 'created_at' },

                    { data: 'updated_at' },

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

                                                    <button class="btn btn-danger btn-sm"
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
    </script> --}}



@section('scripts')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

    // GLOBAL FUNCTION
    function setDelete(id)
    {
        console.log("DELETE ID:", id);

        let form = document.getElementById('deleteForm');

        form.setAttribute('action', '/blogs/' + id);
    }

    $(document).ready(function () {

        $('#blogTable').DataTable({

            processing: true,

            ajax: {
                url: "{{ route('blogs.data') }}",
                dataSrc: "data"
            },

            columns: [

                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },

                {
                    data: 'title'
                },

                {
                    data: 'content',
                    render: function (data) {
                        return data
                            ? data.substring(0, 50) + '...'
                            : '';
                    }
                },

                {
                    data: 'created_at'
                },

                {
                    data: 'updated_at'
                },

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

{{-- @endsection --}}