@extends('layouts.app')

@section('content')

    <style>
        body {
            background-color: #f8f9fa;
        }

        .welcome {
            position: relative;
            height: 50vh;
            min-height: 200px;
            background-image: url('{{ asset("assets/images/makao.jpg") }}');
            background-size: cover;
            background-position: center;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            margin-bottom: 40px;
            box-shadow: inset 0 0 0 1000px rgba(0, 0, 0, 0.35);
        }

        .random-color {
            font-size: 2.5rem;
            font-weight: bold;
            background: linear-gradient(270deg, #ff5733, #33ff57, #3357ff, #f39c12, #9b59b6);
            background-size: 1000% 1000%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientAnimation 10s ease infinite;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .card {
            border-radius: 12px;
            transition: 0.3s;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .card img {
            transition: 0.5s;
        }

        .card:hover img {
            transform: scale(1.05);
        }

        .card-body p {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    {{-- HERO SECTION --}}
    <div class="container-fluid p-0">
        <div class="welcome">

            <h1 class="random-color">
                {{ $category->name ?? $blog->title ?? 'Blog Wild' }}
            </h1>

            <p>
                Exploring the world of wildlife and nature through amazing stories and images...
            </p>

        </div>
    </div>


    {{-- //apply search bar category filter by blog --}}
    {{-- if (!empty($search)) {
    $sql .= " AND (LOWER(b.title) LIKE ? OR LOWER(c.name) LIKE ?)";
    $params[] = "%" . strtolower($search) . "%";
    $params[] = "%" . strtolower($search) . "%";
    $types .= 'ss';
    } --}}

    {{-- SEARCH BAR --}}
    {{-- <div class="container mb-4">

        <form method="GET" action="{{ isset($category)
        ? route('category.blogs', $category->slug)
        : route('viewblog', $blog->slug ?? '') }}">

            <div class="row g-2">

                <div class="col-md-5">

                    <input type="text" name="search" class="form-control" placeholder="Search blogs..."
                        value="{{ request('search') }}">

                </div>

                <div class="col-md-2">

                    <button type="submit" class="btn btn-primary w-100">
                        Search
                    </button>

                </div>

            </div>

        </form>

    </div> --}}

    <div class="container mt-4">

        <div class="row g-4">

            {{-- MAIN CONTENT --}}
            <div class="col-lg-9">

                <div class="row g-4">

                    {{-- CATEGORY BLOG LIST --}}
                    @isset($blogs)

                        @forelse($blogs as $item)

                            <div class="col-md-4 mb-4  d-flex">

                                <div class="card shadow h-100 w-100">

                                    <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top"
                                        style="height:250px; object-fit:cover;"
                                        onerror="this.src='{{ asset('assets/images/default.jpg') }}'">

                                    <div class="card-body d-flex flex-column">

                                        <h5 class="fw-bold mb-2">
                                            {{ $item->title }}
                                        </h5>

                                        <span class="badge bg-light text-dark mb-2 align-self-start">
                                            {{ $item->category->name ?? 'General' }}
                                        </span>

                                        <p class="text-muted small mb-3">
                                            {{ Str::limit(strip_tags($item->content), 100) }}
                                        </p>

                                        <div class="mt-auto">

                                            <a href="{{ route('viewblog', $item->slug) }}" class="btn btn-primary btn-sm">

                                                Read More

                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="col-12 text-center text-danger">
                                No blogs found.
                            </div>

                        @endforelse

                    @endisset


                    {{-- SINGLE BLOG DETAIL --}}
                    @isset($blog)

                        <div class="col-12">

                            <div class="card shadow-sm">

                                <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top"
                                    style="max-height:500px; object-fit:cover;"
                                    onerror="this.src='{{ asset('assets/images/default.jpg') }}'">

                                <div class="card-body">

                                    <span class="badge bg-dark mb-3">
                                        {{ $blog->category->name ?? 'General' }}
                                    </span>

                                    <h2 class="fw-bold mb-3">
                                        {{ $blog->title }}
                                    </h2>

                                    <p class="text-muted">
                                        By {{ $blog->user->name ?? 'Admin' }}
                                    </p>

                                    <hr>

                                    <div>
                                        {!! $blog->content !!}
                                    </div>

                                </div>

                            </div>

                        </div>

                    @endisset

                </div>

                {{-- PAGINATION --}}
                @isset($blogs)

                    <div class="d-flex justify-content-center mt-5">
                        {{ $blogs->links() }}
                    </div>

                @endisset

            </div>

            {{-- SIDEBAR --}}
            <div class="col-lg-3">

                <div class="position-sticky" style="top:100px;">

                    {{-- POPULAR POSTS --}}
                    <div class="card p-3 mb-4">

                        <h5 class="fw-bold mb-3">
                            Top Popular Posts
                        </h5>

                        <ul class="list-unstyled">

                            @foreach($popularPosts as $post)

                                <li class="mb-3 d-flex align-items-center">

                                    <img src="{{ asset('storage/' . $post->image) }}"
                                        style="width:60px;height:60px;object-fit:cover;border-radius:6px;margin-right:10px;"
                                        onerror="this.src='{{ asset('assets/images/default.jpg') }}'">

                                    <a href="{{ route('viewblog', $post->slug) }}" class="text-dark text-decoration-none">

                                        {{ $post->title }}

                                    </a>

                                </li>

                            @endforeach

                        </ul>

                    </div>

                    {{-- ADS --}}
                    <div class="card text-center bg-dark text-white p-3">

                        <p>Advertising Section</p>

                        <img src="{{ asset('assets/images/ngw.jpg') }}" class="img-fluid rounded">

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection