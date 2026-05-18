@extends('layouts.dashboard-layout')

@section('content')
    <div class="container" style="padding-top: 20px; padding-left: 80px;">

        <h3 class="mb-3">All Notifications</h3>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="list-group">

            @forelse($notifications as $notification)

                <div class="list-group-item {{ $notification->read_at ? '' : 'bg-light' }}">

                    <div>
                        <b>{{ $notification->data['user_name'] ?? 'User' }}</b>
                        {{ $notification->data['message'] ?? 'sent a notification' }}
                    </div>

                    <small class="text-muted">
                        {{ $notification->created_at->diffForHumans() }}
                    </small>

                </div>

            @empty
                <div class="alert alert-info">
                    No notifications found
                </div>
            @endforelse

        </div>
    </div>
@endsection