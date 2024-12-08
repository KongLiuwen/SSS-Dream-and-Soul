@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">File Upload</h2>
         
            <form action="{{ route('uploads.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="file" class="form-label">Select File</label>
                    <input type="file" name="file" id="file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
    
            <h2 class="mt-5">My Upload Records</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>File Name</th>
                    <th>Upload Time</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($uploads as $upload)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $upload->file_name }}</td>
                        <td>{{ $upload->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No Upload Records</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
