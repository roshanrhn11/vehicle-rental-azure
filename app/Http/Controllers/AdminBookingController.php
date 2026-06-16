<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Mail;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['vehicle', 'user'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function approve(Booking $booking)
    {
        $booking->update(['status' => 'approved']);

        $booking->load('vehicle');

        try {
            Mail::raw(
                "Dear {$booking->customer_name},\n\n" .
                "Your vehicle rental booking request has been APPROVED.\n\n" .
                "Booking Receipt\n" .
                "-------------------------\n" .
                "Booking Reference: {$booking->booking_reference}\n" .
                "Vehicle: {$booking->vehicle->vehicle_name}\n" .
                "Vehicle Type: {$booking->vehicle->vehicle_type}\n" .
                "Pickup Location: {$booking->vehicle->location}\n" .
                "Pickup Date: {$booking->pickup_date}\n" .
                "Return Date: {$booking->return_date}\n" .
                "Price Per Day: Rs. {$booking->vehicle->price_per_day}\n" .
                "Status: APPROVED\n\n" .
                "Please keep this booking reference for future communication.\n\n" .
                "Thank you,\n" .
                "Vehicle Rent-A-Car Admin Team",
                function ($message) use ($booking) {
                    $message->to($booking->customer_email)
                        ->subject('Vehicle Booking Approved - Receipt ' . $booking->booking_reference);
                }
            );
        } catch (\Exception $e) {
            return back()->with('success', 'Booking approved successfully, but email was not sent. Please check mail configuration.');
        }

        return back()->with('success', 'Booking approved successfully. Confirmation email sent to customer.');
    }

    public function reject(Booking $booking)
    {
        $booking->update(['status' => 'rejected']);

        $booking->load('vehicle');

        try {
            Mail::raw(
                "Dear {$booking->customer_name},\n\n" .
                "Your vehicle rental booking request has been REJECTED.\n\n" .
                "Booking Reference: {$booking->booking_reference}\n" .
                "Vehicle: {$booking->vehicle->vehicle_name}\n" .
                "Pickup Date: {$booking->pickup_date}\n" .
                "Return Date: {$booking->return_date}\n\n" .
                "Please contact admin for more details.\n\n" .
                "Thank you,\n" .
                "Vehicle Rent-A-Car Admin Team",
                function ($message) use ($booking) {
                    $message->to($booking->customer_email)
                        ->subject('Vehicle Booking Rejected - ' . $booking->booking_reference);
                }
            );
        } catch (\Exception $e) {
            return back()->with('success', 'Booking rejected successfully, but email was not sent. Please check mail configuration.');
        }

        return back()->with('success', 'Booking rejected successfully. Email sent to customer.');
    }
}