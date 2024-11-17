<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email',
            'schoolName' => 'required|string|max:255',
            'selectDate' => 'required|date',
            'selectTime' => 'required',
        ]);

        Booking::create([
            'full_name' => $validated['fullName'],
            'email' => $validated['email'],
            'school_name' => $validated['schoolName'],
            'booking_date' => $validated['selectDate'],
            'booking_time' => $validated['selectTime'],
        ]);

        return response()->json(['message' => 'Booking successful!']);
    }
}
