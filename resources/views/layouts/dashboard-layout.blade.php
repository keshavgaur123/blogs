<title>@yield('title', config('app.name', 'admin'))</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

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
    }

    body {
        margin: 0;
        min-height: 100%;
        display: flex;
        flex-direction: column;
        background: var(--bg);
        padding-top: var(--topbar-height);
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

    .brand {
        color: #ffc107;
        font-weight: 700;
        margin-left: .5rem;
    }

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

    body.sidebar-collapsed .sidenav {
        width: var(--sidebar-collapsed);
    }

    body.sidebar-collapsed .sidenav a span {
        display: none;
    }

    .main-content {
        margin-left: var(--sidebar-width);
        margin-top: var(--topbar-height);
        margin-bottom: var(--footer-height);
        padding: 1.9rem;
        transition: margin-left .25s;
    }

    body.sidebar-collapsed .main-content {
        margin-left: var(--sidebar-collapsed);
    }

    .dashboard-card {
        border-radius: 12px;
        transition: transform .18s, box-shadow .18s;
        cursor: pointer;
    }

    .dashboard-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, .18);
    }

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

    @media (max-width: 992px) {
        .sidenav {
            left: -9999px;
            position: fixed
        }

        .main-content {
            margin-left: 0;
            padding: 1rem;
        }

        .body.sidebar-collapsed .sidenav {
            left: var(--topbar-height)
        }
    }
</style>



@stack('styles')
</head>

<body>


    @include('layouts.sidebar')
    @include('components.logout-modal')

    <main class="main-content">
        <div class="container-fluid">
            @yield('content')
        </div>

        @includeIf('components.contact-modal')
    </main>

    @include('layouts.footer')

    @includeIf('layouts.flash-messages')



    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <script>
        const toggle = document.getElementById('sidebarToggle');
        if (toggle) toggle.addEventListener('click', () => document.body.classList.toggle('sidebar-collapsed'));
    </script>

    @stack('scripts')