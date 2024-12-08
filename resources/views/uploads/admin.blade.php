@extends('layouts.app')



@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>User File Management</h2>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>User</th>
            <th>File Name</th>
            <th>Upload Time</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($uploads as $upload)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $upload->user->name }}</td> 
                <td>{{ $upload->file_name }}</td>
                <td>{{ $upload->created_at }}</td>
                <td>
                    <a href="{{ route('uploads.download', $upload->id) }}" class="btn btn-sm btn-primary">Download</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No File Upload Records</td>
            </tr>
        @endforelse
        </tbody>
    </table>

@endsection
