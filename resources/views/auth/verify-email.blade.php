    <x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-black relative overflow-hidden px-4 py-10">

        {{-- Animated Background Glow --}}
        <div class="absolute top-0 left-0 w-96 h-96 bg-yellow-500/20 blur-3xl rounded-full animate-pulse">
        </div>

        <div class="absolute bottom-0 right-0 w-[30rem] h-[30rem] bg-amber-600/10 blur-3xl rounded-full animate-pulse">
        </div>

        {{-- Grid Overlay --}}
        <div
            class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.03)_1px,transparent_1px)] bg-[size:40px_40px]">
        </div>

        {{-- Main Card --}}
        <div
            class="relative w-full max-w-lg overflow-hidden rounded-3xl border border-yellow-500/20 bg-zinc-950/90 backdrop-blur-xl shadow-[0_0_50px_rgba(234,179,8,0.15)]">

            {{-- Golden Border Glow --}}
            <div class="absolute inset-0 rounded-3xl border border-yellow-400/10 pointer-events-none">
            </div>

            {{-- Hero Header --}}
            <div class="relative overflow-hidden">

                {{-- Header Background --}}
                <div class="absolute inset-0 bg-gradient-to-r from-yellow-500 via-amber-400 to-yellow-600">
                </div>

                {{-- Texture --}}
                <div
                    class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/asfalt-dark.png')]">
                </div>

                {{-- Decorative Circle --}}
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl">
                </div>

                <div class="relative z-10 px-8 py-10 text-black">

                    {{-- Icon --}}
                    <div
                        class="w-16 h-16 rounded-2xl bg-black/20 flex items-center justify-center backdrop-blur-sm shadow-lg mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-black" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 12H8m8 0H8m8 0a4 4 0 100-8H8a4 4 0 000 8m8 0a4 4 0 110 8H8a4 4 0 010-8" />
                        </svg>
                    </div>

                    <h1 class="text-4xl font-black uppercase tracking-[0.2em] leading-tight">
                        Wild Verify
                    </h1>

                    <div class="w-20 h-1 bg-black/70 rounded-full mt-4"></div>

                    <p class="mt-5 text-sm font-semibold tracking-[0.15em] uppercase text-black/80">
                        National Geographic Inspired Security Portal
                    </p>

                </div>
            </div>

            {{-- Content --}}
            <div class="relative px-8 py-8">

                {{-- Notification Card --}}
                <div class="relative mb-8 overflow-hidden rounded-2xl border border-yellow-500/20 bg-yellow-500/5 p-5">

                    <div class="absolute top-0 left-0 w-1 h-full bg-yellow-500">
                    </div>

                    <p class="text-sm leading-7 text-gray-300">
                        {{ __('Thanks for signing up! Before entering the wild, verify your email address by clicking the link we just sent you. Didn’t receive it? No worries — we can send another instantly.') }}
                    </p>
                </div>

                {{-- Success Alert --}}
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 flex items-center gap-3 rounded-2xl border border-green-500/20 bg-green-500/10 p-4">

                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-500/20">
                            ✓
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-green-400">
                                Verification Email Sent
                            </p>

                            <p class="text-xs text-green-300/70 mt-1">
                                A fresh verification link has been delivered.
                            </p>
                        </div>
                    </div>
                @endif

                {{-- Action Buttons --}}
                <div class="space-y-4">

                    {{-- Resend Button --}}
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <button type="submit"
                            class="group relative w-full overflow-hidden rounded-2xl bg-gradient-to-r from-yellow-500 via-amber-400 to-yellow-600 px-6 py-4 text-sm font-black uppercase tracking-[0.15em] text-black shadow-lg transition-all duration-500 hover:scale-[1.02] hover:shadow-yellow-500/40">

                            <span
                                class="absolute inset-0 bg-white/20 opacity-0 transition-opacity duration-500 group-hover:opacity-100">
                            </span>

                            <span class="relative z-10">
                                Resend Verification Email
                            </span>
                        </button>
                    </form>

                    {{-- Logout --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                            class="w-full rounded-2xl border border-zinc-700 bg-zinc-900/80 px-6 py-4 text-sm font-bold uppercase tracking-[0.15em] text-gray-300 transition-all duration-300 hover:border-yellow-500/40 hover:bg-zinc-800 hover:text-yellow-400">
                            Log Out
                        </button>
                    </form>

                </div>

                {{-- Footer --}}
                <div class="mt-10 text-center">

                    <div class="mx-auto mb-4 h-px w-24 bg-gradient-to-r from-transparent via-yellow-500 to-transparent">
                    </div>

                    <p class="text-xs uppercase tracking-[0.35em] text-yellow-500/70">
                        Explore • Discover • Verify
                    </p>

                    <p class="mt-3 text-[11px] text-zinc-500">
                        Protected wilderness authentication system
                    </p>

                </div>

            </div>
        </div>
    </div>
</x-guest-layout>