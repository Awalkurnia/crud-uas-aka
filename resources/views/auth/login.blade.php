{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem</title>
    
    <link rel="stylesheet" href="{{ secure_asset('secure_assets/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('{{ secure_asset('assets/gunung.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .card-glass {
            background: rgba(255, 255, 255, 0.12);
            border-radius: 16px;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 30px 40px;
            width: 100%;
            max-width: 420px;
            animation: fadeInUp 1s ease;
        }

        .card-glass h4 {
            text-align: center;
            font-weight: 700;
            margin-bottom: 25px;
            color: #fff;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 12px;
            padding-left: 2.5rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .btn-login {
            border-radius: 12px;
            font-weight: 600;
            padding: 10px;
        }

        .text-small {
            font-size: 0.875rem;
            color: #ddd;
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
<body>
    <div class="card-glass">
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

    <script src="{{ secure_asset('assets/jquery-3.6.1.js') }}"></script>
    <script src="{{ secure_asset('assets/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
