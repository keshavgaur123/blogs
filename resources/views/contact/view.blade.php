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