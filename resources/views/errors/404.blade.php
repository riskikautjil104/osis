<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
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
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 50%, #16213e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        /* Animated background */
        .glitch-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        
        .glitch-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(255, 255, 255, 0.03) 2px,
                rgba(255, 255, 255, 0.03) 4px
            );
            pointer-events: none;
        }
        
        .glitch-bg .circle {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(15,110,86,0.1) 0%, transparent 70%);
            animation: float 20s infinite;
        }
        
        .circle-1 { width: 300px; height: 300px; top: -150px; right: -150px; }
        .circle-2 { width: 500px; height: 500px; bottom: -250px; left: -250px; animation-delay: -5s; }
        .circle-3 { width: 200px; height: 200px; top: 50%; left: 20%; animation-delay: -10s; }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(30px, 20px) rotate(180deg); }
        }
        
        .error-container {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 20px;
        }
        
        .error-code {
            font-family: 'Syne', sans-serif;
            font-size: 180px;
            font-weight: 800;
            background: linear-gradient(135deg, #0F6E56, #1D9E75, #EF9F27);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-shadow: 0 0 30px rgba(15,110,86,0.3);
            letter-spacing: 20px;
            animation: glitch 3s infinite;
        }
        
        @keyframes glitch {
            0%, 100% { transform: skew(0deg); opacity: 1; }
            95% { transform: skew(0deg); opacity: 1; }
            96% { transform: skew(5deg); opacity: 0.8; }
            97% { transform: skew(-5deg); opacity: 0.9; }
            98% { transform: skew(3deg); opacity: 0.85; }
            99% { transform: skew(-3deg); opacity: 0.95; }
        }
        
        .error-title {
            font-size: 32px;
            font-weight: 700;
            color: white;
            margin-bottom: 15px;
        }
        
        .error-message {
            font-size: 16px;
            color: rgba(255,255,255,0.6);
            margin-bottom: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .warning-box {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
        }
        
        .warning-box i {
            font-size: 40px;
            color: #EF9F27;
            margin-bottom: 15px;
        }
        
        .warning-box h5 {
            color: white;
            font-size: 18px;
            margin-bottom: 10px;
        }
        
        .warning-box p {
            color: rgba(255,255,255,0.5);
            font-size: 13px;
            margin-bottom: 0;
        }
        
        .btn-home {
            background: linear-gradient(135deg, #0F6E56, #1D9E75);
            border: none;
            padding: 14px 35px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
            margin-right: 15px;
        }
        
        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(15,110,86,0.5);
        }
        
        .btn-login-page {
            background: transparent;
            border: 1.5px solid rgba(255,255,255,0.2);
            padding: 14px 35px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .btn-login-page:hover {
            border-color: #0F6E56;
            background: rgba(15,110,86,0.1);
            transform: translateY(-3px);
        }
        
        .security-badge {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: rgba(0,0,0,0.5);
            padding: 8px 15px;
            border-radius: 50px;
            font-size: 11px;
            color: rgba(255,255,255,0.4);
            z-index: 1;
        }
        
        .security-badge i {
            margin-right: 5px;
            color: #EF9F27;
        }
        
        @media (max-width: 768px) {
            .error-code { font-size: 100px; letter-spacing: 10px; }
            .error-title { font-size: 24px; }
            .btn-home, .btn-login-page { padding: 10px 25px; font-size: 12px; }
        }
    </style>
</head>
<body>
    <div class="glitch-bg">
        <div class="circle circle-1"></div>
        <div class="circle circle-2"></div>
        <div class="circle circle-3"></div>
    </div>
    
    <div class="error-container">
        <div class="error-code">404</div>
        <h1 class="error-title">Akses Ditolak</h1>
        <p class="error-message">
            Maaf, halaman yang Anda cari tidak ditemukan atau Anda tidak memiliki izin untuk mengaksesnya.
        </p>
        
        <div class="warning-box">
            <i class="fas fa-shield-alt"></i>
            <h5>⚠️ Area Terbatas</h5>
            <p>Halaman ini adalah area administratif yang dilindungi. Silakan login terlebih dahulu untuk mengakses dashboard.</p>
        </div>
        
        <div class="mt-4">
            <a href="{{ route('home') }}" class="btn-home text-white text-decoration-none">
                <i class="fas fa-home me-2"></i>Kembali ke Beranda
            </a>
            <a href="{{ route('login') }}" class="btn-login-page text-white text-decoration-none">
                <i class="fas fa-lock me-2"></i>Login Admin
            </a>
        </div>
    </div>
    
    <div class="security-badge">
        <i class="fas fa-fingerprint"></i> Security Monitor Active
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>