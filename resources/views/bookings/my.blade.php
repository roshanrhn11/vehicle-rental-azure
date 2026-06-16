<!DOCTYPE html>
<html>
<head>
    <title>My Bookings - Vehicle Rental System</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6f8;
            color: #111;
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
            width: 88%;
            margin: 35px auto;
        }

        .success-box {
            background: #e8fff0;
            border-left: 5px solid #198754;
            padding: 18px;
            margin-bottom: 25px;
            border-radius: 6px;
            color: #146c43;
            font-weight: bold;
        }

        .page-title {
            margin-bottom: 25px;
        }

        .booking-card {
            background: white;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 25px;
            padding: 20px;
            margin-bottom: 22px;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.10);
        }

        .booking-card img {
            width: 100%;
            height: 190px;
            object-fit: cover;
            border-radius: 8px;
        }

        .booking-info h2 {
            margin-top: 0;
            font-family: Georgia, serif;
            font-size: 28px;
        }

        .row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .item {
            background: #f5f6f8;
            padding: 12px;
            border-radius: 6px;
        }

        .item strong {
            display: block;
            color: #555;
            margin-bottom: 4px;
        }

        .status {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 20px;
            font-weight: bold;
            margin-top: 12px;
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

        .receipt {
            margin-top: 15px;
            background: #eef4ff;
            padding: 15px;
            border-radius: 6px;
        }

        .empty {
            background: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .btn {
            display: inline-block;
            background: #4169c1;
            color: white;
            padding: 10px 16px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 4px;
            margin-top: 12px;
        }

        @media(max-width: 900px) {
            .booking-card {
                grid-template-columns: 1fr;
            }

            .row {
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
        <a href="{{ route('vehicles.index') }}">VEHICLES</a>
        <a href="{{ route('my.bookings') }}">MY BOOKINGS</a>

        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button class="logout-btn" type="submit">LOGOUT</button>
        </form>
    </div>
</div>

<div class="container">
    <div class="page-title">
        <h1>My Booking Requests</h1>
        <p>View your vehicle rental booking reference, receipt details, and current status.</p>
    </div>

    @if(session('success'))
        <div class="success-box">
            {{ session('success') }}
        </div>
    @endif

    @if($bookings->count() == 0)
        <div class="empty">
            <h2>No bookings found</h2>
            <p>You have not submitted any vehicle rental booking request yet.</p>
            <a class="btn" href="{{ route('vehicles.index') }}">Browse Vehicles</a>
        </div>
    @endif

    @foreach($bookings as $booking)
        <div class="booking-card">
            <div>
                @if($booking->vehicle->image_path)
                    <img src="{{ asset('storage/' . $booking->vehicle->image_path) }}" alt="Vehicle Image">
                @else
                    <img src="https://images.unsplash.com/photo-1549924231-f129b911e442?auto=format&fit=crop&w=900&q=80" alt="Vehicle Image">
                @endif
            </div>

            <div class="booking-info">
                <h2>{{ $booking->vehicle->vehicle_name }}</h2>

                <div class="row">
                    <div class="item">
                        <strong>Booking Reference</strong>
                        {{ $booking->booking_reference }}
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

                <span class="status {{ $booking->status }}">
                    {{ strtoupper($booking->status) }}
                </span>

                <div class="receipt">
                    <h3>Booking Receipt</h3>
                    <p><strong>Customer:</strong> {{ $booking->customer_name }}</p>
                    <p><strong>Email:</strong> {{ $booking->customer_email }}</p>
                    <p><strong>Phone:</strong> {{ $booking->phone }}</p>
                   @if($booking->status == 'approved')
    <p><strong>Receipt Note:</strong> Your booking has been confirmed successfully. Please keep your booking reference number for vehicle pickup.</p>
@elseif($booking->status == 'rejected')
    <p><strong>Receipt Note:</strong> Your booking request has been rejected. Please contact the admin for more details or submit a new booking request.</p>
@else
    <p><strong>Receipt Note:</strong> Your booking request has been submitted successfully. Admin will review and update the status.</p>
@endif
                </div>
            </div>
        </div>
    @endforeach
</div>

</body>
</html>