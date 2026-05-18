@extends('layouts.dashboard-layout')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        .table-responsive {
            padding: 12px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        /* =========================
                   BASE TABLE
                ========================= */
        table.dataTable {
            width: 100% !important;
            border-collapse: collapse !important;
        }

        table.dataTable th,
        table.dataTable td {
            padding: 12px !important;
            vertical-align: middle;
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

        <h2 class="mb-4">Manage Enquiries</h2>

        <div class="table-responsive">

            <table class="table table-bordered table-striped" id="contactTable">

                <thead class="table-success">

                    <tr>
                        <th>S.NO</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created At</th>
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

            $('#contactTable').DataTable({

                processing: true,

                ajax: {
                    url: "{{ route('contact.data') }}",
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
                    { data: 'email' },
                    { data: 'title' },
                    { data: 'description' },

                    {
                        data: 'created_at',
                        render: function (data) {
                            return data ? new Date(data).toLocaleString() : '';
                        }
                    }

                ]

            });

        });
    </script>

@endsection