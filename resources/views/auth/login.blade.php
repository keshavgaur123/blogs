{{-- @extends('layouts.app')

@section('content')

@include('layouts.navbar')
<div class="container py-5 d-flex justify-content-center">

    <div class="card shadow p-4" style="width: 400px; border-radius: 12px;">

        <h4 class="mb-3 text-center">Login</h4>

        <!-- Session Status -->
        <x-auth-session-status class="mb-3" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email"
                              class="form-control mt-1"
                              type="email"
                              name="email"
                              :value="old('email')"
                              required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password"
                              class="form-control mt-1"
                              type="password"
                              name="password"
                              required />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember -->
            <div class="form-check mb-3">
                <input id="remember_me"
                       type="checkbox"
                       class="form-check-input"
                       name="remember">

                <label class="form-check-label" for="remember_me">
                    Remember me
                </label>
            </div>

            <button class="btn btn-primary w-100">
                Login
            </button>

        </form>

    </div>

</div>

@endsection --}}

@extends('layouts.app')

@section('content')

<style>
    body {
        background-color: #fff;
    }

    .login-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-card {
        background: #ffffff86;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px yellow;
        width: 100%;
        max-width: 420px;
    }

    .form-control {
        border-radius: 8px;
    }

    .btn-login {
        border-radius: 8px;
    }
</style>

<div class="login-wrapper">

    <div class="form-card">

        <h2 class="text-center mb-4">Login</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-3" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
            @csrf

            <!-- EMAIL -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="Enter your email"
                       required
                       value="{{ old('email') }}">
                <div class="invalid-feedback">Please enter your email.</div>

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- PASSWORD -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Enter your password"
                       required>
                <div class="invalid-feedback">Please enter your password.</div>

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- REMEMBER -->
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>

            <!-- BUTTON -->
            <button type="submit" class="btn btn-primary w-100 btn-login">
                Login
            </button>

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

@endsection