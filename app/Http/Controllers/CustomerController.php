<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
public function vehicles(Request $request)
{
    $query = Vehicle::where('status', 'available');

    if ($request->filled('location')) {
        $query->where('location', 'like', '%' . $request->location . '%');
    }

    if ($request->filled('service')) {
        if ($request->service == 'self_drive') {
            $query->whereIn('vehicle_type', ['Car', 'SUV', 'Bike']);
        }

        if ($request->service == 'with_driver') {
            $query->where('vehicle_type', 'Van');
        }

        if ($request->service == 'wedding_car') {
            $query->where('vehicle_type', 'Wedding Car');
        }
    }

    if ($request->filled('type')) {
        $query->where('vehicle_type', $request->type);
    }

    $vehicles = $query->latest()->get();

    return view('vehicles.index', compact('vehicles'));
}

    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    public function bookingForm(Vehicle $vehicle)
{
    return view('vehicles.booking', compact('vehicle'));
}

    public function book(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'phone' => 'required|string|max:20',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:pickup_date',
            'license_document' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $existingBooking = Booking::where('user_id', auth()->id())
    ->where('vehicle_id', $vehicle->id)
    ->where('pickup_date', $request->pickup_date)
    ->where('return_date', $request->return_date)
    ->whereIn('status', ['pending', 'approved'])
    ->first();

if ($existingBooking) {
    return redirect()->route('my.bookings')
        ->with('success', 'You already submitted a booking request for this vehicle. Reference: ' . $existingBooking->booking_reference);
}

        $licensePath = null;

        if ($request->hasFile('license_document')) {
            $licensePath = $request->file('license_document')->store('licenses', 'public');
        }

        Booking::create([
            'user_id' => auth()->id(),
            'vehicle_id' => $vehicle->id,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'phone' => $request->phone,
            'pickup_date' => $request->pickup_date,
            'return_date' => $request->return_date,
            'license_document' => $licensePath,
            'booking_reference' => 'VR-' . strtoupper(Str::random(8)),
            'status' => 'pending',
        ]);

        return redirect()->route('my.bookings')->with('success', 'Booking request submitted successfully.');
    }

    public function myBookings()
    {
        $bookings = Booking::with('vehicle')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('bookings.my', compact('bookings'));
    }
}