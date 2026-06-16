<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Details</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6f8;
        }

        .navbar {
            background: #2f4b5f;
            color: white;
            padding: 18px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
        }

        .logout-btn {
            background: #b00000;
            color: white;
            border: none;
            padding: 10px 15px;
            font-weight: bold;
            cursor: pointer;
            margin-left: 20px;
        }

        .container {
            width: 85%;
            margin: 40px auto;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 35px;
        }

        .card {
            background: white;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.10);
            border-radius: 8px;
        }

        img {
            width: 100%;
            height: 430px;
            object-fit: cover;
            border-radius: 8px;
        }

        h1 {
            font-family: Georgia, serif;
            font-size: 36px;
            margin-top: 0;
        }

        .price {
            color: #4169c1;
            font-size: 24px;
            font-weight: bold;
        }

        .error {
            color: red;
        }

        .back {
            color: #4169c1;
            text-decoration: none;
            font-weight: bold;
        }

        .action-box {
            background: #f5f6f8;
            padding: 22px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .primary-btn {
            display: block;
            background: #4169c1;
            color: white;
            padding: 14px;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
            border-radius: 4px;
            margin-bottom: 12px;
        }

        .success-btn {
            display: block;
            background: #198754;
            color: white;
            padding: 14px;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
            border-radius: 4px;
        }

        .info {
            color: #555;
            line-height: 1.6;
        }

        @media(max-width: 900px) {
            .container {
                grid-template-columns: 1fr;
            }

            .navbar {
                padding: 18px 25px;
                flex-direction: column;
                gap: 12px;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <strong>VEHICLE RENT-A-CAR</strong>

    <div>
        <a href="{{ route('home') }}">HOME</a>

        @if(auth()->check())
            <a href="{{ route('my.bookings') }}">MY BOOKINGS</a>

            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button class="logout-btn" type="submit">LOGOUT</button>
            </form>
        @else
            <a href="{{ route('login') }}">LOGIN</a>
        @endif
    </div>
</div>

<div class="container">
    <div class="card">
        <a class="back" href="{{ route('vehicles.index') }}">← Back to Fleet</a>

        <h1>{{ $vehicle->vehicle_name }}</h1>

        @if($vehicle->image_path)
            <img src="{{ asset('storage/' . $vehicle->image_path) }}" alt="Vehicle Image">
        @else
            <img src="https://images.unsplash.com/photo-1549924231-f129b911e442?auto=format&fit=crop&w=900&q=80" alt="Vehicle Image">
        @endif

        <p><strong>Type:</strong> {{ $vehicle->vehicle_type }}</p>
        <p><strong>Brand:</strong> {{ $vehicle->brand }}</p>
        <p><strong>Model:</strong> {{ $vehicle->model }}</p>
        <p><strong>Location:</strong> {{ $vehicle->location }}</p>
        <p class="price">Rs. {{ $vehicle->price_per_day }} / Day</p>
        <p><strong>Status:</strong> {{ ucfirst($vehicle->status) }}</p>
        <p>{{ $vehicle->description }}</p>
    </div>

    <div class="card">
        <h2>Book This Vehicle</h2>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if(auth()->check())
            <div class="action-box">
                <h3>Ready to book?</h3>
                <p class="info">
                    You are logged in. Continue to the booking confirmation page to enter pickup date,
                    return date, phone number, and license document.
                </p>

                <a class="primary-btn" href="{{ route('vehicles.booking', $vehicle) }}">
                    CONTINUE BOOKING
                </a>
            </div>
        @else
            <div class="action-box">
                <h3>Login Required</h3>
                <p class="info">
                    Please login or register as a customer to submit a booking request for this vehicle.
                    After login, you will be redirected to the booking confirmation page.
                </p>

                <a class="primary-btn" href="{{ route('login', ['redirect' => route('vehicles.booking', $vehicle)]) }}">
                    LOGIN TO BOOK
                </a>

                <a class="success-btn" href="{{ route('register', ['redirect' => route('vehicles.booking', $vehicle)]) }}">
                    NEW CUSTOMER REGISTER
                </a>
            </div>
        @endif
    </div>
</div>

</body>
</html>