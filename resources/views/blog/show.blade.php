@include('layouts.navbar')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $blog->title }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            padding-top: 75px;
        }

        .blog-title {
            font-size: 38px;
            font-weight: 700;
        }

        .blog-meta {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .blog-image-full img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 10px;
        }

        .blog-content {
            font-size: 18px;
            line-height: 1.8;
        }
    </style>
</head>

<body>

<div class="container mt-4">

    <div class="row">

        <!-- LEFT CONTENT -->
        <div class="col-lg-8">

            {{-- BLOG IMAGE --}}
            <div class="blog-image-full mb-4">

                @if($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                @else
                    <img src="{{ asset('assets/images/default.jpg') }}" alt="default">
                @endif

            </div>

            {{-- BACK BUTTON --}}
            {{-- <a href="{{ route('blog.index') }}" class="btn btn-outline-info mb-3">
                ⬅ Back to Blogs
            </a> --}}
<a href="{{ route('blogs.index') }}" class="btn btn-outline-info mb-3"></a>
            {{-- TITLE --}}
            <h1 class="blog-title">
                {{ $blog->title }}
            </h1>

            {{-- META --}}
            <div class="blog-meta">

                👤 <strong>
                    {{ $blog->user->name ?? 'Admin' }}
                </strong>

                <span class="ms-3">
                    📂 {{ $blog->category->name ?? 'No Category' }}
                </span>

                <span class="ms-3">
                    📅 {{ $blog->created_at->format('d M Y') }}
                </span>

            </div>

            {{-- CONTENT --}}
            <div class="blog-content">
                {!! $blog->content !!}
            </div>

        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="col-lg-4">

            <div class="card p-3">

                <h5 class="fw-bold mb-3">
                    Popular Posts
                </h5>

                @foreach($popularBlogs as $post)

                    <div class="mb-3 d-flex align-items-center">

                        @if($post->image)
                            <img
                                src="{{ asset('storage/' . $post->image) }}"
                                style="width:60px;height:60px;object-fit:cover;margin-right:10px;border-radius:5px;"
                            >
                        @else
                            <img
                                src="{{ asset('assets/images/default.jpg') }}"
                                style="width:60px;height:60px;object-fit:cover;margin-right:10px;border-radius:5px;"
                            >
                        @endif

                        <a
                            href="{{ route('blog.show', $post->id) }}"
                            class="text-dark text-decoration-none"
                        >
                            {{ $post->title }}
                        </a>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</div>

</body>
</html>