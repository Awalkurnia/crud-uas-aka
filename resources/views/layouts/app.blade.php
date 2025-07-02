<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Streaming Awalkurnia</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/DataTables-1.13.3/css/dataTables.bootstrap5.css') }}">
</head>
<body>
    <div class="d-flex" style="min-height: 100vh;">
        <!-- Sidebar -->
        <div class="bg-secondary text-white p-3 d-flex flex-column justify-content-between" style="min-height: 100vh; width: 220px;">
            <div>
                <div class="mb-4 text-center">
                    <img src="{{ secure_asset('assets/image/Logo Aka2.png') }}" style="max-width: 120px; height:auto;" alt="">
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="/" class="btn btn-outline-light w-100 text-start mb-2"><i class="bi bi-house-door-fill me-2"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('jadwal_live_streaming') }}" class="btn btn-outline-light w-100 text-start"><i class="bi bi-broadcast me-2"></i> Data Jadwal Live Streaming</a>
                    </li>
                </ul>
            </div>
            <!-- Tombol Logout di bawah sidebar -->
            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100">Logout</button>
            </form>
        </div>

        <!-- Konten Utama -->
        <div class="flex-fill">
            <!-- Navbar -->
            <nav class="navbar navbar-light bg-white shadow-sm px-4">
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <button class="btn btn-outline-primary d-md-none" onclick="toggleSidebar()">
                        <i class="bi bi-list"></i>
                    </button>
                    <span class="navbar-brand fw-bold">Jadwal Live Streaming Awalkurnia</span>
                    <span class="text-muted">Selamat Datang, {{ Auth::user()->name }}</span>
                </div>
            </nav>

            <!-- Konten -->
            <div class="p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ secure_asset('assets/jquery-3.6.1.js') }}"></script>
    <script src="{{ secure_asset('assets/bootstrap.min.js') }}"></script>
    <script src="{{ secure_asset('assets/DataTables-1.13.3/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ secure_asset('assets/DataTables-1.13.3/js/dataTables.bootstrap5.min.js') }}"></script>

    @yield('scripts')
</body>
</html>