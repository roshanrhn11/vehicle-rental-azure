<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Rent-A-Car</title>
    <style>
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #111;
        }

        .topbar {
            background: #102235;
            color: white;
            padding: 10px 70px;
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }

        .navbar {
            background: white;
            padding: 18px 70px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 18px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .logo {
            font-size: 26px;
            font-weight: bold;
            color: #102235;
            letter-spacing: 1px;
        }

        .logo span {
            color: #4169c1;
        }

        .navlinks {
            display: flex;
            align-items: center;
            gap: 22px;
        }

        .navlinks a {
            text-decoration: none;
            color: #222;
            font-weight: bold;
            font-size: 14px;
        }

        .navlinks a:hover {
            color: #4169c1;
        }

        .btn-login {
            background: #4169c1;
            color: white !important;
            padding: 12px 18px;
            border-radius: 4px;
        }

        .logout-btn {
            background: #b00000;
            color: white;
            border: none;
            padding: 12px 18px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 4px;
        }

        .hero {
            min-height: 560px;
            background:
                linear-gradient(rgba(0,0,0,0.68), rgba(0,0,0,0.68)),
                url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=1800&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            align-items: center;
            padding: 0 70px 90px;
        }

        .hero-content {
            max-width: 720px;
        }

        .hero-content .small {
            color: #9bb6ff;
            font-weight: bold;
            letter-spacing: 3px;
            margin-bottom: 15px;
        }

        .hero-content h1 {
            font-family: Georgia, serif;
            font-size: 66px;
            line-height: 1.05;
            margin: 0 0 20px;
        }

        .hero-content p {
            font-size: 19px;
            line-height: 1.7;
            color: #e8e8e8;
            margin-bottom: 30px;
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .hero-btn {
            display: inline-block;
            padding: 15px 22px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
        }

        .hero-primary {
            background: #4169c1;
            color: white;
        }

        .hero-secondary {
            background: white;
            color: #102235;
        }

        .search-box {
            background: white;
            width: 82%;
            margin: -70px auto 70px;
            padding: 35px;
            box-shadow: 0 18px 45px rgba(0,0,0,0.12);
            position: relative;
            z-index: 2;
            border-radius: 4px;
        }

        .tabs {
            display: flex;
            gap: 35px;
            margin-bottom: 25px;
            font-weight: bold;
        }

        .tabs a {
            color: #111;
            text-decoration: none;
            padding-bottom: 10px;
        }

        .tabs a.active {
            color: #4169c1;
            border-bottom: 3px solid #4169c1;
        }

        .search-row {
            display: grid;
            grid-template-columns: 1fr 1fr 0.7fr;
            gap: 20px;
        }

        .search-row input,
        .search-row select {
            width: 100%;
            padding: 18px;
            border: 1px solid #ddd;
            font-size: 16px;
            background: white;
        }

        .search-row button {
            background: #4169c1;
            color: white;
            border: none;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .search-row button:hover {
            background: #102235;
        }

        .section {
            width: 92%;
            margin: 0 auto 80px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 45px;
        }

        .section-title .mini {
            color: #0c3b63;
            font-weight: bold;
            letter-spacing: 4px;
            font-size: 14px;
        }

        .section-title h2 {
            font-family: Georgia, serif;
            font-size: 44px;
            margin: 12px 0 8px;
        }

        .line {
            width: 120px;
            height: 4px;
            background: #4169c1;
            margin: 0 auto;
        }

        .category-section {
            margin-bottom: 70px;
        }

        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: end;
            margin-bottom: 22px;
        }

        .category-header h3 {
            font-size: 30px;
            margin: 0;
            font-family: Georgia, serif;
        }

        .category-header p {
            color: #666;
            margin: 8px 0 0;
        }

        .slider-wrap {
            position: relative;
        }

        .vehicle-slider {
            display: flex;
            gap: 28px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 8px 4px 25px;
        }

        .vehicle-slider::-webkit-scrollbar {
            display: none;
        }

        .vehicle-card {
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 28px rgba(0,0,0,0.10);
            transition: 0.3s;
            min-width: calc(33.33% - 19px);
            max-width: calc(33.33% - 19px);
        }

        .vehicle-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 18px 40px rgba(0,0,0,0.16);
        }

        .vehicle-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .vehicle-body {
            padding: 24px;
        }

        .vehicle-body h3 {
            font-family: Georgia, serif;
            font-size: 28px;
            margin: 0 0 12px;
        }

        .vehicle-info {
            color: #444;
            line-height: 1.7;
            margin-bottom: 18px;
        }

        .price {
            font-size: 20px;
            font-weight: bold;
            color: #4169c1;
            margin-bottom: 18px;
        }

        .card-btn {
            display: inline-block;
            background: #4169c1;
            color: white;
            text-decoration: none;
            padding: 13px 18px;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.3s;
        }

        .card-btn:hover {
            background: #102235;
        }

        .slider-arrow {
            position: absolute;
            top: 40%;
            transform: translateY(-50%);
            width: 46px;
            height: 46px;
            border-radius: 50%;
            border: none;
            background: white;
            color: #102235;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            z-index: 10;
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
        }

        .slider-arrow:hover {
            background: #4169c1;
            color: white;
        }

        .arrow-left {
            left: -18px;
        }

        .arrow-right {
            right: -18px;
        }

        .empty-box {
            background: white;
            padding: 35px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .service-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 28px;
        }

        .service-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(0,0,0,0.10);
            transition: 0.3s;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 45px rgba(0,0,0,0.18);
        }

        .service-card img {
            width: 100%;
            height: 190px;
            object-fit: cover;
        }

        .service-content {
            padding: 24px;
            text-align: center;
        }

        .service-content h3 {
            margin-top: 0;
            font-size: 23px;
        }

        .service-content p {
            color: #555;
            line-height: 1.6;
            min-height: 70px;
        }

        .service-content a {
            display: inline-block;
            background: #4169c1;
            color: white;
            padding: 11px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }

        .service-content a:hover {
            background: #102235;
        }

        .why {
            background: #102235;
            color: white;
            padding: 70px;
            margin-bottom: 0;
        }

        .why-grid {
            width: 92%;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            text-align: center;
        }

        .why-card {
            padding: 20px;
        }

        .why-card h3 {
            font-size: 34px;
            margin: 0;
            color: #9bb6ff;
        }

        .why-card p {
            margin-bottom: 0;
            color: #e8e8e8;
        }

        .footer {
            background: #071523;
            color: white;
            padding: 55px 70px 25px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.3fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 35px;
        }

        .footer h3 {
            margin-top: 0;
        }

        .footer p,
        .footer a {
            color: #cfd8e3;
            line-height: 1.8;
            text-decoration: none;
            display: block;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.15);
            padding-top: 20px;
            text-align: center;
            color: #b6c2cf;
        }

        @media(max-width: 1000px) {
            .topbar,
            .navbar,
            .hero,
            .footer {
                padding-left: 25px;
                padding-right: 25px;
            }

            .hero-content h1 {
                font-size: 46px;
            }

            .search-box {
                width: 92%;
            }

            .search-row {
                grid-template-columns: 1fr;
            }

            .vehicle-card {
                min-width: calc(50% - 14px);
                max-width: calc(50% - 14px);
            }

            .service-grid,
            .why-grid,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .navlinks {
                flex-wrap: wrap;
                justify-content: center;
            }
        }

        @media(max-width: 650px) {
            .vehicle-card {
                min-width: 100%;
                max-width: 100%;
            }

            .arrow-left {
                left: 8px;
            }

            .arrow-right {
                right: 8px;
            }
        }
    </style>
