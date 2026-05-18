@extends('layouts.dashboard-layout')

@section('content')



    <style>
        .card-header {
            background: #ffd700;
            font-weight: 600;
        }
    </style>
    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="card shadow">

                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">

                            @csrf
                            @method('PATCH')

                            {{-- Profile Photo --}}
                            {{-- <div class="mb-3">

                                <label class="form-label">
                                    Profile Photo
                                </label>

                                <input type="file" name="profile_photo" class="form-control">

                            </div> --}}


                            {{-- Profile Photo --}}
                            <div class="mb-3">

                                <label class="form-label">
                                    Profile Photo
                                </label>

                                {{-- Current Image Preview --}}
                                @if(Auth::user()->profile_photo)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" width="80" height="80"
                                            class="rounded-circle" style="object-fit: cover;">
                                    </div>
                                @endif

                                {{-- File Input --}}
                                <input type="file" name="profile_photo" class="form-control">

                            </div>

                            {{-- Name --}}
                            <div class="mb-3">

                                <label class="form-label">
                                    Name
                                </label>

                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control">

                            </div>

                            {{-- Email --}}
                            <div class="mb-3">

                                <label class="form-label">
                                    Email
                                </label>

                                <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control">

                            </div>

                            {{-- Submit --}}
                            <button class="btn btn-primary">

                                Update Profile

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection