@extends('layouts.dashboard-layout')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        .table-responsive {
            padding: 10px;
        }

        .dataTables_wrapper {
            width: 100% !important;
        }

        table.dataTable {
            width: 100% !important;
        }
    </style>

    <div class="page-wrapper">

        <h2>Manage Enquaries</h2>

        <div class="table-responsive">

            <table class="table table-bordered table-striped" id="contactTable">

                <thead class="table-success">
                    <tr>
                        <th>S.NO</th>
                        <th>Name</th>
                        <th>Type</th>
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

            $('#contactTable').DataTable({

                processing: true,

                ajax: {
                    url: "{{ route('contact.data') }}",
                    dataSrc: "data"
                },

                columns: [

                    // SERIAL
                    {
                        data: null,
                        render: (d, t, r, m) => m.row + 1
                    },

                    // // NAME (INDENT CHILD)
                    // {
                    //     data: null,
                    //     render: function (data) {

                    //         if (data.parent_id === null) {
                    //             return `<strong>${data.name}</strong>`;
                    //         }

                    //         return `<span style="padding-left:20px;">↳ ${data.name}</span>`;
                    //     }
                    // },

                    // // TYPE
                    // {
                    //     data: 'parent_id',
                    //     render: function (data) {
                    //         return data ? 'Subcategory' : 'Parent Category';
                    //     }
                    // },

                    // // PARENT NAME
                    // {
                    //     data: 'parent',
                    //     render: function (data) {
                    //         return data ? data.name : '<span class="badge bg-success">Main</span>';
                    //     }
                    // },

                    // DATE
                    {
                        data: 'created_at',
                        render: d => d ? new Date(d).toLocaleString() : ''
                    },

                    // ACTION
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

        // DELETE
        function setDelete(id) {
            document.getElementById('deleteForm').action = `/categories/${id}`;
        }
    </script>

@endsection