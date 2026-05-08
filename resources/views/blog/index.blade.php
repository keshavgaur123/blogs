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

@push('scripts')



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

                {
                    data: "id"
                },

                {
                    data: "title"
                },

                {
                    data: "created_at"
                },

                {
                    data: "updated_at"
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
            ],

            pageLength: 10,
        });

    });

    // DELETE
    function setDelete(id) {
        document.getElementById('deleteForm').action = `/blogs/${id}`;
    }
</script>