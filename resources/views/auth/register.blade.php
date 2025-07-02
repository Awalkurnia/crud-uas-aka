{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>

    <link rel="stylesheet" href="{{ secure_asset('assets/bootstrap.min.css') }}">
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

        .register-box {
            background: rgba(255, 255, 255, 0.18);
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 38px 48px 30px 48px;
            width: 100%;
            max-width: 460px;
            animation: fadeIn 1s ease;
        }

        .register-box h4 {
            text-align: center;
            font-weight: 700;
            margin-bottom: 25px;
            color: #fff;
            letter-spacing: 1px;
        }

        .form-label {
            font-weight: 600;
            color: #f0f0f0;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 14px;
            border: none;
            padding-left: 2.5rem;
            font-size: 1.05rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.18);
        }

        .icon-input {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 1.2rem;
        }

        .input-group {
            position: relative;
        }

        .btn-register {
            border-radius: 14px;
            font-weight: 600;
            padding: 11px;
            font-size: 1.08rem;
            box-shadow: 0 2px 8px 0 rgba(13, 110, 253, 0.10);
            transition: background 0.2s, box-shadow 0.2s;
        }
        .btn-register:hover {
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

        .logo-register {
            display: block;
            margin: 0 auto 18px auto;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            box-shadow: 0 2px 12px 0 rgba(0,0,0,0.18);
            object-fit: cover;
            background: #fff;
        }

        @keyframes fadeIn {
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
<body style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ secure_asset('assets/bg1.jpg') }}') no-repeat center center fixed; background-size: cover;">
    <div class="register-box">
        <img src="{{ secure_asset('assets/image/logo2.jpg') }}" alt="Logo" class="logo-register">
        <h4><i class="bi bi-person-plus-fill me-2"></i>Registrasi Akun</h4>

        @if(session('error'))
            <div class="alert alert-danger small">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger small">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li class="small">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-3 input-group">
                <i class="bi bi-person-fill icon-input"></i>
                <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" required autofocus>
            </div>

            <div class="mb-3 input-group">
                <i class="bi bi-envelope-fill icon-input"></i>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>

            <div class="mb-3 input-group">
                <i class="bi bi-lock-fill icon-input"></i>
                <input type="password" class="form-control" name="password" placeholder="Kata Sandi" required>
            </div>

            <div class="mb-3 input-group">
                <i class="bi bi-lock-fill icon-input"></i>
                <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Sandi" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 btn-register">Daftar</button>

            <p class="mt-3 text-center text-small">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-warning text-decoration-none">Login di sini</a>
            </p>
        </form>
    </div>

    <script src="{{ secure_asset('assets/jquery-3.6.1.js') }}"></script>
    <script src="{{ secure_asset('assets/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
