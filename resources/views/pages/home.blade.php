@extends('layouts.app')

@section('content')

    @include('layouts.navbar')
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
    </style>
    @include('layouts.navbar')


    <div class="hero">
        <div>
            <h1>Welcome to My Blog</h1>
            <p>Welcome to wild blog</p>
        </div>
    </div>

    <div class="container py-4">
        <div class="row">

            @foreach($posts as $post)
                <x-card :id="$post['id']" :title="$post['title']" :image="$post['image']" :description="$post['description']" />
            @endforeach

        </div>
    </div>

@endsection

<?php include base_path('bootstrap/modals/contact-modal.html'); ?>