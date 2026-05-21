@props([
    'id' => '',
    'title' => '',
    'image' => '',
    'description' => '',
    'route' => 'viewblog',
    'username' => null
])

<div class="col-md-4 mb-4 d-flex">
    <div class="card shadow h-100 w-100">

        <img
            src="{{ $image
                ? (str_contains($image, 'http')
                    ? $image
                    : asset('storage/' . $image))
                : asset('assets/images/default.jpg') }}"
            class="card-img-top"
            style="height: 220px; object-fit: cover;"
        >

        <div class="card-body d-flex flex-column">

            <h5 class="fw-bold mb-1">
                {{ $title }}
            </h5>

            {{-- AUTHOR --}}
            @if($username)
                <small class="text-muted mb-2">
                    By {{ $username }}
                </small>
            @endif

            <p>
                {{ \Illuminate\Support\Str::limit(strip_tags($description), 120) }}
            </p>

            <div class="mt-auto">
                <a href="{{ route($route, $id) }}" class="btn btn-primary btn-sm">
                    Read More
                </a>
            </div>

        </div>
    </div>
</div>