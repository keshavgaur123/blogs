@php
    $currentRoute = Route::currentRouteName();
@endphp

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .navbar-nav .nav-link {
        color: yellow !important;
        transition: 0.3s;
    }

    .navbar-nav .nav-link:hover {
        color: white !important;
    }

    .navbar-nav .nav-link.active {
        color: white !important;
        font-weight: bold;
    }

    #categoriesDropdown .dropdown-item {
        color: black;
        transition: 0.3s;
    }

    #categoriesDropdown .dropdown-item:hover,
    #categoriesDropdown .dropdown-item.selected {
        background-color: #ffd700 !important;
        color: black !important;
        font-weight: bold;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-black fixed-top">
    <div class="container">

        <!-- Logo -->
 <img src="{{ asset('../public/assets/images/nwgLOGO.jpg') }}" 
     alt="Logo"
     style="height:50px;">
        <!-- Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link {{ $currentRoute === 'home' ? 'active' : '' }}"
                       href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $currentRoute === 'about' ? 'active' : '' }}"
                       href="{{ route('about') }}">
                        About
                    </a>
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
                        Contact Us
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Categories JS -->
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
</script>