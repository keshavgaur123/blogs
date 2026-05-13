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

    @include('contact.index')

@endsection