{{--
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $blog->title }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }

        .page-wrapper {
            padding-top: 30px;
            padding-bottom: 50px;
        }

        .blog-image img {
            width: 100%;
            height: 380px;
            object-fit: cover;
            border-radius: 12px;
        }

        .blog-title {
            font-size: 36px;
            font-weight: 700;
        }

        .blog-meta {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .blog-content {
            font-size: 18px;
            line-height: 1.8;
        }

        .sidebar-card {
            position: sticky;
            top: 20px;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    @include('layouts.navbar')

    <div class="container page-wrapper">

        <div class="row g-4">

            <!-- MAIN CONTENT -->
            <div class="col-lg-8">

                <!-- IMAGE -->
                <div class="blog-image mb-4">

                    @if($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                    @else
                    <img src="{{ asset('assets/images/default.jpg') }}" alt="default">
                    @endif

                </div>

                <!-- BACK BUTTON -->
                <a href="{{ route('blogs.index') }}" class="btn btn-outline-primary mb-3">
                    ⬅ Back to Blogs
                </a>

                <!-- TITLE -->
                <h1 class="blog-title mb-3">
                    {{ $blog->title }}
                </h1>

                <!-- META -->
                <div class="blog-meta mb-4">

                    👤 {{ $blog->user->name ?? 'Admin' }} |
                    📂 {{ $blog->category->name ?? 'No Category' }} |
                    📅 {{ $blog->created_at->format('d M Y') }}

                </div>

                <!-- CONTENT -->
                <div class="blog-content">
                    {!! $blog->content !!}
                </div>

            </div>

            <!-- SIDEBAR -->
            <div class="col-lg-4">

                <div class="card shadow-sm p-3 sidebar-card">

                    <h5 class="fw-bold mb-3">Popular Posts</h5>

                    @foreach($popularBlogs as $post)

                    <div class="d-flex align-items-center mb-3">

                        <img src="{{ asset('storage/' . $post->image) }}"
                            style="width:60px;height:60px;object-fit:cover;border-radius:6px;margin-right:10px;">

                        <a href="{{ route('blogs.show', $post->id) }}" class="text-dark text-decoration-none">

                            {{ $post->title }}

                        </a>

                    </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $blog->title }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            padding-top: 75px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .blog-title {
            font-size: 38px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .blog-meta {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .blog-image-full img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            display: block;
        }

        .blog-content {
            font-size: 18px;
            line-height: 1.8;
        }

        .blog-content h2 {
            font-size: 24px;
            margin-top: 25px;
            margin-bottom: 12px;
            border-bottom: 2px solid #ffd700;
            padding-bottom: 5px;
        }

        .blog-content p {
            font-size: 16px;
            line-height: 1.7;
            color: #333;
            margin-bottom: 15px;
        }

        .blog-content ul {
            padding-left: 20px;
            margin-bottom: 15px;
        }

        .blog-content li {
            margin-bottom: 6px;
        }

        .popular-posts li img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            /* padding-top: 200px; */
            margin-right: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    @include('layouts.navbar')

    {{-- HERO IMAGE --}}
    @if($blog->image)
        <div class="blog-image-full position-relative mb-4">

            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">

            <h1 class="blog-title text-white position-absolute top-50 start-50 translate-middle text-center">
                {{ $blog->category->name ?? 'Blog' }}
            </h1>

        </div>
    @endif

    <div class="container mt-4">

        <div class="row">

            {{-- LEFT CONTENT --}}
            <div class="col-lg-8">

                {{-- BACK BUTTON --}}
                <a href="{{ route('blogs.index') }}" class="btn btn-outline-info mt-3">
                    ⬅ Back to Blogs
                </a>

                {{-- TITLE --}}
                <h1 class="blog-title">
                    {{ $blog->title }}
                </h1>

                {{-- META --}}
                <div class="blog-meta">

                    👤 <strong>
                        {{ $blog->user->name ?? 'Unknown' }}
                    </strong>

                    <span class="ms-3">
                        📅 {{ $blog->created_at->format('F d, Y H:i') }}
                    </span>

                </div>

                {{-- CONTENT --}}
                <div class="blog-content">
                    {!! $blog->content !!}
                </div>

            </div>

            {{-- RIGHT SIDEBAR --}}
            <div class="col-md-4">

                <div class="card p-3 mb-4">

                    <h5 class="fw-bold mb-3">Top Five Popular Posts</h5>

                    <ul class="list-unstyled popular-posts">

                        @foreach($popularBlogs as $post)

                            <li class="mb-3 d-flex align-items-center">

                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">

                                <a href="{{ route('blogs.show', $post->id) }}" class="text-dark">

                                    {{ $post->title }}

                                </a>

                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    </div>

    {{-- FOOTER / MODAL (OPTIONAL) --}}
    @include('components.contact-modal')

    {{-- SCRIPT --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const wordsPerMinute = 100;
            const content = document.querySelector(".blog-content");
            const meta = document.querySelector(".blog-meta");

            if (content && meta) {
                const text = content.innerText.trim();
                const wordCount = text.split(/\s+/).filter(Boolean).length;
                const readingTime = Math.ceil(wordCount / wordsPerMinute);

                const span = document.createElement("span");
                span.innerHTML = ` ⏱ ${readingTime} min read`;
                span.style.marginLeft = "10px";

                meta.appendChild(span);
            }

        });
    </script>

</body>

</html>