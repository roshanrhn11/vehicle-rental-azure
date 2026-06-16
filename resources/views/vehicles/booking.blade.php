<!DOCTYPE html>
<html>
<head>
    <title>Confirm Booking</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f5f6f8; margin:0; }
        .navbar { background:#2f4b5f; color:white; padding:18px 60px; display:flex; justify-content:space-between; }
        .navbar a { color:white; text-decoration:none; margin-left:20px; font-weight:bold; }
        .container { width:85%; margin:40px auto; display:grid; grid-template-columns:0.9fr 1.1fr; gap:35px; }
        .card { background:white; padding:25px; box-shadow:0 8px 25px rgba(0,0,0,0.10); border-radius:8px; }
        img { width:100%; height:330px; object-fit:cover; border-radius:8px; }
        input { width:100%; padding:12px; margin:8px 0 14px; border:1px solid #ccc; }
        button { background:#4169c1; color:white; border:none; padding:14px 20px; width:100%; font-weight:bold; cursor:pointer; }
        .price { color:#4169c1; font-size:22px; font-weight:bold; }
        .error { background:#ffe8e8; color:#b00000; padding:12px; border-radius:5px; margin-bottom:15px; }
        .info { background:#eef4ff; padding:15px; border-radius:6px; margin-bottom:18px; color:#333; }
    </style>
</head>
<body>

<div class="navbar">
    <strong>VEHICLE RENT-A-CAR</strong>
    <div>
        <a href="{{ route('home') }}">HOME</a>
        <a href="{{ route('my.bookings') }}">MY BOOKINGS</a>
    </div>
</div>

<div class="container">
    <div class="card">
        <h1>{{ $vehicle->vehicle_name }}</h1>

        @if($vehicle->image_path)
            <img src="{{ asset('storage/' . $vehicle->image_path) }}" alt="Vehicle Image">
        @else
            <img src="https://images.unsplash.com/photo-1549924231-f129b911e442?auto=format&fit=crop&w=900&q=80" alt="Vehicle Image">
        @endif

        <p><strong>Type:</strong> {{ $vehicle->vehicle_type }}</p>
        <p><strong>Brand:</strong> {{ $vehicle->brand }}</p>
        <p><strong>Model:</strong> {{ $vehicle->model }}</p>
        <p><strong>Pickup Location:</strong> {{ $vehicle->location }}</p>
        <p class="price">Rs. {{ $vehicle->price_per_day }} / Day</p>
        <p>{{ $vehicle->description }}</p>
    </div>

    <div class="card">
        <h1>Confirm Booking Request</h1>

        <div class="info">
            Please fill the rental details and confirm your booking request.
        </div>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p style="margin:0 0 5px;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('vehicles.book', $vehicle) }}" enctype="multipart/form-data">
            @csrf

            <label>Your Name</label>
            <input type="text" name="customer_name" value="{{ auth()->user()->name }}" required>

            <label>Email</label>
            <input type="email" name="customer_email" value="{{ auth()->user()->email }}" required>

            <label>Phone Number</label>
            <input type="text" name="phone" placeholder="Enter phone number" required>

            <label>Pickup Date</label>
            <input type="date" name="pickup_date" required>

            <label>Return Date</label>
            <input type="date" name="return_date" required>

            <label>Driving License Document</label>
            <input type="file" name="license_document">

            <button type="submit">CONFIRM BOOKING REQUEST</button>
        </form>
    </div>
</div>

</body>
</html>