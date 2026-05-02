@include('layouts.navbar')




<style>
    * {
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        background: #f4f6f9;
        color: #111;
    }

    /* NAVBAR */
    .navbar {
        background: #111827;
        padding: 15px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .navbar h2 {
        color: #fff;
        margin: 0;
        font-size: 20px;
    }

    .hero {
        position: relative;
        height: 50vh;
        min-height: 200px;
        background-image: url('assets/images/4k\ 2chain.jpg');
        background-size: cover;
        background-position: center;
        color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        margin-top: 3px;

        margin-bottom: 40px;
        box-shadow: inset 0 0 0 1000px rgba(0, 0, 0, 0.35);
        object-fit: cover;
    }

    .hero h1 {
        font-size: 2.60rem;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .hero p {
        font-size: 1.2rem;
        font-weight: 500;
    }

    .nav-links a {
        color: #fff;
        text-decoration: none;
        margin-left: 15px;
        font-size: 14px;
    }

    .nav-links a:hover {
        color: #38bdf8;
    }

    /* HERO */
    /* .hero {
        text-align: center;
        padding: 100px 20px;
        background: linear-gradient(135deg, #2563eb, #4f46e5);
        color: white;
    } */

    /* .hero h1 {
        font-size: 48px;
        margin-bottom: 10px;
    }

    .hero p {
        font-size: 18px;
        opacity: 0.9;
        max-width: 600px;
        margin: auto;
    } */

    .btn {
        display: inline-block;
        margin-top: 25px;
        padding: 12px 25px;
        background: #fff;
        color: #111827;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
    }

    .btn:hover {
        background: #e5e7eb;
    }

    /* FEATURES */
    .features {
        display: flex;
        justify-content: center;
        gap: 25px;
        padding: 60px 20px;
        flex-wrap: wrap;
    }

    .card {
        background: white;
        padding: 25px;
        width: 280px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        text-align: center;
    }

    .card img {
        width: 100%;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .card h3 {
        margin-bottom: 10px;
    }

    .card p {
        font-size: 14px;
        color: #555;
    }

    /* FOOTER */
    footer {
        text-align: center;
        padding: 25px;
        background: #111827;
        color: white;
        margin-top: 40px;
        font-size: 14px;
    }
</style>
</head>

<body>

    <!-- NAVBAR -->


    <!-- HERO -->
    <div class="hero">
        <h1>Welcome to My Blog</h1>
        <p>
            welcome to wild blog
        </p>

        {{-- <a class="btn" href="#">Explore Blogs</a> --}}
    </div>

    <!-- DATA (INSIDE SAME FILE ONLY FOR LEARNING) -->
    @php
        $blogPosts = [
            [
                "title" => "Jeremy Wade",
                "image" => "assets/images/Jeremy Wade.jpg",
                "description" => "Jeremy Wade is a British biologist, author, and TV presenter known for River Monsters."
            ],
            [
                "title" => "Pelletier Family",
                "image" => "assets/images/blink_003_878ea00d.jpeg",
                "description" => "Known for strong bonds, nature love, and community spirit."
            ],
            [
                "title" => "Jimmy Chin",
                "image" => "assets/images/jimmychin.jpg",
                "description" => "Climber, photographer, filmmaker, and adventurer."
            ],
            [
                "title" => "Chris Johns",
                "image" => "assets/images/chrisjohns.jpg",
                "description" => "Former National Geographic editor and wildlife photographer."
            ],
            [
                "title" => "Robert Caplin",
                "image" => "assets/images/Robert Caplin.jpg",
                "description" => "Photographer and filmmaker known for storytelling portraits."
            ],
            [
                "title" => "Ira Block",
                "image" => "assets/images/IraBlock.jpg",
                "description" => "National Geographic photographer focused on culture and wildlife."
            ]
        ];
    @endphp





    <div class="container">
        <div class="row">

            @foreach($blogPosts as $index => $post)

                <div class="col-md-4 mb-4 d-flex">
                    <div class="card shadow h-100 w-100 d-flex flex-column">

                        <img src="{{ asset($post['image']) }}" class="card-img-top" style="height:350px; object-fit:cover;"
                            onerror="this.src='{{ asset('assets/images/default.jpg') }}'">

                        <div class="card-body d-flex flex-column">

                            <h5 class="fw-bold">
                                {{ $post['title'] }}
                            </h5>

                            <p class="d-flex">
                                {{ \Illuminate\Support\Str::limit($post['description'], 120) }}
                            </p>

                            <div class="mt-auto">
                                {{-- <a href="admin/crud/view.php?id={{ $index + 1 }}" class="btn btn-primary btn-sm">
                                    Read More
                                </a> --}}

                                <a href="{{ route('blog.view', $index + 1) }}" class="btn btn-primary btn-sm">
                                    Read More
                                </a>

                            </div>

                        </div>

                    </div>
                </div>

            @endforeach

        </div>
    </div>

    {{-- <div class="container">
        <div class="row">

            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">

                    <img src="{{ asset('assets/images/' . basename($image)) }}" class="card-img-top img-fluid"
                        loading="lazy" style="height:250px; object-fit:cover;"
                        onerror="this.src='{{ asset('assets/images/default.jpg') }}'">

                    <div class="card-body d-flex flex-column">

                        <h5 class="fw-bold">
                            {{ $title }}
                        </h5>

                        <span class="badge bg-light text-dark align-self-start mb-2">
                            {{ $category_name ?? '' }}
                        </span>

                        <p>
                            {{ Str::limit(strip_tags($content), 120) }}
                        </p>

                        <div class="mt-auto">
                            <a href="{{ url('admin/crud/view.php?id=' . $id) }}" class="btn btn-primary btn-sm">
                                Read More
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div> --}}

    <!-- FOOTER -->
    {{-- <footer>
        © {{ date('Y') }} lam
    </footer> --}}

    {{-- @include('bootstrap.modal') --}}
    {{-- @include('bootstrap.modals.contact') --}}
    <?php include base_path('bootstrap/modals/contact-modal.html'); ?>
    @include('layouts.footer')

    {{--
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>

</html>