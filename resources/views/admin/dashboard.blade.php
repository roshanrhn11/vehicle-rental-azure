<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Vehicle Rental System</title>
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

        .welcome {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            margin-bottom: 28px;
        }

        .welcome h2 {
            margin-top: 0;
            font-size: 30px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .card h3 {
            margin-top: 0;
            color: #444;
            font-size: 18px;
        }

        .card h2 {
            font-size: 36px;
            margin: 10px 0;
            color: #111;
        }

        .vehicle {
            border-left: 5px solid #4169c1;
        }

        .available {
            border-left: 5px solid #198754;
        }

        .unavailable {
            border-left: 5px solid #dc3545;
        }

        .booking {
            border-left: 5px solid #fd7e14;
        }

        .pending {
            border-left: 5px solid #ffc107;
        }

        .approved {
            border-left: 5px solid #20c997;
        }

        .actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            background: #4169c1;
            color: white;
            padding: 13px 18px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-green {
            background: #198754;
        }

        .btn-orange {
            background: #fd7e14;
        }

        .alert {
            background: #fff3cd;
            border-left: 5px solid #ffc107;
            padding: 18px;
            border-radius: 6px;
            margin-bottom: 25px;
            color: #856404;
            font-weight: bold;
        }

        @media(max-width: 900px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
            }

            .cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Vehicle Admin</h2>
    <small>Rental Management Panel</small>

    <a class="active" href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.vehicles.index') }}">Manage Vehicles</a>
    <a href="{{ route('admin.bookings.index') }}">Manage Bookings</a>
    <a href="{{ route('home') }}">View Website</a>
</div>

<div class="main">
    <div class="topbar">
        <h1>Admin Dashboard</h1>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn" type="submit">LOGOUT</button>
        </form>
    </div>

    <div class="content">
        <div class="welcome">
            <h2>Vehicle Rental Admin Panel</h2>
            <p>Manage vehicles, customer booking requests, and rental availability from this dashboard.</p>
        </div>

        @if($pendingBookings > 0)
            <div class="alert">
                You have {{ $pendingBookings }} pending booking request(s). Please review them.
            </div>
        @endif

        <div class="cards">
            <div class="card vehicle">
                <h3>Total Vehicles</h3>
                <h2>{{ $totalVehicles }}</h2>
                <p>All vehicles added to the system.</p>
            </div>

            <div class="card available">
                <h3>Available Vehicles</h3>
                <h2>{{ $availableVehicles }}</h2>
                <p>Vehicles currently available for rental.</p>
            </div>

            <div class="card unavailable">
                <h3>Unavailable Vehicles</h3>
                <h2>{{ $unavailableVehicles }}</h2>
                <p>Vehicles not available at the moment.</p>
            </div>

            <div class="card booking">
                <h3>Total Bookings</h3>
                <h2>{{ $totalBookings }}</h2>
                <p>All customer booking requests.</p>
            </div>

            <div class="card pending">
                <h3>Pending Bookings</h3>
                <h2>{{ $pendingBookings }}</h2>
                <p>Requests waiting for admin approval.</p>
            </div>

            <div class="card approved">
                <h3>Approved Bookings</h3>
                <h2>{{ $approvedBookings }}</h2>
                <p>Confirmed rental bookings.</p>
            </div>
        </div>

        <div class="actions">
            <a class="btn" href="{{ route('admin.vehicles.create') }}">Add New Vehicle</a>
            <a class="btn btn-green" href="{{ route('admin.vehicles.index') }}">Manage Vehicles</a>
            <a class="btn btn-orange" href="{{ route('admin.bookings.index') }}">View Booking Requests</a>
        </div>
    </div>
</div>

</body>
</html>