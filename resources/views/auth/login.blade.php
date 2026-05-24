@extends('layouts.app')

@section('content')

    <style>
        body {
            background-color: #4e484886;
        }

        .login-wrapper {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .form-card {
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 50px yellow;
            width: 100%;
            max-width: 420px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 6px;
        }

        .form-control {
            border-radius: 10px;
            padding: 11px 12px;
        }

        .btn-login {
            border-radius: 8px;
            padding: 10px;
            font-weight: 600;
        }

        .input-group .btn {
            border-radius: 0 10px 10px 0;
        }
    </style>


    <div class="login-wrapper">

        <div class="form-card">

            <h2 class="text-center mb-4">Login</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>

                @csrf

                <!-- EMAIL / LOGIN -->
                <div class="mb-3">
                    <label class="form-label">Email</label>

                    <input type="text" name="login" class="form-control" placeholder="Enter username or email" required
                        value="{{ old('login') }}">

                    <div class="invalid-feedback">
                        Please enter your email.
                    </div>

                    <x-input-error :messages="$errors->get('login')" />
                </div>

                <!-- PASSWORD -->
                <div class="mb-3">

                    <label class="form-label">Password</label>

                    <div class="input-group">

                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password"
                            required>

                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fa fa-eye"></i>
                        </button>

                    </div>

                    <div class="invalid-feedback">
                        Please enter your password.
                    </div>

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                </div>

                <!-- REMEMBER -->
                <div class="form-check mb-3">

                    <input type="checkbox" class="form-check-input" name="remember" id="remember">

                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>

                </div>

                <!-- FORGOT PASSWORD LINK (OTP) -->
                {{-- <div class="text-end mb-3">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#forgotOtpModal">
                        Forgot Password?
                    </a>
                </div> --}}
                <!-- FORGOT PASSWORD -->
                <div class="text-end mb-3">

                    @if (Route::has('password.request'))

                        <a href="{{ route('password.request') }}" class="text-decoration-none">

                            Forgot Password?

                        </a>

                    @endif

                </div>

                <!-- LOGIN BUTTON -->
                <button type="submit" class="btn btn-warning w-100 btn-login">
                    Login
                </button>

            </form>

        </div>

    </div>


    <!-- ================= OTP MODAL ================= -->

    {{--
    <!-- FORGOT PASSWORD OTP MODAL -->
    <div class="modal fade" id="forgotOtpModal" tabindex="-1" aria-labelledby="forgotOtpModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg rounded-4">

                <div class="modal-header">

                    <h5 class="modal-title fw-bold" id="forgotOtpModalLabel">
                        Reset Password via OTP
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <!-- SUCCESS MESSAGE -->
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <!-- VALIDATION ERRORS -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">

                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach

                        </ul>
                    </div>
                    @endif

                    <!-- SEND OTP FORM -->
                    <form method="POST" action="{{ route('otp.send') }}" class="mb-4">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Email Address
                            </label>

                            <input type="email" name="email" class="form-control rounded-3" placeholder="Enter your email"
                                required>

                        </div>

                        <button type="submit" class="btn btn-primary w-100 rounded-3">

                            Send OTP

                        </button>

                    </form>

                    <hr>

                    <!-- RESET PASSWORD FORM -->
                    <form method="POST" action="{{ route('otp.reset') }}">

                        @csrf

                        <!-- EMAIL -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Email Address
                            </label>

                            <input type="email" name="email" class="form-control rounded-3" placeholder="Enter your email"
                                required>

                        </div>

                        <!-- OTP -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                OTP
                            </label>

                            <input type="text" name="otp" class="form-control rounded-3" placeholder="Enter OTP" required>

                        </div>

                        <!-- PASSWORD -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                New Password
                            </label>

                            <input type="password" name="password" class="form-control rounded-3"
                                placeholder="Enter new password" required>

                        </div>

                        <!-- CONFIRM PASSWORD -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Confirm Password
                            </label>

                            <input type="password" name="password_confirmation" class="form-control rounded-3"
                                placeholder="Confirm new password" required>

                        </div>

                        <button type="submit" class="btn btn-success w-100 rounded-3">

                            Reset Password

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div> --}}



    <script>

        // Bootstrap Validation
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

        // Show / Hide Password
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function () {

            const type = password.getAttribute('type') === 'password'
                ? 'text'
                : 'password';

            password.setAttribute('type', type);

            this.innerHTML = type === 'password'
                ? '<i class="fa fa-eye"></i>'
                : '<i class="fa fa-eye-slash"></i>';

        });

    </script>

    @include('contact.index')

@endsection