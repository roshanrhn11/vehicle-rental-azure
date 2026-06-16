<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - Vehicle Rental System</title>
    <style>
        body { font-family: Arial; background:#eef2f7; }
        .box { width:400px; margin:80px auto; background:white; padding:25px; border-radius:10px; box-shadow:0 0 10px #ccc; }
        input { width:100%; padding:10px; margin:8px 0; }
        button { width:100%; padding:10px; background:#0d6efd; color:white; border:0; cursor:pointer; }
        .error { color:red; }
        a { color:#0d6efd; }
    </style>
</head>
<body>

<div class="box">
    <h2>Admin Login</h2>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <input type="email" name="email" placeholder="Admin Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login to Admin Panel</button>
    </form>

    <p><a href="{{ route('login') }}">Customer Login</a></p>
</div>

</body>
</html>