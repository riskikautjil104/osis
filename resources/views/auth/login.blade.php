<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - OSIS SMA 5 Morotai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #04342C 0%, #0F6E56 50%, #1D9E75 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        /* Background pattern */
        body::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            background-repeat: repeat;
            pointer-events: none;
        }
        
        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 24px;
            padding: 40px 35px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
        }
        
        .logo-area {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #0F6E56, #1D9E75);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 10px 20px -5px rgba(15, 110, 86, 0.3);
        }
        
        .logo-icon i {
            font-size: 28px;
            color: white;
        }
        
        .logo-text {
            font-family: 'Syne', sans-serif;
            font-size: 20px;
            font-weight: 800;
            color: #0F6E56;
        }
        
        .logo-sub {
            font-size: 11px;
            color: #666;
            margin-top: 5px;
        }
        
        .login-title {
            font-family: 'Syne', sans-serif;
            font-size: 24px;
            font-weight: 700;
            color: #111;
            margin-bottom: 8px;
            text-align: center;
        }
        
        .login-subtitle {
            font-size: 13px;
            color: #666;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }
        
        .input-group-custom {
            border-radius: 12px;
            overflow: hidden;
            border: 1.5px solid #e0e0e0;
            transition: all 0.3s;
            background: white;
        }
        
        .input-group-custom:focus-within {
            border-color: #0F6E56;
            box-shadow: 0 0 0 3px rgba(15, 110, 86, 0.1);
        }
        
        .input-group-text-custom {
            background: transparent;
            border: none;
            color: #0F6E56;
            padding: 12px 15px;
        }
        
        .form-control-custom {
            border: none;
            padding: 12px 15px 12px 0;
            font-size: 14px;
        }
        
        .form-control-custom:focus {
            box-shadow: none;
            outline: none;
        }
        
        .btn-login {
            background: linear-gradient(135deg, #0F6E56, #1D9E75);
            border: none;
            padding: 14px;
            font-weight: 600;
            font-size: 14px;
            border-radius: 12px;
            transition: all 0.3s;
            width: 100%;
            margin-top: 10px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(15, 110, 86, 0.4);
        }
        
        .alert-custom {
            border-radius: 12px;
            font-size: 13px;
            padding: 12px 15px;
            margin-bottom: 20px;
        }
        
        .security-note {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            font-size: 11px;
            color: #999;
        }
        
        .security-note i {
            color: #0F6E56;
            margin-right: 5px;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        .shake {
            animation: shake 0.3s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo-area">
                <div class="logo-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="logo-text">OSIS SMA 5 Morotai</div>
                <div class="logo-sub">Admin Area</div>
            </div>
            
            <div class="login-title">Akses Dashboard</div>
            <div class="login-subtitle">Masukkan kredensial Anda untuk melanjutkan</div>
            
            @if(session('error'))
                <div class="alert alert-danger alert-custom" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger alert-custom shake" role="alert">
                    <i class="fas fa-times-circle me-2"></i> {{ $errors->first() }}
                </div>
            @endif
            
            @if(session('success'))
                <div class="alert alert-success alert-custom" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <div class="input-group-custom d-flex align-items-center">
                        <span class="input-group-text-custom">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" name="email" class="form-control form-control-custom" 
                               placeholder="admin@osis-sma5.sch.id" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group-custom d-flex align-items-center">
                        <span class="input-group-text-custom">
                            <i class="fas fa-key"></i>
                        </span>
                        <input type="password" name="password" class="form-control form-control-custom" 
                               placeholder="••••••••" required>
                    </div>
                </div>
                
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label small" for="remember">Ingat saya</label>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-login text-white">
                    <i class="fas fa-sign-in-alt me-2"></i> Masuk ke Dashboard
                </button>
            </form>
            
            <div class="security-note">
                <i class="fas fa-shield-alt"></i> Area aman untuk administrator OSIS<br>
                Akses terbatas - Semua aktivitas tercatat
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>