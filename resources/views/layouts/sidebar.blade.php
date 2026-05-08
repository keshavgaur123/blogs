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

    .sidenav a:hover,
    .sidenav a.active {
        background: #ffc107;
        color: #000;
    }

    .sidenav .collapse a {
        padding-left: 40px;
        font-size: 14px;
    }

    .main-content {
        margin-left: 240px;
        padding: -90px 25px 25px;
        transition: 0.3s;
    }

    .dashboard-card {
        border-radius: 12px;
        transition: 0.3s;
        cursor: pointer;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px #ffc107;
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
</style>

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-dark bg-black fixed-top px-3">
    <button class="btn btn-outline-light" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    {{-- <span class="navbar-brand ms-3 fw-bold">Admin Panel</span> --}}
    <span class="navbar-brand  mb-0">
        <img src="{{ asset('assets/images/nwgLOGO.jpg') }}" style="height:40px;  padding-left: 3.9rem;">
    </span>
    <div class="dropdown ms-auto">
        <button class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown">
            {{ Auth::user()->name ?? 'User' }}
        </button>

        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
                {{-- <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item">Logout</button>
                </form> --}}
                <a href="#" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- ================= SIDEBAR ================= -->
<div class="sidenav bg-black" id="sidebar">

    <a href="{{ route('dashboard') }}">
        <i class="fas fa-home"></i> <span>Dashboard</span>
    </a>

    <!-- CATEGORY -->
    {{-- <a data-bs-toggle="collapse" href="#catMenu">
        <i class="fas  fa-folder"></i> <span>Category</span>
    </a>
    <div id="catMenu" class="collapse">
        <a href="#"><i class="fas fa-plus"></i> <span>Add Category</span></a>
        <a href="#"><i class="fas fa-list"></i> <span>Manage Category</span></a>
    </div> --}}
    <a data-bs-toggle="collapse" href="#catMenu">
        <i class="fas fa-folder"></i> <span>Category</span>
    </a>
    <div id="catMenu" class="collapse">
        <a href="{{ route('categories.create') }}">
            <i class="fas fa-plus"></i> <span>Add Category</span>
        </a>
        <a href="{{ route('categories.index') }}">
            <i class="fas fa-list"></i> <span>Manage Category</span>
        </a>
    </div>

    <!-- BLOG -->
    {{-- <a data-bs-toggle="collapse" href="#blogMenu">
        <i class="fas fa-blog"></i> <span>Blog</span>
    </a>
    <div id="blogMenu" class="collapse">
        <a href="{{ route('blog.create') }}"><i class="fas fa-plus"></i> <span>Add Blog</span></a>
        <a href="{{ route('blog.index') }}"><i class="fas fa-list"></i> <span>Manage Blog</span></a>
    </div> --}}

    <a data-bs-toggle="collapse" href="#blogMenu">
        <i class="fas fa-blog"></i> <span>Blog</span>
    </a>

    {{-- <div id="blogMenu" class="collapse">
        <a href="{{ route('blog.create') }}">
            <i class="fas fa-plus"></i> <span>Add Blog</span>
        </a>

        <a href="{{ route('blog.index') }}">
            <i class="fas fa-list"></i> <span>Manage Blog</span>
        </a>
    </div> --}}

    <div id="blogMenu" class="collapse">

        <a href="{{ route('blogs.create') }}">
            <i class="fas fa-plus"></i> <span>Add Blog</span>
        </a>

        <a href="{{ route('blogs.index') }}">
            <i class="fas fa-list"></i> <span>Manage Blog</span>
        </a>

    </div>
    <!-- ENQUIRIES -->
    <a href="#">
        <i class="fas fa-envelope"></i> <span>Enquiries</span>
    </a>

</div>


{{--
<!-- CATEGORY -->

<a data-bs-toggle="collapse" href="#catMenu">
    <i class="fas fa-folder"></i> <span>Category</span>
</a>
<div id="catMenu" class="collapse">
    <a href="{{ route('categories.create') }}">
        <i class="fas fa-plus"></i> <span>Add Category</span>
    </a>
    <a href="{{ route('categories.index') }}">
        <i class="fas fa-list"></i> <span>Manage Category</span>
    </a>
</div>

<!-- BLOG -->
<a data-bs-toggle="collapse" href="#blogMenu">
    <i class="fas fa-blog"></i> <span>Blog</span>
</a>
<div id="blogMenu" class="collapse">
    <a href="{{ route('blogs.create') }}">
        <i class="fas fa-plus"></i> <span>Add Blog</span>
    </a>
    <a href="{{ route('   .index') }}">
        <i class="fas fa-list"></i> <span>Manage Blog</span>
    </a>
</div> --}}

<!-- ================= MAIN ================= -->

<script>
    function toggleSidebar() {
        document.body.classList.toggle('sidebar-collapsed');
    }
</script>

{{-- @endsection --}}