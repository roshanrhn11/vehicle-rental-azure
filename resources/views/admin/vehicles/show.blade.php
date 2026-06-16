<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Details</title>
    <style>
        body { font-family: Arial; background:#f4f6f8; }
        .box { width:800px; margin:30px auto; background:white; padding:25px; border-radius:10px; box-shadow:0 0 8px #ccc; }
        img { width:100%; max-height:350px; object-fit:cover; border-radius:8px; }
        .btn { background:#198754; color:white; padding:10px 15px; text-decoration:none; border-radius:5px; }
    </style>
</head>
<body>

<div class="box">
    <a href="{{ route('vehicles.index') }}">Back to Vehicles</a>

    <h1>{{ $vehicle->vehicle_name }}</h1>

    @if($vehicle->image_path)
        <img src="{{ asset('storage/' . $vehicle->image_path) }}" alt="Vehicle Image">
    @endif

    <p><strong>Type:</strong> {{ $vehicle->vehicle_type }}</p>
    <p><strong>Brand:</strong> {{ $vehicle->brand }}</p>
    <p><strong>Model:</strong> {{ $vehicle->model }}</p>
    <p><strong>Location:</strong> {{ $vehicle->location }}</p>
    <p><strong>Price Per Day:</strong> Rs. {{ $vehicle->price_per_day }}</p>
    <p><strong>Status:</strong> {{ $vehicle->status }}</p>
    <p>{{ $vehicle->description }}</p>

    <p style="color:blue;">Booking form will be added in next step.</p>
</div>

</body>
</html>