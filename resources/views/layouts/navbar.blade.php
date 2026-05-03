@php
    $currentRoute = Route::currentRouteName() ?? '';
@endphp

<!-- Bootstrap CSS -->
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

<style>
    body {
        padding-top: 70px;
    }

    .navbar-nav .nav-link {
        color: yellow !important;
        transition: 0.3s;
        border-radius: 6px;
        padding: 6px 10px;
    }

    .navbar-nav .nav-link:hover {
        color: white !important;
        background: rgba(255,255,255,0.1);
    }

    .navbar-nav .nav-link.active {
        color: white !important;
        font-weight: bold;
    }

    #categoriesDropdown .dropdown-item {
        color: black;
        transition: 0.3s;
    }

    #categoriesDropdown .dropdown-item:hover {
        background-color: #ffd700 !important;
        color: black !important;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-black fixed-top">
    <div class="container">

        <!-- Logo -->
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/images/nwgLOGO.jpg') }}" style="height:50px;">
        </a>

        <!-- Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav gap-1">

                <li class="nav-item">
                    <a class="nav-link {{ $currentRoute === 'home' ? 'active' : '' }}"
                       href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $currentRoute === 'about' ? 'active' : '' }}"
                       href="{{ route('about') }}">About</a>
                </li>

                <!-- Blog Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ $currentRoute === 'blogs' ? 'active' : '' }}"
                       href="{{ route('blogs') }}"
                       data-bs-toggle="dropdown">
                        Blog
                    </a>

                    <ul class="dropdown-menu" id="categoriesDropdown">
                        <li><span class="dropdown-item text-muted">Loading...</span></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="#"
                       data-bs-toggle="modal"
                       data-bs-target="#contactModal">
                        Contact
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $currentRoute === 'login' ? 'active' : '' }}"
                       href="{{ route('login') }}">
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

<!-- Bootstrap JS -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}

<!-- Categories JS (YOUR LOGIC KEPT, ONLY SAFETY FIXED) -->
<script>
// document.addEventListener("DOMContentLoaded", function () {

//     const dropdown = document.getElementById('categoriesDropdown');
//     if (!dropdown) return;

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
//                 a.href = "{{ route('blogs') }}" + "?category=" + encodeURIComponent(cat.id);
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