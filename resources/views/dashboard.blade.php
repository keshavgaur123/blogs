{{-- 
@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
body {
    margin: 0;
    background: #f4f6f9;
}

/* ===== NAVBAR ===== */
.navbar {
    z-index: 1000;
}

/* ===== SIDEBAR ===== */
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

/* ===== MAIN ===== */
.main-content {
    margin-left: 240px;
    padding: 90px 25px 25px;
    transition: 0.3s;
}

/* ===== CARDS ===== */
.dashboard-card {
    border-radius: 12px;
    transition: 0.3s;
    cursor: pointer;
}

.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

/* ===== SIDEBAR COLLAPSE ===== */
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

    <span class="navbar-brand ms-3 fw-bold">Admin Panel</span>

    <div class="dropdown ms-auto">
        <button class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown">
            {{ Auth::user()->name ?? 'User' }}
        </button>

        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<!-- ================= SIDEBAR ================= -->
<div class="sidenav bg-black" id="sidebar">

    <a href="{{ route('home') }}" class="active">
        <i class="fas fa-home"></i> <span>Dashboard</span>
    </a>

    <!-- CATEGORY -->
    <a data-bs-toggle="collapse" href="#catMenu">
        <i class="fas fa-folder"></i> <span>Category</span>
    </a>
    <div id="catMenu" class="collapse">
        <a href="#"><i class="fas fa-plus"></i> <span>Add Category</span></a>
        <a href="#"><i class="fas fa-list"></i> <span>Manage Category</span></a>
    </div>

    <!-- BLOG -->
    <a data-bs-toggle="collapse" href="#blogMenu">
        <i class="fas fa-blog"></i> <span>Blog</span>
    </a>
    <div id="blogMenu" class="collapse">
        <a href="#"><i class="fas fa-plus"></i> <span>Add Blog</span></a>
        <a href="#"><i class="fas fa-list"></i> <span>Manage Blog</span></a>
    </div>

    <!-- ENQUIRIES -->
    <a href="#">
        <i class="fas fa-envelope"></i> <span>Enquiries</span>
    </a>

</div>

<!-- ================= MAIN ================= -->
<div class="main-content">

    <h2 class="fw-bold mb-4">Dashboard</h2>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card bg-black text-info text-center p-4 dashboard-card">
                <i class="fas fa-blog fa-2x mb-2"></i>
                <h6>Total Blogs</h6>
                <h4>10</h4>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-black text-danger text-center p-4 dashboard-card">
                <i class="fas fa-folder fa-2x mb-2"></i>
                <h6>Total Categories</h6>
                <h4>5</h4>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-black text-success text-center p-4 dashboard-card">
                <i class="fas fa-envelope fa-2x mb-2"></i>
                <h6>Total Contact</h6>
                <h4>20</h4>
            </div>
        </div>

    </div>

</div>

<script>
function toggleSidebar() {
    document.body.classList.toggle('sidebar-collapsed');
}
</script>

@endsection --}}

@extends('layouts.dashboard-layout')

@section('title','Dashboard')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Dashboard</h2>
  </div>

  <div class="row g-4">
    <div class="col-md-4">
      <div class="card bg-black text-info text-center p-4 dashboard-card">
        <i class="fas fa-blog fa-2x mb-2"></i>
        <h6>Total Blogs</h6>
        {{-- <h4>{{ $postsCount }}</h4> --}}
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-black text-danger text-center p-4 dashboard-card">
        <i class="fas fa-folder fa-2x mb-2"></i>
        <h6>Total Categories</h6>
        {{-- <h4>{{ $categoriesCount }}</h4> --}}
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-black text-success text-center p-4 dashboard-card">
        <i class="fas fa-envelope fa-2x mb-2"></i>
        <h6>Total Contact</h6>
        {{-- <h4>{{ $contactsCount }}</h4> --}}
      </div>
    </div>
  </div>
@endsection
