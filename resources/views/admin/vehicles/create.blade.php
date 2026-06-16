<!DOCTYPE html>
<html>
<head>
    <title>Add Vehicle - Admin Panel</title>
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
            color: #fff;
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
            font-size: 24px;
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

        .form-card {
            background: white;
            max-width: 950px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .form-card h2 {
            margin-top: 0;
            font-size: 30px;
        }

        .back-link {
            color: #4169c1;
            text-decoration: none;
            font-weight: bold;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            margin-top: 25px;
        }

        .form-group {
            margin-bottom: 5px;
        }

        .full {
            grid-column: 1 / 3;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #333;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 13px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        textarea {
            height: 110px;
            resize: vertical;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #4169c1;
        }

        .error {
            background: #ffe8e8;
            color: #b00000;
            padding: 12px;
            border-radius: 5px;
            margin-top: 18px;
        }

        .save-btn {
            background: #4169c1;
            color: white;
            border: none;
            padding: 14px 22px;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 18px;
        }

        .save-btn:hover {
            background: #2f55a8;
        }

        .hint {
            color: #666;
            font-size: 14px;
            margin-top: 6px;
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

            .form-grid {
                grid-template-columns: 1fr;
            }

            .full {
                grid-column: 1;
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
        <h1>Add New Vehicle</h1>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn" type="submit">LOGOUT</button>
        </form>
    </div>

    <div class="content">
        <div class="form-card">
            <a class="back-link" href="{{ route('admin.vehicles.index') }}">← Back to Vehicle List</a>

            <h2>Vehicle Details</h2>
            <p class="hint">Add vehicle information, rental price, location, availability status, and image.</p>

            @if ($errors->any())
                <div class="error">
                    @foreach ($errors->all() as $error)
                        <p style="margin:0 0 5px;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.vehicles.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-grid">
                    <div class="form-group">
                        <label>Vehicle Name</label>
                        <input type="text" name="vehicle_name" placeholder="Example: Toyota Prado" value="{{ old('vehicle_name') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Vehicle Type</label>
                        <select name="vehicle_type" required>
                            <option value="">Select Vehicle Type</option>
                            <option value="Car" {{ old('vehicle_type') == 'Car' ? 'selected' : '' }}>Car</option>
                            <option value="Van" {{ old('vehicle_type') == 'Van' ? 'selected' : '' }}>Van</option>
                            <option value="SUV" {{ old('vehicle_type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                            <option value="Bike" {{ old('vehicle_type') == 'Bike' ? 'selected' : '' }}>Bike</option>
                            <option value="Wedding Car" {{ old('vehicle_type') == 'Wedding Car' ? 'selected' : '' }}>Wedding Car</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Brand</label>
                        <input type="text" name="brand" placeholder="Example: Toyota" value="{{ old('brand') }}">
                    </div>

                    <div class="form-group">
                        <label>Model</label>
                        <input type="text" name="model" placeholder="Example: Prado 2020" value="{{ old('model') }}">
                    </div>

                    <div class="form-group">
                        <label>Pickup Location</label>
                        <input type="text" name="location" placeholder="Example: Colombo" value="{{ old('location') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Price Per Day (LKR)</label>
                        <input type="number" name="price_per_day" placeholder="Example: 12000" value="{{ old('price_per_day') }}" required>
                    </div>

                    <div class="form-group full">
                        <label>Vehicle Description</label>
                        <textarea name="description" placeholder="Enter vehicle features, seating capacity, fuel type, and rental details">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Availability Status</label>
                        <select name="status">
                            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Vehicle Image</label>
                        <input type="file" name="image">
                        <p class="hint">Upload JPG or PNG vehicle image.</p>
                    </div>
                </div>

                <button class="save-btn" type="submit">SAVE VEHICLE</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>