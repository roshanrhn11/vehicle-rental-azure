<!DOCTYPE html>
<html>
<head>
    <title>Customer Login - Vehicle Rent-A-Car</title>
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
                url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&q=80');
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

        .login-box {
            width: 420px;
        }

        .login-box h2 {
            font-size: 34px;
            margin-bottom: 8px;
            color: #111;
        }

        .login-box .sub {
            color: #666;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 18px;
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

        .login-btn {
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

        .login-btn:hover {
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

        .success {
            background: #e8fff0;
            color: #198754;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 18px;
        }

        @media(max-width: 900px) {
            .page {
                grid-template-columns: 1fr;
            }

            .left {
                min-height: 360px;
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
            <h1>Rent Your Vehicle<br>with Confidence</h1>
            <p>
                Login to browse vehicles, send rental booking requests,
                and track your booking status online.
            </p>
        </div>

        <div>
            Hotline: +94 (11) 2 365 365
        </div>
    </div>

    <div class="right">
        <div class="login-box">
            <h2>Customer Login</h2>
            <p class="sub">Access your account to book vehicles and manage your rental requests.</p>

            @if (session('success'))
                <div class="success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="error">
                    @foreach ($errors->all() as $error)
                        <p style="margin:0;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                @if(request('redirect'))
    <input type="hidden" name="redirect" value="{{ request('redirect') }}">
@endif

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>

                <button class="login-btn" type="submit">LOGIN</button>
            </form>

            <div class="links">
               New customer?
<a href="{{ route('register', request('redirect') ? ['redirect' => request('redirect')] : []) }}">
    Create an account
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