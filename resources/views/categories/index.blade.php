@extends('layouts.dashboard-layout')

@section('content')

    <style>
        /* .table-responsive {
                width: auto;
                display: block;
                padding: 0 5px;
            }

            .dataTables_wrapper {
                display: block !important;
                width: 100% !important;
            }

            table.dataTable {
                width: 100% !important;
            }

            .dataTables_length,
            .dataTables_filter {
                font-size: 12px;
                margin-bottom: 8px;
            }

            table.dataTable th,
            table.dataTable td {
                padding: 6px 8px !important;
                white-space: nowrap;
                vertical-align: middle;
            } */
    </style>

    <div class="page-wrapper">

        <h2>Manage Categories</h2>

        <div class="table-container">

            <table class="table table-bordered" id="categoriesTable">
                <thead>
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

    {{-- DELETE MODAL (INSIDE SAME FILE) --}}
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="modal-header">
                        <h5 class="modal-title">Delete Category</h5>
                    </div>

                    <div class="modal-body">
                        Are you sure you want to delete this category?
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
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
                ],
                pageLength: 10,
            });

        });

        function setDelete(id) {
            document.getElementById('deleteForm').action = `/categories/${id}`;
        }
    </script>
@endpush