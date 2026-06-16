<!DOCTYPE html>
<html>
<head>
    <title>Manage Bookings - Admin Panel</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #eef2f7;
            color: #111;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #24384a;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding: 25px 20px;
        }

        .sidebar h2 {
            margin: 0 0 8px;
            font-size: 22px;
        }

        .sidebar small {
            color: #b8c7d8;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px 10px;
            margin-top: 12px;
            border-radius: 5px;
            font-weight: bold;
        }

        .sidebar a:hover,
        .sidebar .active {
            background: #4169c1;
        }

        .main {
            margin-left: 250px;
            min-height: 100vh;
        }

        .topbar {
            background: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar h1 {
            margin: 0;
            font-size: 25px;
        }

        .logout-btn {
            background: #b00000;
            color: white;
            border: none;
            padding: 10px 16px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 4px;
        }

        .content {
            padding: 35px;
        }

        .header-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-card h2 {
            margin: 0 0 8px;
            font-size: 30px;
        }

        .header-card p {
            margin: 0;
            color: #666;
        }

        .success {
            background: #e8fff0;
            color: #146c43;
            border-left: 5px solid #198754;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .booking-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .booking-card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 10px 28px rgba(0,0,0,0.09);
            overflow: hidden;
            transition: 0.3s;
        }

        .booking-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 40px rgba(0,0,0,0.15);
        }

        .booking-head {
            background: #102235;
            color: white;
            padding: 20px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .booking-head h2 {
            margin: 0;
            font-family: Georgia, serif;
            font-size: 25px;
        }

        .status {
            padding: 8px 13px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            white-space: nowrap;
        }

        .pending {
            background: #fff3cd;
            color: #856404;
        }

        .approved {
            background: #d1e7dd;
            color: #0f5132;
        }

        .rejected {
            background: #f8d7da;
            color: #842029;
        }

        .booking-body {
            padding: 22px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 18px;
        }

        .item {
            background: #f5f6f8;
            padding: 12px;
            border-radius: 7px;
        }

        .item strong {
            display: block;
            color: #444;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .reference {
            background: #eef4ff;
            border-left: 5px solid #4169c1;
            padding: 14px;
            border-radius: 7px;
            margin-bottom: 18px;
            font-weight: bold;
        }

        .license {
            margin-bottom: 18px;
        }

        .license a {
            display: inline-block;
            background: #102235;
            color: white;
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 4px;
            font-weight: bold;
        }

        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .approve-btn {
            background: #198754;
            color: white;
            border: none;
            padding: 12px 16px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 4px;
        }

        .reject-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 12px 16px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 4px;
        }

        .approve-btn:hover {
            background: #146c43;
        }

        .reject-btn:hover {
            background: #b02a37;
        }

        .approved-note {
            background: #e8fff0;
            color: #146c43;
            padding: 13px;
            border-radius: 6px;
            font-weight: bold;
        }

        .rejected-note {
            background: #ffe8e8;
            color: #842029;
            padding: 13px;
            border-radius: 6px;
            font-weight: bold;
        }

        .empty {
            background: white;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        @media(max-width: 1000px) {
            .booking-grid {
                grid-template-columns: 1fr;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 800px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
            }

            .header-card {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Vehicle Admin</h2>
    <small>Rental Management Panel</small>

    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.vehicles.index') }}">Manage Vehicles</a>
    <a class="active" href="{{ route('admin.bookings.index') }}">Manage Bookings</a>
    <a href="{{ route('home') }}">View Website</a>
</div>

<div class="main">
    <div class="topbar">
        <h1>Manage Booking Requests</h1>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn" type="submit">LOGOUT</button>
        </form>
    </div>

    <div class="content">
        <div class="header-card">
            <div>
                <h2>Customer Booking Requests</h2>
                <p>Review vehicle rental requests, verify license documents, and approve or reject bookings.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if($bookings->count() == 0)
            <div class="empty">
                <h2>No booking requests found</h2>
                <p>Customer booking requests will appear here.</p>
            </div>
        @else
            <div class="booking-grid">
                @foreach($bookings as $booking)
                    <div class="booking-card">
                        <div class="booking-head">
                            <h2>{{ $booking->vehicle->vehicle_name }}</h2>

                            <span class="status {{ $booking->status }}">
                                {{ strtoupper($booking->status) }}
                            </span>
                        </div>

                        <div class="booking-body">
                            <div class="reference">
                                Booking Reference: {{ $booking->booking_reference }}
                            </div>

                            <div class="details-grid">
                                <div class="item">
                                    <strong>Customer Name</strong>
                                    {{ $booking->customer_name }}
                                </div>

                                <div class="item">
                                    <strong>Email</strong>
                                    {{ $booking->customer_email }}
                                </div>

                                <div class="item">
                                    <strong>Phone</strong>
                                    {{ $booking->phone }}
                                </div>

                                <div class="item">
                                    <strong>Vehicle Type</strong>
                                    {{ $booking->vehicle->vehicle_type }}
                                </div>

                                <div class="item">
                                    <strong>Pickup Date</strong>
                                    {{ $booking->pickup_date }}
                                </div>

                                <div class="item">
                                    <strong>Return Date</strong>
                                    {{ $booking->return_date }}
                                </div>

                                <div class="item">
                                    <strong>Pickup Location</strong>
                                    {{ $booking->vehicle->location }}
                                </div>

                                <div class="item">
                                    <strong>Price Per Day</strong>
                                    Rs. {{ $booking->vehicle->price_per_day }}
                                </div>
                            </div>

                            <div class="license">
                                @if($booking->license_document)
                                    <a href="{{ asset('storage/' . $booking->license_document) }}" target="_blank">
                                        View License Document
                                    </a>
                                @else
                                    <p><strong>License:</strong> Not uploaded</p>
                                @endif
                            </div>

                            @if($booking->status == 'pending')
                                <div class="actions">
                                    <form method="POST" action="{{ route('admin.bookings.approve', $booking) }}">
                                        @csrf
                                        <button class="approve-btn" type="submit">
                                            Approve Booking
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.bookings.reject', $booking) }}">
                                        @csrf
                                        <button class="reject-btn" type="submit">
                                            Reject Booking
                                        </button>
                                    </form>
                                </div>
                            @elseif($booking->status == 'approved')
                                <div class="approved-note">
                                    This booking has been approved. Customer confirmation email was sent if mail is configured.
                                </div>
                            @elseif($booking->status == 'rejected')
                                <div class="rejected-note">
                                    This booking request has been rejected.
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

</body>
</html>