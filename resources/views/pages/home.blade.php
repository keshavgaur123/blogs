@extends('layouts.app')

@section('content')


    <style>
        .hero {
            height: 50vh;
            background-image: url('{{ asset("assets/images/4k 2chain.jpg") }}');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            box-shadow: inset 0 0 0 1000px rgba(0, 0, 0, 0.35);
        }

        .hero h1 {
            font-size: 2.6rem;
            font-weight: bold;
        }

        .hero p {
            font-size: 1.2rem;
        }

        /* Pagination container */
        .custom-pagination {
            display: inline-block;
            padding: 10px 14px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        /* Laravel pagination links */
        .custom-pagination .pagination {
            margin: 0;
            gap: 6px;
        }

        /* Page items */
        .custom-pagination .page-item .page-link {
            border-radius: 8px;
            border: none;
            color: #333;
            padding: 6px 12px;
            transition: all 0.2s ease;
        }

        /* Hover effect */
        .custom-pagination .page-item .page-link:hover {
            background-color: #0d6efd;
            color: #fff;
        }

        /* Active page */
        .custom-pagination .page-item.active .page-link {
            background-color: #0d6efd;
            color: #fff;
        }

        /* Disabled state */
        .custom-pagination .page-item.disabled .page-link {
            opacity: 0.5;
        }
    </style>

    <div class="hero">
        <div class="text-center">
            <h1>Welcome to My Blog</h1>
            <p>Welcome to wild blog</p>
        </div>
    </div>


    <div class="container py-4">
        <div class="row">

            @foreach($blogs as $blog)
                <x-card :id="$blog->slug" route="viewblog" :title="$blog->title" :image="$blog->image"
                    :description="$blog->content" />
            @endforeach

        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center my-2">
            <div class="shadow-sm p-2 rounded bg-white">
                {{ $blogs->links() }}
            </div>
        </div>
    </div>

    @include('components.contact-modal')

@endsection