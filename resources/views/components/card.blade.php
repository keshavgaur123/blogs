<div class="col-md-4 mb-4 d-flex">

    <div class="card shadow h-100 w-100 d-flex flex-column">

        <img src="{{ asset($image) }}"
             class="card-img-top"
             style="height:350px; object-fit:cover;"
             onerror="this.src='{{ asset('assets/images/default.jpg') }}'">

        <div class="card-body d-flex flex-column">

            <h5 class="fw-bold">
                {{ $title }}
            </h5>

            <p>
                {{ \Illuminate\Support\Str::limit($description, 120) }}
            </p>

            <div class="mt-auto">
                <a href="{{ route('blog.view', $id) }}"
                   class="btn btn-primary btn-sm">
                    Read More
                </a>
            </div>

        </div>

    </div>

</div>