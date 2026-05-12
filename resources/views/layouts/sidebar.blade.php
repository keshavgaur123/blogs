<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
    body {
        margin: 0;
        background: #f4f6f9;
    }

    .navbar {
        z-index: 1000;
    }

    .sidenav {
        width: 240px;
        height: 100vh;
        position: fixed;
        top: 56px;
        left: 0;
        background: #111;
        padding-top: 20px;
        transition: 0.3s;
    }

    .sidenav a {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #ccc;
        padding: 12px 20px;
        text-decoration: none;
        transition: 0.2s;
    }

    .sidenav a:hover {
        background: #ffc107;
        color: #000;
    }

    .sidenav a.active {
        background: #ffc107;
        color: #000;
        font-weight: 600;
    }

    .sidenav .collapse a {
        padding-left: 40px;
        font-size: 14px;
    }



    .main-content {
        margin-left: 240px;
        padding: 70px 25px 25px;
        /* FIX TOP GAP */
        transition: 0.3s;
    }

    .sidebar-collapsed .sidenav {
        width: 70px;
    }

    .sidebar-collapsed .sidenav a span {
        display: none;
    }

    .sidebar-collapsed .main-content {
        margin-left: 70px;
    }

    /* ICON SPECIFIC COLORS */
    .fa-home {
        color: #17a2b8;
        /* blue */
    }

    .fa-folder {
        color: #28a745;
        /* green */
    }

    .fa-blog {
        color: #6f42c1;
        /* purple */
    }

    .fa-list {
        color: #fd7e14;
        /* orange */
    }

    .fa-envelope {
        color: #dc3545;
        /* red */
    }

    /* Smooth dropdown items */
    .dropdown-menu {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        padding: 5px 0;
    }

    /* Dropdown item base */
    .dropdown-menu .dropdown-item {
        transition: all 0.2s ease-in-out;
        padding: 8px 15px;
    }

    /* Hover effect */
    .dropdown-menu .dropdown-item:hover {
        background-color: #ffc107 !important;
        /* Bootstrap yellow */
        color: #000 !important;
    }

    /* Optional: active/selected state */
    .dropdown-menu .dropdown-item:active {
        background-color: #e0a800 !important;
        color: #fff !important;
    }
</style>

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-dark bg-black fixed-top px-3">

    <button class="btn btn-outline-light" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <span class="navbar-brand mb-0">
        <img src="{{ asset('assets/images/nwgLOGO.jpg') }}" style="height:40px; padding-left: 15px;">
    </span>

    <div class="dropdown  ms-auto">
        <button class="btn btn-warning  dropdown-toggle" data-bs-toggle="dropdown">
            {{ Auth::user()->name ?? 'User' }}
        </button>

        <ul class="dropdown-menu   dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
                <a href="#" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    Logout
                </a>
            </li>
        </ul>
    </div>

</nav>

<!-- ================= SIDEBAR ================= -->
<div class="sidenav bg-black" id="sidebar">

    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="fas fa-home"></i> <span>Dashboard</span>
    </a>

    <!-- CATEGORY -->
    <a data-bs-toggle="collapse" href="#catMenu"
        aria-expanded="{{ request()->routeIs('categories.*') ? 'true' : 'false' }}"
        class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
        <i class="fas fa-folder"></i> <span>Category</span>
    </a>

    <div id="catMenu" class="collapse {{ request()->routeIs('categories.*') ? 'show' : '' }}">

        <a href="{{ route('categories.create') }}"
            class="{{ request()->routeIs('categories.create') ? 'active' : '' }}">
            <i class="fas fa-plus"></i> <span>Add Category</span>
        </a>

        <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">
            <i class="fas fa-list"></i> <span>Manage Category</span>
        </a>

    </div>

    <!-- BLOG -->
    <a data-bs-toggle="collapse" href="#blogMenu" aria-expanded="{{ request()->routeIs('blogs.*') ? 'true' : 'false' }}"
        class="{{ request()->routeIs('blogs.*') ? 'active' : '' }}">
        <i class="fas fa-blog"></i> <span>Blog</span>
    </a>

    <div id="blogMenu" class="collapse {{ request()->routeIs('blogs.*') ? 'show' : '' }}">

        <a href="{{ route('blogs.create') }}" class="{{ request()->routeIs('blogs.create') ? 'active' : '' }}">
            <i class="fas fa-plus"></i> <span>Add Blog</span>
        </a>

        <a href="{{ route('blogs.index') }}" class="{{ request()->routeIs('blogs.index') ? 'active' : '' }}">
            <i class="fas fa-list"></i> <span>Manage Blog</span>
        </a>

    </div>

    <!-- ENQUIRIES -->
    <a href="#">
        <i class="fas fa-envelope"></i> <span>Enquiries</span>
    </a>

</div>

<!-- ================= SCRIPT ================= -->
<script>
    function toggleSidebar() {
        document.body.classList.toggle('sidebar-collapsed');
    }
</script>