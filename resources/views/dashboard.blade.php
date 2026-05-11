@extends('layouts.dashboard-layout')

@section('title', 'Dashboard')
@include('layouts.flash-messages')
{{-- @include('components.delete-modal') --}}
@section('content')



  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-5 ">Dashboard</h2>
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