{{-- ================== DATA (MOVED TO TOP) ================== --}}
@php
$authors = [
    [
        "name" => "Jeremy Wade",
        "dob" => "1956-03-23",
        "image" => "assets/images/Jeremy Wade.jpg",
        "description" => "British TV presenter and wildlife documentary maker, known for River Monsters."
    ],
    [
        "name" => "Sandesh Kadur",
        "dob" => "1976-11-19",
        "image" => "assets/images/Sandesh Kadur.jpg",
        "description" => "Wildlife filmmaker, worked on BBC's Planet Earth II and National Geographic."
    ],
    [
        "name" => "Robert Caplin",
        "dob" => "1970-01-01",
        "image" => "assets/images/Robert Caplin.jpg",
        "description" => "American photographer and photojournalist."
    ],
    [
        "name" => "Ronan Donovan",
        "dob" => "1972-05-15",
        "image" => "assets/images/Ronan_Donovan.jpg",
        "description" => "Wildlife biologist and National Geographic storyteller."
    ],
    [
        "name" => "Tim Butcher",
        "dob" => "1965-07-22",
        "image" => "assets/images/Tim Butcher.jpg",
        "description" => "British journalist and travel writer."
    ]
];
@endphp

@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid p-0">

    <!-- Header -->
    <header class="bg-light text-center bg-secondary py-2">
        <div class="header" style="
            height:50vh;
            background-image: url('{{ asset('assets/images/blink_003_878ea00d.jpeg') }}');
            background-size:cover;
            background-position:center;
            color:white;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            box-shadow: inset 0 0 0 1000px rgba(0,0,0,0.35);
        ">
            <h1>About Us</h1>
            <p>We are the explorers of wild</p>
        </div>
    </header>

    <!-- About Section -->
    <div class="container mt-4">
        <h2 class="fw-bold">Who We Are</h2>
        <p>
            National Geographic Wild (NGW) is a global wildlife television network focused on nature,
            animals, and documentaries. It is part of National Geographic Partners,
            owned by The Walt Disney Company and the National Geographic Society.
        </p>
    </div>

    <!-- Table -->
    <div class="table-responsive mt-4">
        <table class="table table-striped table-bordered w-75 mx-auto">
            <thead class="table-dark">
                <tr>
                    <th>Author</th>
                    <th>Details</th>
                </tr>
            </thead>

            <tbody>

                {{-- ================= OLD STATIC DATA (COMMENTED, NOT REMOVED) ================= --}}
                {{--
                <tr>
                    <td>
                        <img src="{{ asset('assets/images/Jeremy Wade.jpg') }}" width="120">
                    </td>
                    <td>
                        <strong>Jeremy Wade</strong><br>
                        Wildlife presenter known for River Monsters.
                    </td>
                </tr>

                <tr>
                    <td>
                        <img src="{{ asset('assets/images/Sandesh Kadur.jpg') }}" width="120">
                    </td>
                    <td>
                        <strong>Sandesh Kadur</strong><br>
                        Indian wildlife filmmaker and National Geographic contributor.
                    </td>
                </tr>

                <tr>
                    <td>
                        <img src="{{ asset('assets/images/Robert Caplin.jpg') }}" width="120">
                    </td>
                    <td>
                        <strong>Robert Caplin</strong><br>
                        American photographer and journalist.
                    </td>
                </tr>
                --}}

                {{-- ================= NEW DYNAMIC DATA ================= --}}
                @foreach ($authors as $author)
                    <tr>
                        <td>
                            <img src="{{ asset($author['image']) }}" width="120">
                        </td>
                        <td>
                            <strong>{{ $author['name'] }}</strong><br>

                            <i>Date of Birth:</i>
                            <time datetime="{{ $author['dob'] }}">
                                {{ \Carbon\Carbon::parse($author['dob'])->format('d F Y') }}
                            </time>

                            <br><br>
                            {{ $author['description'] }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>


    @include('components.contact-modal')   
@endsection

{{-- ================= ORIGINAL ARRAY (COMMENTED, NOT REMOVED) ================= --}}
{{--
@php
$authors = [
    [
        "name" => "Jeremy Wade",
        "dob" => "1956-03-23",
        "image" => "assets/images/Jeremy Wade.jpg",
        "description" => "British TV presenter and wildlife documentary maker, known for River Monsters."
    ],
    [
        "name" => "Sandesh Kadur",
        "dob" => "1976-11-19",
        "image" => "assets/images/Sandesh Kadur.jpg",
        "description" => "Wildlife filmmaker, worked on BBC's Planet Earth II and National Geographic."
    ],
    [
        "name" => "Robert Caplin",
        "dob" => "1970-01-01",
        "image" => "assets/images/Robert Caplin.jpg",
        "description" => "American photographer and photojournalist."
    ],
    [
        "name" => "Ronan Donovan",
        "dob" => "1972-05-15",
        "image" => "assets/images/Ronan_Donovan.jpg",
        "description" => "Wildlife biologist and National Geographic storyteller."
    ],
    [
        "name" => "Tim Butcher",
        "dob" => "1965-07-22",
        "image" => "assets/images/Tim Butcher.jpg",
        "description" => "British journalist and travel writer."
    ]
];
@endphp
--}}