</head>
<body>

<div class="topbar">
    <div>📞 +94 76 684 0073 | ✉️ info@vehiclerental.com</div>
    <div>Cloud-Based Vehicle Rental Management System</div>
</div>

<div class="navbar">
    <div class="logo">VEHICLE <span>RENT-A-CAR</span></div>

    <div class="navlinks">
        <a href="{{ route('home') }}">HOME</a>
        <a href="#fleet">VEHICLE COLLECTION</a>
        <a href="#services">SERVICES</a>
        <a href="#contact">CONTACT</a>

        @if(auth()->check())
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="btn-login">ADMIN PANEL</a>
            @else
                <a href="{{ route('my.bookings') }}">MY BOOKINGS</a>
            @endif

            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button class="logout-btn" type="submit">LOGOUT</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn-login">LOGIN</a>
        @endif
    </div>
</div>

<section class="hero">
    <div class="hero-content">
        <div class="small">FAST • SAFE • RELIABLE</div>
        <h1>Find Your Perfect Rental Vehicle</h1>
        <p>
            Browse available cars, vans, SUVs and bikes. Submit your booking request online
            and track approval status through your customer account.
        </p>

        <div class="hero-buttons">
            <a href="#fleet" class="hero-btn hero-primary">VIEW VEHICLES</a>
            <a href="#services" class="hero-btn hero-secondary">OUR SERVICES</a>
        </div>
    </div>
