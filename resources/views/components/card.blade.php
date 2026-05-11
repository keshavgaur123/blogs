        {{-- <div class="col-md-4 mb-4 d-flex">
            <div class="card shadow h-100 w-100">
                <img src="{{ asset('assets/images/' . $image) }}" class="card-img-top">
                <div class="card-body d-flex flex-column">

                    <h5 class="fw-bold">{{ $title }}</h5>

                    <p>
                        {{ \Illuminate\Support\Str::limit($description, 120) }}
                    </p>

                    <div class="mt-auto">
                        <a href="{{ route('blogs.show', $id) }}" class="btn btn-primary btn-sm">
                            Read More
                        </a>
                    </div>

                </div>

            </div>
        </div> --}}

        {{-- @props([
        'id' => null,
        'title' => '',
        'image' => '',
        'description' => '',
        'route' => 'blog.show'
    ]) --}}

    @props([
    'id' => null,
    'title' => '',
    'image' => '',
    'description' => '',
    'route' => 'viewblog'
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
            >

            <div class="card-body d-flex flex-column">

                <h5 class="fw-bold">{{ $title }}</h5>

                <p>
                    {{ \Illuminate\Support\Str::limit($description, 120) }}
                </p>

                <div class="mt-auto">
                    {{-- <a href="{{ route($route, $slug ?? $id) }}" class="btn btn-primary btn-sm">
                        Read More
                    </a> --}}
                {{-- <a href="{{ route('blog.show', $slug) }}" class="btn btn-primary btn-sm">
        Read More
    </a> --}}
    <a href="{{ route($route, $id) }}" class="btn btn-primary btn-sm">
    Read More
</a>

                </div>

            </div>

        </div>
    </div>