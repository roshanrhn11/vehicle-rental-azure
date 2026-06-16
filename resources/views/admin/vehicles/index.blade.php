<!DOCTYPE html>
<html>
<head>
    <title>Manage Vehicles - Admin Panel</title>
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
            gap: 20px;
        }

        .header-card h2 {
            margin: 0 0 8px;
            font-size: 30px;
        }

        .header-card p {
            margin: 0;
            color: #666;
        }

        .add-btn {
            background: #4169c1;
            color: white;
            padding: 13px 18px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            white-space: nowrap;
        }

        .add-btn:hover {
            background: #2f55a8;
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

        .vehicle-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .vehicle-card {
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 28px rgba(0,0,0,0.09);
            transition: 0.3s;
        }

        .vehicle-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(0,0,0,0.16);
        }

        .vehicle-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            background: #ddd;
        }

        .vehicle-body {
            padding: 22px;
        }

        .vehicle-body h2 {
            margin: 0 0 14px;
            font-family: Georgia, serif;
            font-size: 27px;
        }

        .info-row {
            background: #f5f6f8;
            padding: 10px 12px;
            border-radius: 6px;
            margin-bottom: 10px;
            color: #333;
        }

        .info-row strong {
            color: #111;
        }

        .price {
            font-size: 20px;
            font-weight: bold;
            color: #4169c1;
            margin: 15px 0;
        }

        .status {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 16px;
        }

        .available {
            background: #d1e7dd;
            color: #0f5132;
        }

        .unavailable {
            background: #f8d7da;
            color: #842029;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .delete-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 11px 15px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 4px;
        }

        .delete-btn:hover {
            background: #b02a37;
        }

        .view-btn {
            background: #102235;
            color: white;
            padding: 11px 15px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 4px;
        }

        .view-btn:hover {
            background: #4169c1;
        }

        .empty {
            background: white;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .empty h2 {
            margin-top: 0;
        }

        @media(max-width: 1100px) {
            .vehicle-grid {
                grid-template-columns: repeat(2, 1fr);
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

            .vehicle-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Vehicle Admin</h2>
    <small>Rental Management Panel</small>

    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a class="active" href="{{ route('admin.vehicles.index') }}">Manage Vehicles</a>
    <a href="{{ route('admin.bookings.index') }}">Manage Bookings</a>
    <a href="{{ route('home') }}">View Website</a>
</div>

<div class="main">
    <div class="topbar">
        <h1>Manage Vehicles</h1>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn" type="submit">LOGOUT</button>
        </form>
    </div>

    <div class="content">
        <div class="header-card">
            <div>
                <h2>Vehicle Collection</h2>
                <p>Add, view and manage all rental vehicles available in the system.</p>
            </div>

            <a class="add-btn" href="{{ route('admin.vehicles.create') }}">+ Add New Vehicle</a>
        </div>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if($vehicles->count() == 0)
            <div class="empty">
                <h2>No vehicles found</h2>
                <p>You have not added any vehicle yet.</p>
                <a class="add-btn" href="{{ route('admin.vehicles.create') }}">Add Your First Vehicle</a>
            </div>
        @else
            <div class="vehicle-grid">
                @foreach($vehicles as $vehicle)
                    <div class="vehicle-card">
                        @if($vehicle->image_path)
                            <img class="vehicle-img" src="{{ asset('storage/' . $vehicle->image_path) }}" alt="Vehicle Image">
                        @else
                            <img class="vehicle-img" src="https://images.unsplash.com/photo-1549924231-f129b911e442?auto=format&fit=crop&w=900&q=80" alt="Vehicle Image">
                        @endif

                        <div class="vehicle-body">
                            <h2>{{ $vehicle->vehicle_name }}</h2>

                            <div class="info-row">
                                <strong>Type:</strong> {{ $vehicle->vehicle_type }}
                            </div>

                            <div class="info-row">
                                <strong>Brand:</strong> {{ $vehicle->brand }} {{ $vehicle->model }}
                            </div>

                            <div class="info-row">
                                <strong>Location:</strong> {{ $vehicle->location }}
                            </div>

                            <div class="price">
                                Rs. {{ $vehicle->price_per_day }} / Day
                            </div>

                            <span class="status {{ $vehicle->status == 'available' ? 'available' : 'unavailable' }}">
                                {{ strtoupper($vehicle->status) }}
                            </span>

                            <div class="actions">
                                <a class="view-btn" href="{{ route('vehicles.show', $vehicle) }}" target="_blank">
                                    View
                                </a>

                                <form method="POST" action="{{ route('admin.vehicles.destroy', $vehicle) }}" onsubmit="return confirm('Are you sure you want to delete this vehicle?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="delete-btn" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

</body>
</html>