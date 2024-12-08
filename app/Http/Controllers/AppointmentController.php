<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    public function index()
    {
        $appointments = auth()->user()->appointments()->orderBy('date', 'asc')->get();
        return view('appointments.index', compact('appointments'));
    }


    public function create()
    {
        return view('appointments.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
        ]);

        Appointment::create([
            'user_id' => auth()->id(),
            'date' => $request->date,
            'time' => $request->time,
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment submitted, waiting for admin review.');
    }


    public function adminIndex()
    {
        $appointments = Appointment::with('user')->orderBy('date', 'asc')->get();
        return view('appointments.admin_index', compact('appointments'));
    }


    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $appointment->update(['status' => $request->status]);

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment status updated.');
    }
}

