@extends('layouts.app')

@section('content')

<style>
    .welcome {
        position: relative;
        height: 50vh;
        min-height: 200px;
        background-image: url('{{ asset('assets/images/makao.jpg') }}');
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
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card img {
        height: 250px;
        object-fit: cover;
    }

    .sidebar-post img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
        margin-right: 10px;
    }
</style>

<!-- HERO -->
<div class="welcome">
    <h1 class="random-color">
        {{ $categoryName ?? 'Wildlife Blogs' }}
    </h1>

    <p>
        Exploring the world of wildlife and nature through amazing stories and images...
    </p>
</div>

<!-- SEARCH -->
<div class="container mb-4">
    <form method="GET" action="{{ route('home') }}" class="d-flex">
        <input type="hidden" name="category" value="{{ request('category') }}">

        <input
            type="search"
            name="search"
            class="form-control me-2"
            placeholder="Search by title & category"
            value="{{ request('search') }}"
        >

        <button class="btn btn-success">
            Search
        </button>
    </form>
</div>

<!-- BLOG SECTION -->
<div class="container">
    <div class="row g-4">

        <!-- BLOGS -->
        <div class="col-lg-9">

            @if($blogs->count() == 0)

                <div class="alert alert-danger">
                    No blogs found.
                </div>

            @endif

            <div class="row g-4">

                @foreach($blogs as $blog)

                    <div class="col-lg-4 col-md-6">

                        <div class="card shadow-sm h-100">

                            <img
                                src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('assets/images/default.jpg') }}"
                                onerror="this.src='{{ asset('assets/images/default.jpg') }}'"
                            >

                            <div class="card-body d-flex flex-column">

                                <h5 class="fw-bold">
                                    {{ $blog->title }}
                                </h5>

                                <span class="badge bg-dark mb-2 align-self-start">
                                    {{ $blog->category->name ?? 'General' }}
                                </span>

                                <p class="text-muted small">
                                    {{ Str::limit(strip_tags($blog->content), 100) }}
                                </p>

                                <div class="mt-auto">

                                    <a
                                        href="{{ route('blog.show', $blog->id) }}"
                                        class="btn btn-primary btn-sm"
                                    >
                                        Read More
                                    </a>

                                </div>

                            </div>
                        </div>
                    </div>

                @endforeach

            </div>

            <!-- PAGINATION -->
            <div class="mt-5">
                {{ $blogs->links() }}
            </div>

        </div>

        <!-- SIDEBAR -->
        <div class="col-lg-3">

            <div class="position-sticky" style="top:100px;">

                <!-- POPULAR POSTS -->
                <div class="card p-3 mb-4">

                    <h5 class="fw-bold mb-3">
                        Popular Posts
                    </h5>

                    @foreach($popularPosts as $post)

                        <div class="d-flex align-items-center mb-3 sidebar-post">

                            <img
                                src="{{ $post->image ? asset('storage/' . $post->image) : asset('assets/images/default.jpg') }}"
                            >

                            <a
                                href="{{ route('blog.show', $post->id) }}"
                                class="text-dark text-decoration-none"
                            >
                                {{ $post->title }}
                            </a>

                        </div>

                    @endforeach

                </div>

                <!-- ADS -->
                <div class="card p-3 bg-dark text-white text-center">

                    <p>Advertising Section</p>

                    <img
                        src="{{ asset('assets/images/ngw.jpg') }}"
                        class="img-fluid rounded mb-2"
                    >

                    <p>Advertising Section</p>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection