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
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                        url('{{ secure_asset('assets/gunung.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .register-box {
            background: rgba(255, 255, 255, 0.12);
            border-radius: 18px;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 35px 45px;
            width: 100%;
            max-width: 460px;
            animation: fadeIn 1s ease;
        }

        .register-box h4 {
            text-align: center;
            font-weight: 700;
            margin-bottom: 25px;
            color: #fff;
        }

        .form-label {
            font-weight: 600;
            color: #f0f0f0;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            border: none;
            padding-left: 2.5rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.3);
        }

        .icon-input {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .input-group {
            position: relative;
        }

        .btn-register {
            border-radius: 12px;
            font-weight: 600;
            padding: 10px;
        }

        .text-small {
            font-size: 0.875rem;
            color: #ddd;
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
<body>
    <div class="register-box">
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
