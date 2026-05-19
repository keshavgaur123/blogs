@extends('layouts.dashboard-layout')

@section('content')

    <style>
        .notification-container {
            max-width: 950px;
            margin: 20px auto;
        }

        .notification-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            background: #fff;
        }

        .notification-header {
            background: linear-gradient(135deg, #ffd700, #ffb300);
            padding: 18px 25px;
            color: #222;
            font-weight: 700;
        }

        .notification-header h3 {
            margin: 0;
            font-size: 24px;
        }

        .notification-item {
            border-bottom: 1px solid #f1f1f1;
            padding: 18px 20px;
            transition: all 0.3s ease;
            display: flex;
            align-items: start;
            gap: 15px;
            position: relative;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-item:hover {
            background: #f9fafc;
            transform: translateY(-2px);
        }

        .notification-unread {
            background: #fffdf3;
            border-left: 5px solid #ffc107;
        }

        /* PROFILE IMAGE */
        .notification-avatar {
            width: 55px;
            height: 55px;
            min-width: 55px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #fff3cd;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .notification-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .notification-content {
            flex: 1;
        }

        .notification-user {
            font-weight: 700;
            color: #222;
        }

        .notification-message {
            color: #555;
            margin-top: 3px;
            line-height: 1.6;
            font-size: 15px;
        }

        .notification-time {
            font-size: 13px;
            color: #888;
            margin-top: 8px;
            display: inline-block;
        }

        .unread-badge {
            position: absolute;
            top: 18px;
            right: 18px;
            background: #ff9800;
            color: #fff;
            font-size: 11px;
            padding: 5px 12px;
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: .3px;
        }

        .empty-box {
            padding: 60px 20px;
            text-align: center;
            color: #777;
        }

        .empty-box .icon {
            font-size: 65px;
            margin-bottom: 15px;
        }

        .alert-success {
            border-radius: 12px;
        }

        @media(max-width: 768px) {

            .notification-item {
                flex-direction: column;
            }

            .unread-badge {
                position: static;
                margin-top: 10px;
                width: fit-content;
            }
        }
    </style>

    <div class="container notification-container">

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="alert alert-success shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="notification-card">

            {{-- HEADER --}}
            <div class="notification-header d-flex justify-content-between align-items-center">

                <h3>
                    🔔 All Notifications
                </h3>

                <span class="badge bg-dark fs-6">
                    {{ $notifications->count() }}
                </span>

            </div>

            {{-- BODY --}}
            <div class="notification-body">

                @forelse($notifications as $notification)

                    @php
                        $profilePhoto = $notification->data['profile_photo'] ?? null;

                        $imageUrl = $profilePhoto
                            ? asset('storage/' . $profilePhoto)
                            : 'https://cdn-icons-png.flaticon.com/512/149/149071.png';
                    @endphp

                    <div class="notification-item {{ $notification->read_at ? '' : 'notification-unread' }}">

                        {{-- PROFILE IMAGE --}}
                        <div class="notification-avatar">

                            <img src="{{ $imageUrl }}" alt="Profile Image">

                        </div>

                        {{-- CONTENT --}}
                        <div class="notification-content">

                            <div class="notification-message">

                                <span class="notification-user">
                                    {{ $notification->data['user_name'] ?? 'User' }}
                                </span>

                                {{ $notification->data['message'] ?? 'sent a notification' }}

                            </div>

                            <span class="notification-time">
                                ⏰ {{ $notification->created_at->diffForHumans() }}
                            </span>

                        </div>

                        {{-- BADGE --}}
                        @if(!$notification->read_at)
                            <span class="unread-badge">
                                New
                            </span>
                        @endif

                    </div>

                @empty

                    {{-- EMPTY STATE --}}
                    <div class="empty-box">

                        <div class="icon">
                            🔕
                        </div>

                        <h5>
                            No Notifications Found
                        </h5>

                        <p class="mb-0">
                            You don't have any notifications right now.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

@endsection