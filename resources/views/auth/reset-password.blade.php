<x-guest-layout>

    <div class="text-center mb-4">

        <h2 class="fw-bold text-warning mb-3">
            Reset Password
        </h2>

        <p class="text-secondary small">
            Forgot your password? No problem. Just let us know your
            email address and we will email you a password reset link
            that will allow you to choose a new one.
        </p>

    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 alert alert-success" :status="session('status')" />

    <form method="POST" action="{{ route('password.store') }}" class="needs-validation" novalidate>

        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email -->
        <div class="mb-3">

            <label for="email" class="form-label fw-semibold">
                Email Address
            </label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                class="form-control rounded-3"
                placeholder="Enter your email"
                required
                autofocus
                autocomplete="username">

            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />

        </div>

        <!-- Password -->
        <div class="mb-3">

            <label for="password" class="form-label fw-semibold">
                New Password
            </label>

            <div class="input-group">

                <input
                    id="password"
                    type="password"
                    name="password"
                    class="form-control rounded-start-3"
                    placeholder="Enter new password"
                    required
                    autocomplete="new-password">

                <button
                    class="btn btn-outline-secondary"
                    type="button"
                    id="togglePassword">

                    <i class="fa fa-eye"></i>

                </button>

            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />

        </div>

        <!-- Confirm Password -->
        <div class="mb-4">

            <label for="password_confirmation" class="form-label fw-semibold">
                Confirm Password
            </label>

            <div class="input-group">

                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    class="form-control rounded-start-3"
                    placeholder="Confirm password"
                    required
                    autocomplete="new-password">

                <button
                    class="btn btn-outline-secondary"
                    type="button"
                    id="toggleConfirmPassword">

                    <i class="fa fa-eye"></i>

                </button>

            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />

        </div>

        <!-- Submit Button -->
        <div class="d-grid">

            <button type="submit" class="btn btn-warning fw-bold py-2 rounded-3">

                Reset Password

            </button>

        </div>

    </form>

    <!-- Bootstrap Validation + Password Toggle -->
    <script>

        document.addEventListener("DOMContentLoaded", function () {

            // Bootstrap Validation
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

            // Toggle Password
            function togglePassword(inputId, buttonId) {

                const input = document.getElementById(inputId);
                const button = document.getElementById(buttonId);

                button.addEventListener('click', function () {

                    const type = input.getAttribute('type') === 'password'
                        ? 'text'
                        : 'password';

                    input.setAttribute('type', type);

                    this.innerHTML = type === 'password'
                        ? '<i class="fa fa-eye"></i>'
                        : '<i class="fa fa-eye-slash"></i>';

                });

            }

            togglePassword('password', 'togglePassword');
            togglePassword('password_confirmation', 'toggleConfirmPassword');

        });

    </script>

</x-guest-layout>

{{-- <form method="POST" action="/otp/reset">
    @csrf

    <input type="email" name="email" placeholder="Email">
    <input type="text" name="otp" placeholder="OTP">

    <input type="password" name="password" placeholder="New Password">
    <input type="password" name="password_confirmation" placeholder="Confirm Password">

    <button type="submit">Reset Password</button>
</form>

<form method="POST" action="/otp/send">
    @csrf
    <input type="email" name="email" placeholder="Enter email">
    <button type="submit">Send OTP</button>
</form> --}}