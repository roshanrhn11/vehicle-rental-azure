<!DOCTYPE html>
<html>
<head>
    <title>Customer Register - Vehicle Rent-A-Car</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
        }

        .page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
        }

        .left {
            background:
                linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)),
                url('https://images.unsplash.com/photo-1549924231-f129b911e442?auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand {
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .brand span {
            display: block;
            font-size: 13px;
            font-weight: normal;
            letter-spacing: 2px;
            margin-top: 5px;
        }

        .hero-text h1 {
            font-family: Georgia, serif;
            font-size: 54px;
            line-height: 1.1;
            margin: 0 0 20px;
        }

        .hero-text p {
            font-size: 18px;
            line-height: 1.7;
            max-width: 650px;
        }

        .right {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: #ffffff;
        }

        .register-box {
            width: 430px;
        }

        .register-box h2 {
            font-size: 34px;
            margin-bottom: 8px;
            color: #111;
        }

        .register-box .sub {
            color: #666;
            margin-bottom: 28px;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 14px;
            border: 1px solid #d7d7d7;
            border-radius: 4px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #4169c1;
        }

        .register-btn {
            width: 100%;
            background: #4169c1;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
            margin-top: 5px;
        }

        .register-btn:hover {
            background: #2f55a8;
        }

        .links {
            margin-top: 22px;
            text-align: center;
            color: #555;
        }

        .links a {
            color: #4169c1;
            font-weight: bold;
            text-decoration: none;
        }

        .back {
            margin-top: 18px;
            text-align: center;
        }

        .back a {
            color: #333;
            text-decoration: none;
            font-size: 14px;
        }

        .error {
            background: #ffe8e8;
            color: #b00000;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 18px;
        }

        @media(max-width: 900px) {
            .page {
                grid-template-columns: 1fr;
            }

            .left {
                min-height: 330px;
                padding: 35px;
            }

            .hero-text h1 {
                font-size: 38px;
            }
        }
    </style>
</head>
<body>

<div class="page">
    <div class="left">
        <div class="brand">
            VEHICLE RENT-A-CAR
            <span>Cloud-Based Vehicle Rental System</span>
        </div>

        <div class="hero-text">
            <h1>Create Your<br>Rental Account</h1>
            <p>
                Register as a customer to browse available vehicles,
                submit booking requests, and track rental status online.
            </p>
        </div>

        <div>
            Secure Online Vehicle Rental Booking
        </div>
    </div>

    <div class="right">
        <div class="register-box">
            <h2>Customer Register</h2>
            <p class="sub">Create a new customer account to start booking rental vehicles.</p>

            @if ($errors->any())
                <div class="error">
                    @foreach ($errors->all() as $error)
                        <p style="margin:0 0 5px;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register.submit') }}">
                @csrf
                @if(request('redirect'))
    <input type="hidden" name="redirect" value="{{ request('redirect') }}">
@endif

                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="Enter your full name" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Create password" required>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm password" required>
                </div>

                <button class="register-btn" type="submit">REGISTER</button>
            </form>

            <div class="links">
              Already have an account?
<a href="{{ route('login', request('redirect') ? ['redirect' => request('redirect')] : []) }}">
    Login here
</a>
            </div>

            <div class="back">
                <a href="{{ route('home') }}">← Back to Home</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>