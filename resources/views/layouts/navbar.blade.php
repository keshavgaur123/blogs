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
                    <a class="nav-link dropdown-toggle {{ $current === 'blogs' ? 'active' : '' }}" href="#"
                        data-bs-toggle="dropdown">
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
{{--
<script>
    document.addEventListener("DOMContentLoaded", function () {

        const dropdown = document.getElementById('categoriesDropdown');

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
                    a.href = "{{ route('blogs') }}?category=" + cat.id;
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