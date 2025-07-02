{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem</title>
    
    <link rel="stylesheet" href="{{ asset('assets/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            /* background diatur inline agar url Blade tidak error di CSS */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .card-glass {
            background: rgba(255, 255, 255, 0.18);
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 36px 44px 30px 44px;
            width: 100%;
            max-width: 420px;
            animation: fadeInUp 1s ease;
        }

        .card-glass h4 {
            text-align: center;
            font-weight: 700;
            margin-bottom: 25px;
            color: #fff;
            letter-spacing: 1px;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.85);
            border: none;
            border-radius: 14px;
            padding-left: 2.5rem;
            font-size: 1.05rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.18);
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 1.2rem;
        }

        .btn-login {
            border-radius: 14px;
            font-weight: 600;
            padding: 11px;
            font-size: 1.08rem;
            box-shadow: 0 2px 8px 0 rgba(13, 110, 253, 0.10);
            transition: background 0.2s, box-shadow 0.2s;
        }
        .btn-login:hover {
            background: linear-gradient(90deg, #0d6efd 60%, #6610f2 100%);
            color: #fff;
            box-shadow: 0 4px 16px 0 rgba(13, 110, 253, 0.18);
        }

        .text-small {
            font-size: 0.92rem;
            color: #eee;
        }
        .text-small a {
            color: #ffc107;
        }
        .text-small a:hover {
            color: #fff;
            text-decoration: underline;
        }

        .logo-login {
            display: block;
            margin: 0 auto 18px auto;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            box-shadow: 0 2px 12px 0 rgba(0,0,0,0.18);
            object-fit: cover;
            background: #fff;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('assets/bg1.jpg') }}') no-repeat center center fixed; background-size: cover;">
    <div class="card-glass">
        <img src="{{ asset('assets/image/logo2.jpg') }}" alt="Logo" class="logo-login">
        <h4><i class="bi bi-lock-fill me-2"></i>Login Sistem</h4>

        @if ($errors->any())
            <div class="alert alert-danger p-2">
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3 position-relative">
                <i class="bi bi-envelope-fill input-icon"></i>
                <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
            </div>

            <div class="mb-3 position-relative">
                <i class="bi bi-shield-lock-fill input-icon"></i>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 btn-login">Masuk</button>
        </form>

        <div class="text-center mt-3">
            <span class="text-small">Belum punya akun? <a href="{{ route('register') }}" class="text-warning text-decoration-none">Daftar</a></span>
        </div>
    </div>

    <script src="{{ asset('assets/jquery-3.6.1.js') }}"></script>
    <script src="{{ asset('assets/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