</section>

<div class="search-box">
    <div class="tabs">
        <a class="{{ request('service') == '' ? 'active' : '' }}"
           href="{{ route('vehicles.index') }}">
            All
        </a>

        <a class="{{ request('service') == 'self_drive' ? 'active' : '' }}"
           href="{{ route('vehicles.index', ['service' => 'self_drive']) }}">
            Self Drive
        </a>

        <a class="{{ request('service') == 'with_driver' ? 'active' : '' }}"
           href="{{ route('vehicles.index', ['service' => 'with_driver']) }}">
            With Driver
        </a>

        <a class="{{ request('service') == 'wedding_car' ? 'active' : '' }}"
           href="{{ route('vehicles.index', ['service' => 'wedding_car']) }}">
            Wedding Car
        </a>
    </div>

    <form method="GET" action="{{ route('vehicles.index') }}">
        @if(request('service'))
            <input type="hidden" name="service" value="{{ request('service') }}">
        @endif

        <div class="search-row">
            <input
                type="text"
                name="location"
                placeholder="Enter pickup location"
                value="{{ request('location') }}"
            >

            <select name="type">
                <option value="">All Vehicle Types</option>
                <option value="Car" {{ request('type') == 'Car' ? 'selected' : '' }}>Car</option>
                <option value="Van" {{ request('type') == 'Van' ? 'selected' : '' }}>Van</option>
                <option value="SUV" {{ request('type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                <option value="Bike" {{ request('type') == 'Bike' ? 'selected' : '' }}>Bike</option>
                <option value="Wedding Car" {{ request('type') == 'Wedding Car' ? 'selected' : '' }}>Wedding Car</option>
            </select>

            <button type="submit">SEARCH VEHICLES</button>
        </div>
    </form>
</div>

<section class="section" id="fleet">
    <div class="section-title">
        <div class="mini">VEHICLE COLLECTION</div>
        <h2>A Fleet That Meets Your Needs</h2>
        <div class="line"></div>
    </div>

    @php
        $selfDriveVehicles = $vehicles->filter(function($vehicle) {
            return in_array($vehicle->vehicle_type, ['Car', 'SUV']);
        });

        $bikeVehicles = $vehicles->filter(function($vehicle) {
            return $vehicle->vehicle_type == 'Bike';
        });

        $withDriverVehicles = $vehicles->filter(function($vehicle) {
            return $vehicle->vehicle_type == 'Van';
        });

        $weddingVehicles = $vehicles->filter(function($vehicle) {
            return $vehicle->vehicle_type == 'Wedding Car';
        });
    @endphp

    @if($vehicles->count() == 0)
        <div class="empty-box">
            <h3>No vehicles found</h3>
            <p>Please try another location or vehicle type.</p>
            <a class="card-btn" href="{{ route('vehicles.index') }}">View All Vehicles</a>
        </div>
    @endif

    @if($selfDriveVehicles->count() > 0)
        <div class="category-section">
            <div class="category-header">
                <div>
                    <h3>Self Drive Vehicles</h3>
                    <p>Cars and SUVs available for personal rental and daily travel.</p>
                </div>
            </div>

            <div class="slider-wrap">
                @if($selfDriveVehicles->count() > 3)
                    <button class="slider-arrow arrow-left" onclick="slideCategory('selfDriveSlider', -1)">‹</button>
                    <button class="slider-arrow arrow-right" onclick="slideCategory('selfDriveSlider', 1)">›</button>
                @endif

                <div class="vehicle-slider" id="selfDriveSlider">
                    @foreach($selfDriveVehicles as $vehicle)
                        <div class="vehicle-card">
                            @if($vehicle->image_path)
                                <img src="{{ asset('storage/' . $vehicle->image_path) }}" alt="Vehicle Image">
                            @else
                                <img src="https://images.unsplash.com/photo-1549924231-f129b911e442?auto=format&fit=crop&w=900&q=80" alt="Vehicle Image">
                            @endif

                            <div class="vehicle-body">
                                <h3>{{ $vehicle->vehicle_name }}</h3>

                                <div class="vehicle-info">
                                    <strong>Type:</strong> {{ $vehicle->vehicle_type }} <br>
                                    <strong>Brand:</strong> {{ $vehicle->brand }} {{ $vehicle->model }} <br>
                                    <strong>Location:</strong> {{ $vehicle->location }}
                                </div>

                                <div class="price">Rs. {{ $vehicle->price_per_day }} / Day</div>

                                <a class="card-btn" href="{{ route('vehicles.show', $vehicle) }}">
                                    View & Book →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if($bikeVehicles->count() > 0)
        <div class="category-section">
            <div class="category-header">
                <div>
                    <h3>Bikes & Super Bikes</h3>
                    <p>Affordable bikes and premium super bikes for self-drive rental.</p>
                </div>
            </div>

            <div class="slider-wrap">
                @if($bikeVehicles->count() > 3)
                    <button class="slider-arrow arrow-left" onclick="slideCategory('bikeSlider', -1)">‹</button>
                    <button class="slider-arrow arrow-right" onclick="slideCategory('bikeSlider', 1)">›</button>
                @endif

                <div class="vehicle-slider" id="bikeSlider">
                    @foreach($bikeVehicles as $vehicle)
                        <div class="vehicle-card">
                            @if($vehicle->image_path)
                                <img src="{{ asset('storage/' . $vehicle->image_path) }}" alt="Vehicle Image">
                            @else
                                <img src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=900&q=80" alt="Bike Image">
                            @endif

                            <div class="vehicle-body">
                                <h3>{{ $vehicle->vehicle_name }}</h3>

                                <div class="vehicle-info">
                                    <strong>Type:</strong> {{ $vehicle->vehicle_type }} <br>
                                    <strong>Brand:</strong> {{ $vehicle->brand }} {{ $vehicle->model }} <br>
                                    <strong>Location:</strong> {{ $vehicle->location }}
                                </div>

                                <div class="price">Rs. {{ $vehicle->price_per_day }} / Day</div>

                                <a class="card-btn" href="{{ route('vehicles.show', $vehicle) }}">
                                    View & Book →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if($withDriverVehicles->count() > 0)
        <div class="category-section">
            <div class="category-header">
                <div>
                    <h3>Vehicles With Driver</h3>
                    <p>Vans and passenger vehicles available with driver support.</p>
                </div>
            </div>

            <div class="slider-wrap">
                @if($withDriverVehicles->count() > 3)
                    <button class="slider-arrow arrow-left" onclick="slideCategory('driverSlider', -1)">‹</button>
                    <button class="slider-arrow arrow-right" onclick="slideCategory('driverSlider', 1)">›</button>
                @endif

                <div class="vehicle-slider" id="driverSlider">
                    @foreach($withDriverVehicles as $vehicle)
                        <div class="vehicle-card">
                            @if($vehicle->image_path)
                                <img src="{{ asset('storage/' . $vehicle->image_path) }}" alt="Vehicle Image">
                            @else
                                <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&w=900&q=80" alt="Van Image">
                            @endif

                            <div class="vehicle-body">
                                <h3>{{ $vehicle->vehicle_name }}</h3>

                                <div class="vehicle-info">
                                    <strong>Type:</strong> {{ $vehicle->vehicle_type }} <br>
                                    <strong>Brand:</strong> {{ $vehicle->brand }} {{ $vehicle->model }} <br>
                                    <strong>Location:</strong> {{ $vehicle->location }}
                                </div>

                                <div class="price">Rs. {{ $vehicle->price_per_day }} / Day</div>

                                <a class="card-btn" href="{{ route('vehicles.show', $vehicle) }}">
                                    View & Book →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if($weddingVehicles->count() > 0)
        <div class="category-section">
            <div class="category-header">
                <div>
                    <h3>Wedding Car Collection</h3>
                    <p>Luxury vehicles for weddings, photoshoots, VIP travel and special events.</p>
                </div>
            </div>

            <div class="slider-wrap">
                @if($weddingVehicles->count() > 3)
                    <button class="slider-arrow arrow-left" onclick="slideCategory('weddingSlider', -1)">‹</button>
                    <button class="slider-arrow arrow-right" onclick="slideCategory('weddingSlider', 1)">›</button>
                @endif

                <div class="vehicle-slider" id="weddingSlider">
                    @foreach($weddingVehicles as $vehicle)
                        <div class="vehicle-card">
                            @if($vehicle->image_path)
                                <img src="{{ asset('storage/' . $vehicle->image_path) }}" alt="Vehicle Image">
                            @else
                                <img src="https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&w=900&q=80" alt="Wedding Car Image">
                            @endif

                            <div class="vehicle-body">
                                <h3>{{ $vehicle->vehicle_name }}</h3>

                                <div class="vehicle-info">
                                    <strong>Type:</strong> {{ $vehicle->vehicle_type }} <br>
                                    <strong>Brand:</strong> {{ $vehicle->brand }} {{ $vehicle->model }} <br>
                                    <strong>Location:</strong> {{ $vehicle->location }}
                                </div>

                                <div class="price">Rs. {{ $vehicle->price_per_day }} / Day</div>

                                <a class="card-btn" href="{{ route('vehicles.show', $vehicle) }}">
                                    View & Book →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</section>

<section class="section" id="services">
    <div class="section-title">
        <div class="mini">WHAT WE OFFER</div>
        <h2>Our Services</h2>
        <div class="line"></div>
    </div>

    <div class="service-grid">
        <div class="service-card">
            <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=900&q=80" alt="Self Drive">
            <div class="service-content">
                <h3>Self Drive</h3>
                <p>Rent clean and comfortable cars, SUVs and bikes for personal travel and daily use.</p>
                <a href="{{ route('vehicles.index', ['service' => 'self_drive']) }}">View Self Drive →</a>
            </div>
        </div>

        <div class="service-card">
            <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&w=900&q=80" alt="With Driver">
            <div class="service-content">
                <h3>With Driver</h3>
                <p>Book vans and passenger vehicles with driver support for comfortable journeys.</p>
                <a href="{{ route('vehicles.index', ['service' => 'with_driver']) }}">View With Driver →</a>
            </div>
        </div>

        <div class="service-card">
            <img src="https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?auto=format&fit=crop&w=900&q=80" alt="Luxury SUV">
            <div class="service-content">
                <h3>Luxury / SUV</h3>
                <p>Choose premium SUVs for long trips, family tours and business travel.</p>
                <a href="{{ route('vehicles.index', ['service' => 'self_drive']) }}">View SUVs →</a>
            </div>
        </div>

        <div class="service-card">
            <img src="https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&w=900&q=80" alt="Wedding Car">
            <div class="service-content">
                <h3>Wedding Cars</h3>
                <p>Luxury cars for weddings, photoshoots, VIP travel and special occasions.</p>
                <a href="{{ route('vehicles.index', ['service' => 'wedding_car']) }}">View Wedding Cars →</a>
            </div>
        </div>
    </div>
</section>

<section class="why">
    <div class="why-grid">
        <div class="why-card">
            <h3>{{ $vehicles->count() }}</h3>
            <p>Available Vehicles</p>
        </div>

        <div class="why-card">
            <h3>24/7</h3>
            <p>Online Booking Access</p>
        </div>

        <div class="why-card">
            <h3>Fast</h3>
            <p>Admin Approval Process</p>
        </div>

        <div class="why-card">
            <h3>Secure</h3>
            <p>Customer Login System</p>
        </div>
    </div>
</section>

<footer class="footer" id="contact">
    <div class="footer-grid">
        <div>
            <h3>Vehicle Rent-A-Car</h3>
            <p>
                A cloud-based vehicle rental management system for browsing vehicles,
                submitting booking requests, and tracking rental status online.
            </p>
        </div>

        <div>
            <h3>Quick Links</h3>
            <a href="{{ route('home') }}">Home</a>
            <a href="#fleet">Vehicle Collection</a>
            <a href="#services">Services</a>

            @if(auth()->check())
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
                @else
                    <a href="{{ route('my.bookings') }}">My Bookings</a>
                @endif
            @else
                <a href="{{ route('login') }}">Login</a>
            @endif
        </div>

        <div>
            <h3>Contact</h3>
            <p>Phone: +94 76 684 0073</p>
            <p>Email: info@vehiclerental.com</p>
            <p>Location: Colombo, Sri Lanka</p>
        </div>
    </div>

    <div class="footer-bottom">
        © {{ date('Y') }} Vehicle Rent-A-Car. Developed for Azure Cloud Application Project.
    </div>
</footer>

<script>
    function slideCategory(sliderId, direction) {
        const slider = document.getElementById(sliderId);

        if (!slider) {
            return;
        }

        const card = slider.querySelector('.vehicle-card');

        if (!card) {
            return;
        }

        const gap = 28;
        const scrollAmount = card.offsetWidth + gap;

        slider.scrollBy({
            left: direction * scrollAmount,
            behavior: 'smooth'
        });
    }
</script>

</body>
</html>