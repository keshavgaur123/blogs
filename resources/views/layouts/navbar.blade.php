{{-- @php
use Illuminate\Support\Facades\Route;
$currentRoute = Route::currentRouteName() ?? '';
@endphp

<style>
    /* push content below fixed navbar */
    body {
        padding-top: 75px;
        background: #f4f6f9;
    }

    .navbar {
        background: #000000 !important;
    }

    .navbar-brand img {
        height: 45px;
    }

    .nav-link {
        color: #facc15 !important;
        /* yellow */
        margin: 0 6px;
        padding: 6px 10px;
        border-radius: 6px;
        transition: 0.3s ease;
    }

    .nav-link:hover {
        color: #fff !important;
        background: rgba(255, 255, 255, 0.1);
    }

    .nav-link.active {
        color: #fff !important;
        font-weight: 600;
        background: rgba(255, 255, 255, 0.15);
    }

    .dropdown-menu {
        border-radius: 10px;
        border: none;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .dropdown-item:hover {
        background: #facc15;
        color: #000;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-black fixed-top shadow-sm">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/images/nwgLOGO.jpg') }}" alt="Logo">
        </a>

        <!-- MOBILE TOGGLE -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link {{ $currentRoute === 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $currentRoute === 'about' ? 'active' : '' }}" href="{{ route('about') }}">
                        About
                    </a>
                </li>

                <!-- BLOG DROPDOWN -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ $currentRoute === 'blogs' ? 'active' : '' }}"
                        href="{{ route('blogs') }}" data-bs-toggle="dropdown">
                        Blog
                    </a>

                    <ul class="dropdown-menu" id="categoriesDropdown">
                        <li>
                            <span class="dropdown-item text-muted">Loading...</span>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#contactModal">
                        Contact
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $currentRoute === 'login' ? 'active' : '' }}" href="{{ route('login') }}">
                        Login
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $currentRoute === 'register' ? 'active' : '' }}"
                        href="{{ route('register') }}">
                        Register
                    </a>
                </li>

            </ul>
        </div>

    </div>
</nav>

<!-- Bootstrap JS (ONLY ONCE IN LAYOUT) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- YOUR EXISTING JS (UNCHANGED LOGIC) -->
<script>
    document.addEventListener("DOMContentLoaded", function () {

        const dropdown = document.getElementById('categoriesDropdown');
        if (!dropdown) return;

        fetch("{{ url('/admin/api/navfetch.php') }}")
            .then(res => res.json())
            .then(data => {

                const categories = Array.isArray(data) ? data : data.categories;

                dropdown.innerHTML = '';

                if (!categories || categories.length === 0) {
                    dropdown.innerHTML =
                        '<li><span class="dropdown-item text-muted">No categories</span></li>';
                    return;
                }

                categories.forEach(cat => {
                    const li = document.createElement('li');

                    const a = document.createElement('a');
                    a.className = 'dropdown-item';
                    a.href = "{{ route('blogs') }}" + "?category=" + cat.id;
                    a.textContent = cat.name;

                    li.appendChild(a);
                    dropdown.appendChild(li);
                });

            })
            .catch(() => {
                dropdown.innerHTML =
                    '<li><span class="dropdown-item text-danger">Error loading</span></li>';
            });

    });
</script> --}}

