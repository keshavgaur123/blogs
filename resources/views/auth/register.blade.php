{{-- @include('layouts.navbar')



<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}



@extends('layouts.app')

@section('content')

    <style>
        .register-wrapper {
            min-height: 85vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            padding: 20px;
        }

        .form-card {
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            width: 100%;
            max-width: 650px;

            box-shadow:
                0 10px 50px yellow;
        }

        .form-card:hover {
            box-shadow:
                0 15px 35px rgba(0, 0, 0, 0.12),
        }

        .form-control {
            border-radius: 10px;
            padding: 11px 12px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 6px;
        }

        .btn-register {
            border-radius: 10px;
            padding: 11px;
            font-size: 16px;
            font-weight: 600;
        }
    </style>

    <div class="register-wrapper">

        <div class="form-card">

            <h2 class="text-center mb-4">Register Account</h2>

            <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                @csrf

                <!-- NAME + EMAIL -->
                <div class="row mb-3 g-3">

                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                            placeholder="Enter your full name" required>
                        <div class="invalid-feedback">Please enter your name.</div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                            placeholder="Enter your email address" required>
                        <div class="invalid-feedback">Please enter valid email.</div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                </div>

                <!-- PHONE -->
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"
                        placeholder="Enter your phone number" pattern="[0-9]{10}"
                        title="Enter a valid 10-digit phone number">
                </div>

                <!-- PASSWORD -->
                <div class="row mb-4 g-3">

                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                        <div class="invalid-feedback">Enter password</div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Confirm password" required>
                        <div class="invalid-feedback">Confirm password</div>
                    </div>

                </div>




                <div class="text-center mb-3">
                    <button type="submit" class="btn btn-primary w-50" data-mdb-ripple-init>
                        Register
                    </button>
                </div>

                <p class="text-center mt-3">
                    Already have an account?
                    <a href="{{ route('login') }}">Login</a>
                </p>

            </form>

        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const forms = document.querySelectorAll('.needs-validation');

            forms.forEach(form => {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                });
            });
        });
    </script>
    @include('components.contact-modal')
@endsection