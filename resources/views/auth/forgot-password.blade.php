<x-guest-layout>

    <h2 class="auth-title">
        Forgot Password
    </h2>

    <p class="auth-subtitle">

        Forgot your password? No problem.

        Just let us know your email address and we will email you
        a password reset link that will allow you to choose a new one.

    </p>

    {{-- Session Status --}}
    @if (session('status'))

        <div class="alert alert-success rounded-3">

            {{ session('status') }}

        </div>

    @endif

    <form method="POST" action="{{ route('password.email') }}">

        @csrf

        {{-- Email Address --}}
        <div class="mb-4">

            <label for="email" class="form-label">

                Email

            </label>

            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="form-control" placeholder="Enter your email address">

            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />

        </div>

        {{-- Submit Button --}}
        <div class="d-grid">

            <button type="submit" class="btn btn-warning btn-auth">

                <i class="fa-solid fa-paper-plane me-2"></i>

                Email Password Reset Link

            </button>

        </div>

    </form>

</x-guest-layout>



{{-- <form method="POST" action="/otp/send">
    @csrf
    <input type="email" name="email" placeholder="Enter email">
    <button type="submit">Send OTP</button>
</form> --}}