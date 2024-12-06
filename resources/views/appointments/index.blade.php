@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>My Appointments</h2>
        <a href="{{ route('appointments.create') }}" class="btn btn-primary">Create Appointment</a>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($appointments as $appointment)
            <tr>
                <td>{{ $appointment->date }}</td>
                <td>{{ $appointment->time }}</td>
                <td>{{ $appointment->status }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
