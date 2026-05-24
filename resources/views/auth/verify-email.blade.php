<x-guest-layout>

    <div class="space-y-6 text-center">

        <h1 class="text-2xl font-bold uppercase tracking-widest text-yellow-400">
            Verify Your Email
        </h1>

        <p class="text-sm text-yellow-100/70 leading-7">
            Before continuing, please verify your email address by clicking the link we just sent to your inbox.
            If you didn’t receive it, we will gladly send you another.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="rounded-xl border border-green-500/20 bg-green-500/10 p-4 text-green-300 text-sm">
                A new verification link has been sent to your email.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button type="submit"
                class="w-full rounded-xl bg-yellow-500 px-6 py-3 font-bold uppercase tracking-widest text-black hover:bg-yellow-400 transition">
                Resend Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="w-full rounded-xl border border-yellow-500/20 bg-black px-6 py-3 font-bold uppercase tracking-widest text-yellow-300 hover:bg-yellow-500/10">
                Logout
            </button>
        </form>

    </div>

</x-guest-layout>