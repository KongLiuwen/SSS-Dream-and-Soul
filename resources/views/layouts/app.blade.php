<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mental Health Platform')</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="pt-4 py-4 navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">Mental Health Platform</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>

                    @if (auth()->user()->role == 'admin')
                        <!-- 管理员功能 -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.index') }}">Article Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('articles.index') }}">Article List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/admin/appointments') }}">Appointment Management</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.uploads.index') }}">File Download</a>
                        </li>
                    @else
                        <!-- 普通User Features -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('articles.index') }}">Article List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mood-diaries.index') }}">Mood Diary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/mood-diaries/chart') }}">Mood Trends</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('appointments.index') }}">Appointment Submission</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('uploads.index') }}">File Upload</a>
                        </li>
                    @endif

                    <!-- 公共功能 -->
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-link nav-link" type="submit">Logout</button>
                        </form>
                    </li>
                @else
                    <!-- 未LoginUser Features -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container pt-5  py-5" style="margin: 50px auto; padding: 20px; background-color: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: auto">
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>

<div class="pt-2 bg-primary fixed-bottom" style="box-shadow: 0 -0.5rem 1rem rgba(0, 0, 0, 0.15);">
</div>

@yield('scripts')
<!-- Bootstrap JS -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 获取所有带有 'alert' 类名的元素
        var alerts = document.getElementsByClassName('alert');

        // 遍历每个 alert 元素
        for (var i = 0; i < alerts.length; i++) {
            (function(alert) {
                // 设置定时器，3秒后隐藏
                setTimeout(function () {
                    alert.style.transition = 'opacity 0.5s ease'; // 添加淡出效果
                    alert.style.opacity = '0'; // 设置透明度为 0
                    setTimeout(function () {
                        alert.remove(); // 完全隐藏后移除元素
                    }, 500); // 等待淡出效果完成后移除
                }, 500); // 3秒后开始隐藏
            })(alerts[i]);
        }
    });

</script>

</body>
</html>
