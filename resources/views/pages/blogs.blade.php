@include('layouts.navbar')

<h1>Blog Listing</h1>

<ul>
    <li><a href="{{ route('blog.details', 1) }}">Blog 1</a></li>
    <li><a href="{{ route('blog.details', 2) }}">Blog 2</a></li>
</ul>