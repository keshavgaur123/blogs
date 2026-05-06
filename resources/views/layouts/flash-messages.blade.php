@php
    $flashTypes = ['success', 'error', 'warning', 'info'];
@endphp

{{-- VALIDATION ERRORS --}}
@if ($errors->any())
    <div class="toast-container position-fixed top-50 start-50 translate-middle p-3" style="z-index: 9999;">
        <div id="flashToast" class="toast text-bg-danger border-0 shadow-lg" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    <strong>Please fix the errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>
@endif


{{-- FLASH MESSAGES --}}
@foreach ($flashTypes as $type)
    @if (session($type))
        @php
            $color = match ($type) {
                'success' => 'text-bg-success',
                'error' => 'text-bg-danger',
                'warning' => 'text-bg-warning',
                default => 'text-bg-info',
            };
        @endphp

        <div class="toast-container position-fixed top-50 start-50 translate-middle p-3" style="z-index: 9999;">
            <div class="toast {{ $color }} border-0 shadow-lg flash-toast" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session($type) }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
    @endif
@endforeach


{{-- GLOBAL JS (ONLY ONCE) --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const toasts = document.querySelectorAll('.flash-toast, #flashToast');

        toasts.forEach(function (el) {
            const toast = new bootstrap.Toast(el, {
                delay: 2500,
                autohide: true
            });
            toast.show();
        });

    });
</script>