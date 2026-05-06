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

<h2>Manage Categories</h2>

<div class="table-responsive">

    <table id="categoryTable" class="table table-bordered table-striped">

        <thead class="table-success">
            <tr>
                <th>S.NO.</th>
                <!-- <th>ID</th> -->
                <th>Category Name</th>
                <th>created_at</th>
                <th>Action</th>
            </tr>
        </thead>

    </table>
</div>

<!-- DataTables -->
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="../../assets/css/aside.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
<script>
    $(document).ready(function() {

        let table = $('#categoryTable').DataTable({

            ajax: {
                url: "api/fetch_category.php",
                type: "GET",

            },

            columns: [{
                    data: null,
                    render: (data, type, row, meta) => meta.row + 1
                },
                // {
                //     data: "id"
                // },
                {
                    data: "name"
                },
                {
                    data: "created_at"
                },
                {
                    data: null,
                    render: function(data) {
                        return `
                        <a href="index.php?page=update_category&id=${data.id}" class="btn btn-primary btn-sm">Edit</a>

       <a href="crud/delete.php?type=category&id=${data.id}" 
           class="btn btn-danger btn-sm"
           onclick="return confirm('Delete this category?');">
            Delete
        </a>
                        `;
                    }
                }
            ],
            pageLength: 10,
        });

        // DELETE
        $(document).on("click", ".deleteBtn", function() {

            let id = $(this).data("id");

            if (!confirm("Are you sure you want to delete this category?")) {
                return;
            }

            $.ajax({
                url: "crud/delete.php",
                type: "POST",
                data: {
                    id: id,
                    type: "category"
                },
                success: function(res) {
                    console.log("SERVER RESPONSE:", res);

                    alert("Deleted successfully");

                    table.ajax.reload(null, false); // ✅ NOW WORKS
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert("Delete failed");
                }
            });

        });

    });
</script> --}}