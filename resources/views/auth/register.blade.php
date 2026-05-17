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
            padding: 20px;
        }

        .form-card {
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            width: 100%;
            max-width: 650px;
            box-shadow: 0 10px 50px yellow;
        }

        .form-card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
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

        .input-group .btn {
            border-radius: 0 10px 10px 0;
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

                        <div class="invalid-feedback">
                            Please enter your name.
                        </div>

                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>

                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                            placeholder="Enter your email address" required>

                        <div class="invalid-feedback">
                            Please enter valid email.
                        </div>

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

                    <!-- PASSWORD -->
                    <div class="col-md-6">

                        <label class="form-label">Password</label>

                        <div class="input-group">

                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Enter password"
                                required>

                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">

                                <i class="fa fa-eye"></i>

                            </button>

                        </div>

                        <!-- Strength Bar -->
                        <div class="progress mt-2" style="height:8px;">

                            <div id="power-point" class="progress-bar" role="progressbar" style="width:0%">

                            </div>

                        </div>

                        <!-- Strength Text -->
                        <small id="strength-text" class="fw-bold"></small>

                        <!-- Password Rules -->
                        <ul class="small mt-2 ps-3" id="password-rules">

                            <li id="length-rule" class="text-danger">
                                Minimum 8 characters
                            </li>

                            <li id="uppercase-rule" class="text-danger">
                                At least 1 uppercase letter
                            </li>

                            <li id="lowercase-rule" class="text-danger">
                                At least 1 lowercase letter
                            </li>

                            <li id="number-rule" class="text-danger">
                                At least 1 number
                            </li>

                            <li id="symbol-rule" class="text-danger">
                                At least 1 special character
                            </li>

                        </ul>

                        @error('password')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div class="col-md-6">

                        <label class="form-label">Confirm Password</label>

                        <div class="input-group">

                            <input type="password" id="confirmPassword" name="password_confirmation" class="form-control"
                                placeholder="Confirm password" required>

                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">

                                <i class="fa fa-eye"></i>

                            </button>

                        </div>

                        <div class="invalid-feedback">
                            Confirm password
                        </div>

                    </div>

                </div>

                <div class="text-center mb-3">

                    <button type="submit" class="btn btn-primary w-50">

                        Register

                    </button>

                </div>

                <p class="text-center mt-3">

                    Already have an account?

                    <a href="{{ route('login') }}">
                        Login
                    </a>

                </p>

            </form>

        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            // Bootstrap Validation
            const forms =
                document.querySelectorAll('.needs-validation');

            forms.forEach(form => {

                form.addEventListener('submit', function (event) {

                    if (!form.checkValidity()) {

                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add('was-validated');
                });

            });

            // Password Elements
            const password =
                document.getElementById("password");

            const power =
                document.getElementById("power-point");

            const strengthText =
                document.getElementById("strength-text");

            // Rule Elements
            const lengthRule =
                document.getElementById("length-rule");

            const upperRule =
                document.getElementById("uppercase-rule");

            const lowerRule =
                document.getElementById("lowercase-rule");

            const numberRule =
                document.getElementById("number-rule");

            const symbolRule =
                document.getElementById("symbol-rule");

            // Password Strength
            password.addEventListener("input", function () {

                const value = password.value;

                let score = 0;

                const hasLength = value.length >= 8;
                const hasUpper = /[A-Z]/.test(value);
                const hasLower = /[a-z]/.test(value);
                const hasNumber = /[0-9]/.test(value);
                const hasSymbol = /[^A-Za-z0-9]/.test(value);

                toggleRule(lengthRule, hasLength);
                toggleRule(upperRule, hasUpper);
                toggleRule(lowerRule, hasLower);
                toggleRule(numberRule, hasNumber);
                toggleRule(symbolRule, hasSymbol);

                if (hasLength) score++;
                if (value.length >= 12) score++;
                if (hasUpper) score++;
                if (hasLower) score++;
                if (hasNumber) score++;
                if (hasSymbol) score++;

                score = Math.min(score, 5);

                updateStrength(score);
            });

            // Toggle Rule UI
            function toggleRule(element, valid) {

                let text = element.textContent
                    .replace("✔ ", "")
                    .replace("✖ ", "");

                if (valid) {

                    element.classList.remove("text-danger");
                    element.classList.add("text-success");

                    element.innerHTML = "✔ " + text;

                } else {

                    element.classList.remove("text-success");
                    element.classList.add("text-danger");

                    element.innerHTML = "✖ " + text;
                }
            }

            // Strength Meter
            function updateStrength(score) {

                const widths = [
                    "0%",
                    "20%",
                    "40%",
                    "60%",
                    "80%",
                    "100%"
                ];

                const colors = [
                    "#dc3545",
                    "#fd7e14",
                    "#ffc107",
                    "#0dcaf0",
                    "#20c997",
                    "#198754"
                ];

                const labels = [
                    "Very Weak",
                    "Weak",
                    "Fair",
                    "Good",
                    "Strong",
                    "Very Strong"
                ];

                power.style.width = widths[score];

                power.style.backgroundColor = colors[score];

                strengthText.innerText = labels[score];

                strengthText.style.color = colors[score];
            }

            // Toggle Main Password
            const togglePassword =
                document.getElementById("togglePassword");

            togglePassword.addEventListener("click", function () {

                const type =
                    password.getAttribute("type") === "password"
                        ? "text"
                        : "password";

                password.setAttribute("type", type);

                this.innerHTML =
                    type === "password"
                        ? '<i class="fa fa-eye"></i>'
                        : '<i class="fa fa-eye-slash"></i>';
            });

            // Toggle Confirm Password
            const toggleConfirmPassword =
                document.getElementById("toggleConfirmPassword");

            const confirmPassword =
                document.getElementById("confirmPassword");

            toggleConfirmPassword.addEventListener("click", function () {

                const type =
                    confirmPassword.getAttribute("type") === "password"
                        ? "text"
                        : "password";

                confirmPassword.setAttribute("type", type);

                this.innerHTML =
                    type === "password"
                        ? '<i class="fa fa-eye"></i>'
                        : '<i class="fa fa-eye-slash"></i>';
            });

        });
    </script>

    @include('contact.index')

@endsection