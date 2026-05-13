<!-- resources/views/notifications/toasts.blade.php -->

@if (session('success'))
    <div class="toast align-items-center text-bg-success border-0 position-fixed top-0 end-0 m-3 show" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
@endif


@if (session('error'))
    <div class="toast align-items-center text-bg-danger border-0 position-fixed top-0 end-0 m-3 show" style="top:4.5rem;"
        role="alert">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('error') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
@endif


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toasts = document.querySelectorAll('.toast');
        toasts.forEach(t => {
            new bootstrap.Toast(t, { delay: 4000 }).show();
        });
    });
</script>