<title>@yield('title', config('app.name', 'admin'))</title>



<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


<style>
    :root {
        --sidebar-width: 240px;
        --sidebar-collapsed: 70px;
        --topbar-height: 56px;
        --footer-height: 56px;
        --bg: #f4f6f9;
    }


    html,
    body {
        height: 100%;
        margin: 0;
        background: var(--bg);
    }

    body {
        display: flex;
        flex-direction: column;

    }

    .topbar {
        height: var(--topbar-height);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1100;
        background: #000;
        display: flex;
        align-items: center;
        padding: .5rem 1rem;
    }

    /* SIDEBAR */
    .sidenav {
        width: var(--sidebar-width);
        position: fixed;
        top: var(--topbar-height);
        bottom: var(--footer-height);
        left: 0;
        background: #0b0b0b;
        padding-top: 1rem;
        overflow: auto;
        transition: width .25s;
    }

    /* MAIN CONTENT (🔥 FIXED TOP SPACE HERE) */
    .main-content {
        margin-left: var(--sidebar-width);
        /* margin-top: var(--topbar-height); */
        /* keeps below topbar */
        margin-bottom: var(--footer-height);
        padding: 1rem 0.75rem;
        /* reduced padding */
        transition: margin-left .25s;
        /* background-image:  url('{{ asset("assets/images/yellonwg.jpg") }}'); */
    }

    /* COLLAPSED SIDEBAR */
    body.sidebar-collapsed .sidenav {
        width: var(--sidebar-collapsed);
    }

    body.sidebar-collapsed .main-content {
        margin-left: var(--sidebar-collapsed);
    }

    /* SIDEBAR LINKS */
    .sidenav a {
        display: flex;
        align-items: center;
        gap: .75rem;
        color: #cfcfcf;
        padding: .7rem 1rem;
        text-decoration: none;
    }

    .sidenav a:hover,
    .sidenav a.active {
        background: #ffc107;
        color: #000;
    }

    /* FOOTER */
    .site-footer {
        height: var(--footer-height);
        background: #000;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1050;
    }

    /* RESPONSIVE */
    @media (max-width: 992px) {

        .sidenav {
            left: -100%;
        }

        .main-content {
            margin-left: 0;
            padding: 1rem;

        }

        body.sidebar-collapsed .sidenav {
            left: 0;
        }

        /* FIX: breadcrumb modern styling */
        .breadcrumb {
            background: transparent;
            padding: 6px 12px;
            margin: 0;
            border-radius: 8px;
            font-size: 14px;
        }

        /* breadcrumb links */
        .breadcrumb-item a {
            text-decoration: none;
            color: #ffc107;
            font-weight: 500;
        }

        /* hover effect */
        .breadcrumb-item a:hover {
            color: #ffdd57;
            text-decoration: underline;
        }

        /* active item */
        .breadcrumb-item.active {
            color: #6c757d;
            font-weight: 600;
        }

        /* breadcrumb container look */
        nav[aria-label="breadcrumb"] {
            background: rgba(0, 0, 0, 0.03);
            padding: 6px 12px;
            border-radius: 10px;
            display: inline-flex;
        }
    }
</style>



@stack('styles')
</head>

<body>


    @include('layouts.sidebar')
    @include('components.logout-modal')



    <div class="main-content">

        @include('layouts.breadcrumb')

        @yield('content')

    </div>

    @includeIf('components.contact-modal')
    </main>

    @include('layouts.footer')

    {{-- @includeIf('layoutscls.flash-messages') --}}

    @include('notifications.toasts')
    @if(auth()->check())
        <script>
            window.userId = {{ auth()->id() }};
        </script>
    @endif
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    
    <script>
        const toggle = document.getElementById('sidebarToggle');
        if (toggle) toggle.addEventListener('click', () => document.body.classList.toggle('sidebar-collapsed'));
    </script>

    @stack('scripts')
    @yield('scripts')