{{-- <nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Left side -->
            <div class="flex items-center space-x-6">
                <a href="/" class="text-xl font-bold text-gray-800">
                    MyBlog
                </a>

                <a href="/" class="text-gray-600 hover:text-black">Home</a>
                <a href="/posts" class="text-gray-600 hover:text-black">Posts</a>
                <a href="/about" class="text-gray-600 hover:text-black">About</a>
            </div>

            <!-- Right side -->
            <div class="flex items-center space-x-4">

                @auth
                <span class="text-gray-600">
                    {{ Auth::user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-500 hover:text-red-700">
                        Logout
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-black">
                    Login
                </a>

                <a href="{{ route('register') }}" class="bg-blue-500 text-white px-3 py-1 rounded">
                    Register
                </a>
                @endauth

            </div>

        </div>
    </div>
</nav> --}}

{{--
@php
use Illuminate\Support\Facades\Route;
$currentRoute = Route::currentRouteName() ?? '';
@endphp

<style>
    body {
        padding-top: 75px;
        background: #f4f6f9;
    }

    /* navbar background */
    .custom-navbar {
        background-color: #000 !important;
    }

    /* force nav link color */
    .custom-navbar .navbar-nav .nav-link {
        color: #facc15 !important;
        margin: 0 6px;
        padding: 6px 10px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    /* hover */
    .custom-navbar .navbar-nav .nav-link:hover {
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.1);
    }

    /* active */
    .custom-navbar .navbar-nav .nav-link.active {
        color: #ffffff !important;
        font-weight: 600;
        background: rgba(255, 255, 255, 0.15);
    }

    /* dropdown */
    .custom-navbar .dropdown-menu {
        border-radius: 10px;
        border: none;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .custom-navbar .dropdown-item:hover {
        background: #facc15;
        color: #000;
    }

    /* mobile toggle fix */
    .navbar-toggler {
        border-color: rgba(255, 255, 255, 0.2);
    }

    .navbar-toggler-icon {
        filter: invert(1);
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/images/nwgLOGO.jpg') }}" height="45">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/about">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/blogs">Blog</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/contact">Contact</a>
                </li>

                @auth
                <li class="nav-item">
                    <span class="nav-link text-white">{{ Auth::user()->name }}</span>
                </li>

                <li class="nav-item">
                    <form method="POST" action="/logout">
                        @csrf
                        <button class="nav-link border-0 bg-transparent">Logout</button>
                    </form>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/register">Register</a>
                </li>
                @endauth

            </ul>
        </div>

    </div>
</nav> --}}

@php
    $current = request()->path();
@endphp

<style>
    body {
        padding-top: 75px;
        background: #f4f6f9;
    }

    .custom-navbar {
        background-color: #000 !important;
    }

    .custom-navbar .navbar-nav .nav-link {
        color: #facc15 !important;
        font-size: 20px;
        margin: 0 6px;
        padding: 6px 10px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    /* hover */
    .custom-navbar .navbar-nav .nav-link:hover {
        color: #fff !important;
        background: rgba(255, 255, 255, 0.1);
    }

    /* active */
    .custom-navbar .navbar-nav .nav-link.active {
        color: #fff !important;
        font-weight: 600;
        background: rgba(255, 255, 255, 0.15);
    }

    .navbar-toggler {
        border-color: rgba(255, 255, 255, 0.2);
    }



    .navbar-toggler-icon {
        filter: invert(1);
    }

    .user-name {
        color: green !important;
        /* yellow */
        font-weight: 600;
    }

    .logout-btn {
        color: #fff !important;
        background: #dc3545;
        /* Bootstrap danger */
        border-radius: 6px;
        padding: 6px 12px;
        transition: 0.3s;
    }

    .logout-btn:hover {
        background: #bb2d3b;
        color: #fff;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/images/nwgLOGO.jpg') }}" height="45px">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">&#9776;
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link {{ $current == '/' ? 'active' : '' }}" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $current == 'about' ? 'active' : '' }}" href="/about">About</a>
                </li>
                {{--
                <li class="nav-item">
                    <a class="nav-link  {{ str_contains($current, 'blogs') ? 'active' : '' }}" href="/blogs">
                        Blog
                    </a>
                </li> --}}

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ $current === 'blogs' ? 'active' : '' }}"
                        href="{{ route('blogs') }}" data-bs-toggle="dropdown">
                        Blog
                    </a>

                    <ul class="dropdown-menu" id="categoriesDropdown">
                        <li><span class="dropdown-item text-muted">Loading...</span></li>
                    </ul>
                </li>

                <li class="nav-item">



                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal">
                        Contact Us
                    </button>
                </li>


                @auth
                    {{-- <li class="nav-item">
                        <span class="nav-link name">{{ Auth::user()->name }}</span>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="/logout">
                            @csrf
                            <button class="nav-link border-0 bg-red">Logout</button>
                        </form>
                    </li> --}}

                    <li class="nav-item">
                        <span class="nav-link user-name">
                            {{ Auth::user()->name }}
                        </span>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="nav-link logout-btn border-0 ">
                                Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ $current == 'login' ? 'active' : '' }}" href="/login">
                            Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ $current == 'register' ? 'active' : '' }}" href="/register">
                            Register
                        </a>
                    </li>
                @endauth

            </ul>
        </div>

    </div>
</nav>

<!-- Categories JS -->
<script>
    // document.addEventListener("DOMContentLoaded", function () {

    //     const dropdown = document.getElementById('categoriesDropdown');

    //     fetch("{{ url('/admin/api/navfetch.php') }}")
    //         .then(res => res.json())
    //         .then(data => {

    //             const categories = Array.isArray(data) ? data : data.categories;

    //             dropdown.innerHTML = '';

    //             if (!categories || categories.length === 0) {
    //                 dropdown.innerHTML =
    //                     '<li><span class="dropdown-item text-muted">No categories</span></li>';
    //                 return;
    //             }

    //             categories.forEach(cat => {
    //                 const li = document.createElement('li');

    //                 const a = document.createElement('a');
    //                 a.className = 'dropdown-item';
    //                 a.href = "{{ route('blogs') }}?category=" + cat.id;
    //                 a.textContent = cat.name;

    //                 li.appendChild(a);
    //                 dropdown.appendChild(li);
    //             });

    //         })
    //         .catch(() => {
    //             dropdown.innerHTML =
    //                 '<li><span class="dropdown-item text-danger">Error loading</span></li>';
    //         });

    // });
</script>