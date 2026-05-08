@extends('layouts.dashboard-layout')

@section('content')

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


    <div class="page-wrapper">

        <h2>Manage Categories</h2>

        <div class="table-responsive">

            <table class="table table-bordered table-striped" id="categoriesTable">
                <thead class="table-success">
                    <tr>
                        <th>S.NO</th>
                        <th>Name</th>
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

    <script>
        $(document).ready(function () {

            $('#categoriesTable').DataTable({
                processing: true,
                ajax: {
                    url: "{{ route('categories.data') }}",
                    dataSrc: "data"
                },

                columns: [
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },

                    { data: 'name' },

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

                                        <a href="/categories/${data.id}/edit"
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

        function setDelete(id) {
            document.getElementById('deleteForm').action = `/categories/${id}`;
        }
    </script>
@endsection