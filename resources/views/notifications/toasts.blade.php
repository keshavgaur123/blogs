@if(session('success'))
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index:9999;">

        <div class="toast show text-success text-bg-light border-0" role="alert">

            <div class="d-flex">

                <div class="toast-body">

                    <strong>{{ session('success') }}</strong>

                    @if(session('blog_title'))
                        <div class="small mt-1">
                            Title: {{ session('blog_title') }}
                        </div>
                    @endif

                    @if(session('blog_slug'))
                        <div class="small">
                            Slug: {{ session('blog_slug') }}
                        </div>
                    @endif

                </div>

                <button type="button" class="btn-close btn-close-success me-2 m-auto" data-bs-dismiss="toast">
                </button>

            </div>

        </div>

    </div>
@endif