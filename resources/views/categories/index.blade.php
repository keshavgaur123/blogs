@extends('layouts.dashboard-layout')

@section('content')

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
       CATEGORY BADGES
    ========================= */
        .row-parent {
            background: #000 !important;
            color: #fff;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 6px;
            display: inline-block;
            font-size: 13px;
        }

        .row-child {
            background: #f1f3f5;
            color: #333;
            padding: 4px 10px;
            border-radius: 6px;
            display: inline-block;
            font-size: 13px;
        }

        /* =========================
       BORDER INDICATORS
    ========================= */
        .border-blue {
            border-left: 4px solid #0d6efd;
        }

        /* .border-red {
            border-left: 1px solid #dc3545;
        } */

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

        <h2>Manage Categories</h2>

        <div class="mb-3 d-flex gap-2">
            <button class="btn btn-dark btn-sm" onclick="filterType('all')">All</button>
            <button class="btn btn-primary btn-sm" onclick="filterType('parent')">Parent</button>
            <button class="btn btn-warning btn-sm" onclick="filterType('child')">Subcategory</button>
            <button class="btn btn-secondary btn-sm" onclick="toggleTree()">Collapse / Expand</button>
        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-striped" id="categoriesTable">

                <thead class="table-success">
                    <tr>
                        <th>S.NO</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Parent Category</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>

        </div>
    </div>

    @include('components.delete-modal')

@endsection


@section('scripts')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>

        let table;
        let collapsed = false;
        let currentFilter = 'all';

        $(document).ready(function () {

            table = $('#categoriesTable').DataTable({

                processing: true,

                ajax: {
                    url: "{{ route('categories.data') }}",
                    dataSrc: "data"
                },

                columns: [

                    {
                        data: null,
                        render: (d, t, r, m) => m.row + 1
                    },

                    {
                        data: null,
                        render: function (data) {

                            let cls = data.parent_id === null
                                ? 'row-parent border-blue'
                                : 'row-child border-red';

                            return `
                                <span class="editable ${cls}"
                                      onclick="editName(${data.id}, '${data.name}', this)">
                                    ${data.name}
                                </span>
                            `;
                        }
                    },

                    {
                        data: 'parent_id',
                        render: d => d ? 'Subcategory' : 'Parent'
                    },

                    {
                        data: 'parent',
                        render: d => d ? d.name : '<strong>Main</strong>'
                    },

                    {
                        data: 'created_at',
                        render: d => d ? new Date(d).toLocaleString() : ''
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


        // =====================
        // INLINE EDIT
        // =====================
        function editName(id, oldName, el) {

            let input = document.createElement("input");
            input.value = oldName;
            input.className = "form-control form-control-sm";
            input.style.width = "160px";

            $(el).replaceWith(input);
            input.focus();

            input.addEventListener("keydown", function (e) {

                if (e.key === "Enter") {

                    $.ajax({
                        url: `/categories/${id}`,
                        type: "PUT",
                        data: {
                            name: input.value,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function () {
                            table.ajax.reload(null, false);
                        }
                    });
                }

                if (e.key === "Escape") {
                    table.ajax.reload(null, false);
                }
            });
        }


        // =====================
        // FIXED FILTER SYSTEM
        // =====================
        function filterType(type) {

            currentFilter = type;

            table.rows().every(function () {

                let data = this.data();
                let row = this.node();

                if (!data) return;

                let show = true;

                if (type === 'parent') {
                    show = (data.parent_id === null);
                }

                if (type === 'child') {
                    show = (data.parent_id !== null);
                }

                if (type === 'all') {
                    show = true;
                }

                $(row).toggle(show);

            });
        }


        // =====================
        // FIXED TREE TOGGLE
        // =====================
        function toggleTree() {

            collapsed = !collapsed;

            table.rows().every(function () {

                let data = this.data();
                let row = this.node();

                if (!data) return;

                if (data.parent_id !== null) {
                    $(row).toggle(!collapsed);
                }
            });
        }


        // =====================
        // DELETE
        // =====================
        function setDelete(id) {
            document.getElementById('deleteForm').action = `/categories/${id}`;
        }

    </script>

@endsection