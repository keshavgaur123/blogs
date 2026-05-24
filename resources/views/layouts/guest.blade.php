<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Wild Verify') }}</title>

    <meta name="theme-color" content="#000000">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-black text-white antialiased overflow-hidden font-['Inter']">

    {{-- Background --}}
    <div class="fixed inset-0">

        {{-- Background Image --}}
        <img
            src="https://images.unsplash.com/photo-1546182990-dffeafbe841d?q=80&w=2070&auto=format&fit=crop"
            class="h-full w-full object-cover opacity-[0.12]"
            alt="bg">

        {{-- Dark Overlay --}}
        <div class="absolute inset-0 bg-black/80"></div>

        {{-- Golden Ambient --}}
        <div
            class="absolute top-[-120px] left-[-120px] h-[350px] w-[350px] rounded-full bg-yellow-500/10 blur-3xl">
        </div>

    </div>

    {{-- Main --}}
    <main class="relative z-10 flex min-h-screen items-center justify-center px-5 py-10">

        {{-- Main Container --}}
        <div
            class="grid w-full max-w-6xl overflow-hidden rounded-[32px] border border-yellow-500/10 bg-zinc-950/80 shadow-2xl backdrop-blur-2xl lg:grid-cols-2">

            {{-- LEFT --}}
            <div
                class="relative hidden flex-col justify-between overflow-hidden border-r border-yellow-500/10 bg-gradient-to-br from-yellow-500/[0.05] to-transparent p-14 lg:flex">

                {{-- Logo --}}
                <div>

                    {{-- NatGeo Frame --}}
                    <div
                        class="flex h-24 w-24 items-center justify-center border-[7px] border-yellow-400">

                        <div class="h-10 w-10 rounded-full border-2 border-yellow-300">
                        </div>

                    </div>

                    {{-- Heading --}}
                    <div class="mt-14">

                        <h1
                            class="font-['Oswald'] text-7xl uppercase tracking-[0.18em] text-yellow-400">
                            Wild
                        </h1>

                        <h2
                            class="font-['Oswald'] text-7xl uppercase tracking-[0.18em] text-white">
                            Verify
                        </h2>

                    </div>

                    {{-- Divider --}}
                    <div class="mt-8 h-[3px] w-24 bg-yellow-500"></div>

                    {{-- Description --}}
                    <p
                        class="mt-10 max-w-md text-sm uppercase leading-8 tracking-[0.28em] text-yellow-100/50">

                        National Geographic inspired
                        authentication experience
                        designed for modern Laravel apps.

                    </p>

                </div>

                {{-- Bottom --}}
                <div>

                    <div
                        class="h-px w-full bg-gradient-to-r from-transparent via-yellow-500/40 to-transparent">
                    </div>

                    <div
                        class="mt-5 flex justify-between text-[11px] uppercase tracking-[0.3em] text-yellow-500/40">

                        <span>Explore</span>
                        <span>Discover</span>
                        <span>Verify</span>

                    </div>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="flex items-center justify-center p-6 sm:p-10 lg:p-16">

                <div class="w-full max-w-md">

                    {{-- Mobile Logo --}}
                    <div class="mb-12 text-center lg:hidden">

                        <div
                            class="mx-auto flex h-20 w-20 items-center justify-center border-[6px] border-yellow-400">

                            <div class="h-8 w-8 rounded-full border-2 border-yellow-300">
                            </div>

                        </div>

                        <h1
                            class="mt-6 font-['Oswald'] text-5xl uppercase tracking-[0.18em] text-yellow-400">
                            Wild Verify
                        </h1>

                    </div>

                    {{-- Auth Card --}}
                    <div
                        class="rounded-[28px] border border-yellow-500/10 bg-black/40 p-8 shadow-[0_0_40px_rgba(234,179,8,0.05)] backdrop-blur-xl">

                        {{ $slot }}

                    </div>

                    {{-- Footer --}}
                    <div class="mt-8 text-center">

                        <p
                            class="text-[11px] uppercase tracking-[0.35em] text-yellow-500/40">

                            Protected Wilderness Authentication System

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </main>

</body>

</html>