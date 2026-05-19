@php
    $current = request()->path();
@endphp

<style>
    body {
        padding-top: 75px;
        background: #f4f6f9;
    }

    /*
    |--------------------------------------------------------------------------
    | NAVBAR
    |--------------------------------------------------------------------------
    */

    .custom-navbar {
        background: #000 !important;
        padding: 10px 0;
    }

    .custom-navbar .navbar-nav .nav-link {
        color: #facc15 !important;
        font-size: 18px;
        margin: 0 6px;
        padding: 8px 14px;
        border-radius: 6px;
        transition: 0.3s ease;
    }

    .custom-navbar .navbar-nav .nav-link:hover {
        color: #fff !important;
        background: rgba(255, 255, 255, 0.1);
    }

    .custom-navbar .navbar-nav .nav-link.active {
        color: #fff !important;
        font-weight: 600;
        background: rgba(255, 255, 255, 0.15);
    }

    .navbar-toggler {
        border-color: rgba(255, 255, 255, 0.3);
    }

    .navbar-toggler-icon {
        filter: invert(1);
    }

    /*
    |--------------------------------------------------------------------------
    | DROPDOWN
    |--------------------------------------------------------------------------
    */

    .dropdown-menu {
        border: 0;
        border-radius: 10px;
        padding: 8px 0;
        min-width: 240px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .dropdown-item {
        padding: 10px 16px;
        font-size: 15px;
        transition: 0.3s;
    }

    .dropdown-item:hover {
        background: #f1f5f9;
        color: #000;
    }

    /*
|--------------------------------------------------------------------------
| DROPDOWN HOVER (WARNING STYLE)
|--------------------------------------------------------------------------
*/

    .dropdown-menu .dropdown-item:hover {
        background-color: #ffc107 !important;
        /* Bootstrap warning */
        color: #000 !important;
        /* black text */
    }

    /* optional: smoother feel */
    .dropdown-menu .dropdown-item {
        transition: 0.2s ease;
    }

    /*
    |--------------------------------------------------------------------------
    | SUBMENU
    |--------------------------------------------------------------------------
    */

    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu>.submenu {
        display: none;
        position: absolute;
        top: 0;
        left: 100%;
        margin-left: 2px;
        min-width: 220px;
        background: #fff;
        border-radius: 10px;
        padding: 8px 0;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .dropdown-submenu:hover>.submenu {
        display: block;
    }

    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */

    .user-name {
        color: #22c55e !important;
        font-weight: 600;
    }

    .logout-btn {
        color: #fff !important;
        background: #dc3545;
        border-radius: 6px;
        padding: 8px 14px;
        transition: 0.3s;
    }

    .logout-btn:hover {
        background: #bb2d3b;
        color: #fff !important;
    }

    /*
    |--------------------------------------------------------------------------
    | MOBILE
    |--------------------------------------------------------------------------
    */

    @media (max-width: 991px) {

        .dropdown-submenu>.submenu {
            position: relative;
            left: 0;
            top: 0;
            width: 100%;
            margin-top: 5px;
        }

        .dropdown-submenu:hover>.submenu {
            display: block;
        }

        .navbar-nav .nav-item {
            margin-bottom: 8px;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">

    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('assets/images/nwgLOGO.jpg') }}" height="45">
        </a>

        <!-- MOBILE BUTTON -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- NAVBAR -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">

            <ul class="navbar-nav align-items-lg-center">

                <!-- HOME -->
                <li class="nav-item">

                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">

                        Home

                    </a>

                </li>

                <!-- ABOUT -->
                <li class="nav-item">

                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('/about') }}">

                        About

                    </a>

                </li>

                <!-- BLOG -->

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle {{ request()->is('category*') ? 'active' : '' }}" href="#"
                        role="button" data-bs-toggle="dropdown">

                        Blog

                    </a>

                    <ul class="dropdown-menu">

                        @foreach($navbarCategories as $category)

                            <li class="dropdown-submenu">

                                <!-- PARENT CATEGORY -->
                                <a class="dropdown-item" href="{{ url('/category/' . $category->slug . '/blogs') }}">

                                    {{ $category->name }}

                                </a>

                                <!-- CHILD CATEGORIES -->
                                @if($category->children->count())

                                    <ul class="dropdown-menu  submenu">

                                        @foreach($category->children as $child)

                                            <li>
                                                <a class="dropdown-item" href="{{ url('/category/' . $child->slug . '/blogs') }}">

                                                    {{ $child->name }}

                                                </a>
                                            </li>

                                        @endforeach

                                    </ul>

                                @endif

                            </li>

                        @endforeach

                    </ul>

                </li>




                <!-- CONTACT -->
                <li class="nav-item ms-lg-2">

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal">

                        Contact Us

                    </button>

                </li>

                <!-- AUTH -->
                @auth

                    <li class="nav-item ms-lg-3">

                        <span class="nav-link user-name">

                            {{ Auth::user()->name }}

                        </span>

                    </li>

                    <li class="nav-item">

                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <button type="submit" class="nav-link border-0 logout-btn">

                                Logout

                            </button>

                        </form>

                    </li>

                @else

                    <li class="nav-item">

                        <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">

                            Login

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link {{ request()->is('register') ? 'active' : '' }}" href="{{ route('register') }}">

                            Register

                        </a>

                    </li>

                @endauth

            </ul>

        </div>

    </div>

</nav>