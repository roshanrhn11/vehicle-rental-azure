<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Booking;


class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'customer',
    ]);

    if ($request->filled('redirect')) {
        return redirect()->route('login', ['redirect' => $request->redirect])
            ->with('success', 'Registration successful. Please login to continue booking.');
    }

    return redirect()->route('login')->with('success', 'Registration successful. Please login.');
}

    public function showLogin()
    {
        return view('auth.login');
    }

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // If user came from View & Book button, redirect to booking confirmation page
        if ($request->filled('redirect')) {
            return redirect($request->redirect);
        }

        // If admin logs in from normal login
        if (auth()->user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        // Normal customer login from homepage
        return redirect()->route('home');
    }

    return back()->withErrors([
        'email' => 'Invalid email or password.',
    ])->withInput();
}

    public function showAdminLogin()
{
    return view('auth.admin-login');
}

public function adminLogin(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        if (auth()->user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        Auth::logout();

        return back()->withErrors([
            'email' => 'This account is not an admin account.',
        ]);
    }

    return back()->withErrors([
        'email' => 'Invalid admin email or password.',
    ]);
}

public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'Logged out successfully.');
}

public function dashboard()
{
    $totalVehicles = Vehicle::count();
    $availableVehicles = Vehicle::where('status', 'available')->count();
    $unavailableVehicles = Vehicle::where('status', 'unavailable')->count();

    $totalBookings = Booking::count();
    $pendingBookings = Booking::where('status', 'pending')->count();
    $approvedBookings = Booking::where('status', 'approved')->count();

    return view('admin.dashboard', compact(
        'totalVehicles',
        'availableVehicles',
        'unavailableVehicles',
        'totalBookings',
        'pendingBookings',
        'approvedBookings'
    ));
}
}