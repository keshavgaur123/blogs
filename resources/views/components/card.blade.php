<div class="col-md-4 mb-4 d-flex">
    <div class="card shadow h-100 w-100">
        {{-- <img src="{{ asset('assets/images/' . $image) }}" class="card-img-top"> --}}

        <img src="{{ Str::startsWith($image, 'blogs/')
    ? asset('storage/' . $image)
    : asset('assets/images/' . $image) }}" class="card-img-top">
        <div class="card-body d-flex flex-column">

            <h5 class="fw-bold">{{ $title }}</h5>

            <p>
                {{ \Illuminate\Support\Str::limit($description, 120) }}
            </p>

            <div class="mt-auto">
                <a href="{{ route('view.blog', $id) }}" class="btn btn-primary btn-sm">
                    Read More
                </a>
            </div>

        </div>

    </div>
</div>