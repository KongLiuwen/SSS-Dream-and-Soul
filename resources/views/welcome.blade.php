@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="text-center">
            <h1 class="display-4">Welcome to the Mental Health Platform</h1>
            <p class="lead">A web platform supporting mental health, offering article reading, mood diary recording, and psychological consultation appointments.</p>
        </div>

        @auth
            @if (auth()->user()->role == 'admin')
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white">
                        <h2 class="h4 mb-0">Admin Features</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="{{ route('categories.index') }}" class="text-decoration-none">Article Categories</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('articles.index') }}" class="text-decoration-none">Article List</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ url('/admin/appointments') }}" class="text-decoration-none">Appointment Management</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('admin.uploads.index') }}" class="text-decoration-none">File Download</a>
                            </li>
                        </ul>
                    </div>
                </div>
            @else
                <div class="card mt-5">
                    <div class="card-header bg-success text-white">
                        <h2 class="h4 mb-0">User Features</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="{{ route('articles.index') }}" class="text-decoration-none">Article List</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('mood-diaries.index') }}" class="text-decoration-none">Mood Diary</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ url('/mood-diaries/chart') }}" class="text-decoration-none">Mood Trends</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('appointments.index') }}" class="text-decoration-none">Appointment Submission</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('uploads.index') }}" class="text-decoration-none">File Upload</a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
        @else
            <div class="text-center mt-5 mb-5">
                <h2 class="h4">Please log in or register to use platform features</h2>
                <div class="mt-3">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg mx-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg mx-2">Register</a>
                </div>
            </div>
        @endauth
    </div>
@endsection
