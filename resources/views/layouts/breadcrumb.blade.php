<!-- FIX: Breadcrumb added globally for all dashboard pages -->
<nav aria-label="breadcrumb" class=" d-flex justify-content-end ">

    <ol class="breadcrumb">

        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>

        @if(request()->routeIs('blogs.*'))
            <li class="breadcrumb-item active" aria-current="page">
                Blog
            </li>
        @endif

        @if(request()->routeIs('categories.*'))
            <li class="breadcrumb-item active" aria-current="page">
                Category
            </li>
        @endif
        @if(request()->routeIs('categories.create'))
            <li class="breadcrumb-item active" aria-current="page">
                Add Category
            </li>
        @endif

        @if(request()->routeIs('categories.index'))
            <li class="breadcrumb-item active" aria-current="page">
                Manage Category
            </li>
        @endif

        @if(request()->routeIs('blogs.create'))
            <li class="breadcrumb-item active" aria-current="page">
                Add Blog
            </li>
        @endif

        @if(request()->routeIs('blogs.index'))
            <li class="breadcrumb-item active" aria-current="page">
                Manage Blog
            </li>
        @endif

        @if(request()->routeIs('contact.view'))
            <li class="breadcrumb-item active" aria-current="page">
                View Enquiries
            </li>
        @endif
    </ol>

</nav>