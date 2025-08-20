<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - MI Diponegoro 03 Karangklesem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2e7d32;
            --primary-light: #4caf50;
            --primary-lighter: #81c784;
            --primary-dark: #1b5e20;
            --secondary-color: #ffffff;
            --accent-color: #8bc34a;
            --light-bg: #f5f7fa;
            --card-shadow: 0 4px 20px rgba(0,0,0,0.08);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            background-image: url('https://images.unsplash.com/photo-1544717305-2782549b5136?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(46, 125, 50, 0.7);
            z-index: 0;
        }

        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 450px;
            padding: 0 15px;
        }

        .login-card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            background-color: white;
            transition: var(--transition);
        }

        .login-card:hover {
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            transform: translateY(-5px);
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
            padding: 30px 20px;
            text-align: center;
            color: white;
        }

        .login-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
            object-fit: contain;
        }

        .login-title {
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 1.5rem;
        }

        .login-subtitle {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .login-body {
            padding: 30px;
        }

        .form-control {
            height: 45px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            padding-left: 40px;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(46, 125, 50, 0.25);
        }

        .input-group-text {
            background-color: transparent;
            border: none;
            position: absolute;
            left: 0;
            top: 0;
            height: 45px;
            z-index: 4;
            color: var(--primary-color);
        }

        .input-group {
            position: relative;
        }

        .input-group .form-control {
            padding-left: 40px;
        }

        .btn-login {
            background-color: var(--primary-color);
            border: none;
            height: 45px;
            border-radius: 8px;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-login:hover {
            background-color: var(--primary-dark);
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .forgot-password:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .login-footer {
            text-align: center;
            padding: 15px;
            font-size: 0.8rem;
            color: #6c757d;
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        /* Custom Checkbox */
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Responsive */
        @media (max-width: 576px) {
            .login-card {
                margin-top: 20px;
            }
            
            .login-header {
                padding: 20px;
            }
            
            .login-body {
                padding: 20px;
            }
            
            .login-logo {
                width: 60px;
                height: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container animate-fade-in">
        <div class="login-card">
            <div class="login-header">
                <img src="{{ asset('gambar/logobaru.png') }}" alt="MI Diponegoro 03" class="login-logo">
                <h2 class="login-title">PORTAL ADMIN</h2>
                <p class="login-subtitle">MI Diponegoro 03 Karangklesem</p>
            </div>
            
            <div class="login-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan email anda">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password" placeholder="Masukkan password anda">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Ingat saya
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="forgot-password" href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif
                    </div>
                    
                    <button type="submit" class="btn btn-login btn-primary w-100">
                        <i class="fas fa-sign-in-alt me-2"></i> LOGIN
                    </button>
                </form>
            </div>
            
            <div class="login-footer">
                &copy; {{ date('Y') }} MI Diponegoro 03. All rights reserved.
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
        // Animation for form elements
        document.querySelectorAll('.form-control').forEach((input, index) => {
            input.style.animationDelay = `${0.1 * index}s`;
            input.classList.add('animate-fade-in');
        });
        
        // Focus on email field when page loads
        document.getElementById('email')?.focus();
    </script>
</body>
</html>


