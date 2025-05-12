<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Get all appointments
    public function index()
    {
        $appointments = Appointment::with('customer', 'pet')->get();
        return response()->json($appointments, 200);
    }

    // Get a single appointment by ID
    public function show($id)
    {
        $appointment = Appointment::with('customer', 'pet')->find($id);
        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }
        return response()->json($appointment, 200);
    }

    // Store a new appointment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'pet_id' => 'required|exists:pets,id',
            'scheduled_at' => 'required|date',
            'service_type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $appointment = Appointment::create($validated);

        return response()->json([
            'message' => 'Appointment created successfully',
            'appointment' => $appointment
        ], 201);
    }

    // Update an existing appointment
    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'pet_id' => 'required|exists:pets,id',
            'scheduled_at' => 'required|date',
            'service_type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $appointment->update($validated);

        return response()->json([
            'message' => 'Appointment updated successfully',
            'appointment' => $appointment
        ], 200);
    }

    // Delete an appointment
    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $appointment->delete();

        return response()->json(['message' => 'Appointment deleted successfully'], 200);
    }
}
