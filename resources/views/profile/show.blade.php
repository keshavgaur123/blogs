@extends('layouts.dashboard-layout')

@section('content')

    @php
        $user = Auth::user();
    @endphp

    <section class="vh-100 d-flex align-items-center bg-light">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-md-5">

                    <div class="card shadow-lg border-0" style="border-radius: 20px;">

                        <div class="card-body text-center p-5">

                            {{-- Profile Image --}}
                            <img src="{{ $user->profile_photo
        ? asset('storage/' . $user->profile_photo)
        : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}" class="rounded-circle shadow mb-3"
                                style="width: 120px; height:120px; object-fit:cover; border:4px solid #0d6efd;" />

                            {{-- Name --}}
                            <h3 class="fw-bold">{{ $user->name }}</h3>

                            {{-- Role Badge --}}
                            <p class="mb-1">

                                @if($user->is_admin)
                                    <span class="badge bg-danger px-3 py-2">Admin</span>
                                @else
                                    <span class="badge bg-success px-3 py-2">User</span>
                                @endif

                            </p>

                            {{-- Email --}}
                            <p class="text-muted mb-4">
                                {{ $user->email }}
                            </p>

                            {{-- Social Icons --}}
                            <div class="mb-4">

                                <a href="#" class="btn btn-outline-primary btn-sm rounded-circle mx-1">
                                    <i class="fab fa-facebook-f"></i>
                                </a>

                                <a href="#" class="btn btn-outline-info btn-sm rounded-circle mx-1">
                                    <i class="fab fa-twitter"></i>
                                </a>

                                <a href="#" class="btn btn-outline-dark btn-sm rounded-circle mx-1">
                                    <i class="fab fa-github"></i>
                                </a>

                            </div>

                            {{-- Edit Button --}}
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary px-4 rounded-pill">

                                Edit Profile

                            </a>

                            {{-- Stats --}}
                            <div class="row mt-5">

                                <div class="col">
                                    <h5 class="mb-0">10</h5>
                                    <small class="text-muted">Blogs</small>
                                </div>

                                <div class="col">
                                    <h5 class="mb-0">5</h5>
                                    <small class="text-muted">Categories</small>
                                </div>

                                <div class="col">
                                    <h5 class="mb-0">{{ $user->id }}</h5>
                                    <small class="text-muted">User ID</small>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection