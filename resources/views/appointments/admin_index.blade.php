@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Appointment Management</h2>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>User</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($appointments as $appointment)
            <tr>
                <td>{{ $appointment->user->name }}</td>
                <td>{{ $appointment->date }}</td>
                <td>{{ $appointment->time }}</td>
                <td>{{ $appointment->status }}</td>
                <td>
                    <form action="{{ route('admin.appointments.updateStatus', $appointment) }}" method="POST" style="display: flex; align-items: center; gap: 10px;">
                        @csrf
                        <select name="status" class="form-control" style="width: auto;">
                            <option value="pending" @if($appointment->status == 'pending') selected @endif>Pending</option>
                            <option value="approved" @if($appointment->status == 'approved') selected @endif>Approved</option>
                            <option value="rejected" @if($appointment->status == 'rejected') selected @endif>Rejected</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
