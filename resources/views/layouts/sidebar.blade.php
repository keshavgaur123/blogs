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

    /* Dropdown container */
    .dropdown-menu {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        padding: 6px 0;
        border: none;
    }

    /* Dropdown item */
    .dropdown-menu .dropdown-item {
        padding: 8px 15px;
        transition: all 0.2s ease-in-out;
        color: #212529;
    }

    /* Hover effect */
    .dropdown-menu .dropdown-item:hover {
        background-color: #ffc107 !important;
        color: #000 !important;
    }

    /* Active (clicked) state */
    .dropdown-menu .dropdown-item:active {
        background-color: #e0a800 !important;
        color: #000 !important;
    }

    /* Divider clean look */
    .dropdown-menu .dropdown-divider {
        margin: 5px 0;
        border-color: rgba(0, 0, 0, 0.1);
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




    @php
        $user = auth()->user();

        $notifications = $user->notifications()
            ->latest()
            ->take(5)
            ->get();

        $unreadCount = $user->unreadNotifications()->count();
    @endphp

    <!-- NOTIFICATION ICON -->
    <div class="dropdown ms-auto me-3">

        <a href="#" class="nav-link text-white position-relative" id="notifDropdown" data-bs-toggle="dropdown"
            aria-expanded="false">

            <i class="fas fa-bell fa-lg"></i>

            @if($unreadCount > 0)
                <span
                    class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                </span>
            @endif

        </a>

        <!-- DROPDOWN -->
        <ul class="dropdown-menu dropdown-menu-end shadow" style="width: 320px;">

            <!-- HEADER -->
            <li class="px-3 py-2 border-bottom d-flex justify-content-between align-items-center">

                <strong>Notifications</strong>

                @if($unreadCount > 0)
                    <form method="POST" action="{{ route('notifications.readAll') }}">
                        @csrf

                        <button type="submit" class="btn btn-sm btn-link p-0 text-decoration-none">
                            Mark all read
                        </button>
                    </form>
                @endif

            </li>

            <!-- NOTIFICATIONS -->
            @forelse($notifications as $notification)

                {{-- @php
                $profilePhoto = $notification->data['profile_photo'] ?? null;

                $imageUrl = $profilePhoto
                ? asset('storage/' . $profilePhoto)
                : asset('assets/images/profile.jpg');
                @endphp --}}

                @php
                    $profilePhoto = $notification->data['profile_photo'] ?? null;

                    $imageUrl = $profilePhoto
                        ? asset('storage/' . $profilePhoto)
                        : 'https://cdn-icons-png.flaticon.com/512/149/149071.png';
                @endphp

                <li>

                    {{-- <a href="#" class="dropdown-item d-flex align-items-start gap-2 py-2"> --}}

                        <a href="{{ route('notifications.open', $notification->id) }}"
                            class="dropdown-item d-flex align-items-start gap-2 py-2">

                            <!-- USER IMAGE -->
                            <img src="{{ $imageUrl }}" alt="User" class="rounded-circle border" width="40" height="40"
                                style="object-fit: cover; flex-shrink:0;">

                            <!-- CONTENT -->
                            <div class="flex-grow-1">

                                <div class="small">

                                    <strong>
                                        {{ $notification->data['user_name'] ?? 'System' }}
                                    </strong>

                                    {{ $notification->data['message'] ?? 'sent a notification' }}

                                </div>

                                <small class="text-muted">
                                    {{ $notification->created_at->diffForHumans() }}
                                </small>

                            </div>

                        </a>

                </li>

            @empty

                <li class="px-3 py-3 text-muted text-center">
                    No notifications
                </li>

            @endforelse

            <!-- FOOTER -->
            <li>
                <hr class="dropdown-divider">
            </li>

            <li class="px-2 pb-2">

                <a href="{{ route('notifications') }}" class="btn btn-primary btn-sm w-100">
                    View All
                </a>

            </li>

        </ul>

    </div>

    <!-- NOTIFICATION ICON END -->

    <!-- USER DROPDOWN -->
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1"
            data-bs-toggle="dropdown" aria-expanded="false">

            <img src="{{ $user->profile_photo
    ? asset('storage/' . $user->profile_photo)
    : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}" class="rounded-circle" width="35" height="35">

            <span class="d-none d-sm-inline mx-1">
                {{ Auth::user()->name ?? 'User' }}
            </span>
        </a>



        <ul class="dropdown-menu dropdown-menu-end text-small shadow">

            <li>
                <a class="dropdown-item" href="{{ route('profile.show') }}">
                    Profile
                </a>
            </li>

            <li>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    Edit
                </a>
            </li>

            <li>
                <hr class="dropdown-divider">
            </li>

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

        <a href="{{ route('blogs.create') }}" class="{{ request()->routeIs('blogs.create``') ? 'active' : '' }}">
            <i class="fas fa-plus"></i> <span>Add Blog</span>
        </a>

        <a href="{{ route('blogs.index') }}" class="{{ request()->routeIs('blogs.index') ? 'active' : '' }}">
            <i class="fas fa-list"></i> <span>Manage Blog</span>
        </a>

    </div>

    <!-- ENQUIRIES -->

    <a href="{{ route('contact.view') }}" class="{{ request()->routeIs('contact.view') ? 'active' : '' }}">
        <i class="fas fa-envelope"></i> <span>Enquiries</span> </a>
</div>

<!-- ================= SCRIPT ================= -->
<script>
    function toggleSidebar() {
        document.body.classList.toggle('sidebar-collapsed');
    }
</script>