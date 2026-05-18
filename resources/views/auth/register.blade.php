@extends('layouts.app')

@section('content')

    <style>
        body {
            background-color: #4e484886;
        }

        .register-wrapper {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: ;
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
                0 15px 35px yellow;
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
            border-radius: 8px;
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

                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" placeholder="Enter your full name" required>

                        <div class="invalid-feedback">Please enter your name.</div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>

                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" placeholder="Enter your email address" required>

                        <div class="invalid-feedback">Please enter valid email.</div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                </div>

                <!-- PHONE -->
                <div class="mb-3">
                    <label class="form-label">Phone</label>

                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone') }}" placeholder="Enter your phone number" pattern="[0-9]{10}"
                        title="Enter a valid 10-digit phone number">

                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- PASSWORD -->
                <div class="row mb-4 g-3">

                    <div class="col-md-6">
                        <label class="form-label">Password</label>

                        <div class="input-group">
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Enter password"
                                required>

                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>

                        <div class="invalid-feedback">Enter password</div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Confirm Password</label>

                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" placeholder="Confirm password" required>

                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>

                        <div class="invalid-feedback">Confirm password</div>
                    </div>

                </div>

                <div class="text-center mb-3">
                    <button type="submit" class="btn btn-primary w-50">
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

    <!-- VALIDATION SCRIPT -->
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

            // PASSWORD TOGGLE
            const password = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');

            togglePassword.addEventListener('click', function () {
                const type = password.type === 'password' ? 'text' : 'password';
                password.type = type;

                this.innerHTML = type === 'password'
                    ? '<i class="fa fa-eye"></i>'
                    : '<i class="fa fa-eye-slash"></i>';
            });

            // CONFIRM PASSWORD TOGGLE
            const confirmPassword = document.getElementById('password_confirmation');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');

            toggleConfirmPassword.addEventListener('click', function () {
                const type = confirmPassword.type === 'password' ? 'text' : 'password';
                confirmPassword.type = type;

                this.innerHTML = type === 'password'
                    ? '<i class="fa fa-eye"></i>'
                    : '<i class="fa fa-eye-slash"></i>';
            });
        });
    </script>

    @include('contact.index')

@endsection