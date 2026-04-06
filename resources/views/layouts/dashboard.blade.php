<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard OSIS - @yield('title')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #0F6E56;
            --primary-dark: #04342C;
            --secondary: #EF9F27;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fb;
        }
        
        .sidebar {
            width: 260px;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            background: linear-gradient(180deg, var(--primary-dark) 0%, var(--primary) 100%);
            color: white;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-header h5 {
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        
        .sidebar-header small {
            font-size: 0.7rem;
            opacity: 0.7;
        }
        
        .sidebar-nav {
            padding: 1rem 0;
        }
        
        .sidebar-nav .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.75rem 1.5rem;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        
        .sidebar-nav .nav-link i {
            width: 20px;
            font-size: 1rem;
        }
        
        .main-content {
            margin-left: 260px;
            padding: 1.5rem;
        }
        
        .top-bar {
            background: white;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .page-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #111;
            margin: 0;
        }
        
        .card-stats {
            background: white;
            border-radius: 16px;
            padding: 1.25rem;
            transition: all 0.3s;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .card-stats:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -260px;
            }
            .sidebar.show {
                margin-left: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h5>Dashboard OSIS</h5>
        <small>SMA 5 Kab. Morotai</small>
    </div>
    <div class="sidebar-nav">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a class="nav-link {{ request()->routeIs('dashboard.pengurus*') ? 'active' : '' }}" href="{{ route('dashboard.pengurus') }}">
            <i class="fas fa-users"></i> Pengurus
        </a>
        <a class="nav-link {{ request()->routeIs('dashboard.agenda*') ? 'active' : '' }}" href="{{ route('dashboard.agenda') }}">
            <i class="fas fa-calendar"></i> Agenda
        </a>
        <a class="nav-link {{ request()->routeIs('dashboard.berita*') ? 'active' : '' }}" href="{{ route('dashboard.berita') }}">
            <i class="fas fa-newspaper"></i> Berita
        </a>
        <a class="nav-link {{ request()->routeIs('dashboard.galeri*') ? 'active' : '' }}" href="{{ route('dashboard.galeri') }}">
            <i class="fas fa-image"></i> Galeri
        </a>
        <a class="nav-link {{ request()->routeIs('dashboard.pengurus_terdahulu*') ? 'active' : '' }}" href="{{ route('dashboard.pengurus_terdahulu') }}">
            <i class="fas fa-history"></i> Pengurus Terdahulu
        </a>
        <a class="nav-link {{ request()->routeIs('dashboard.visimisi*') ? 'active' : '' }}" href="{{ route('dashboard.visimisi') }}">
            <i class="fas fa-eye"></i> Visi & Misi
        </a>
        <a class="nav-link {{ request()->routeIs('dashboard.sambutan*') ? 'active' : '' }}" href="{{ route('dashboard.sambutan') }}">
    <i class="fas fa-microphone-alt me-2"></i> Sambutan Ketua
</a>
<a class="nav-link {{ request()->routeIs('dashboard.dokumen*') ? 'active' : '' }}" href="{{ route('dashboard.dokumen') }}">
    <i class="fas fa-database me-2"></i> One Data

</a>
   


    </div>
    <!-- Di sidebar, tambahkan setelah menu terakhir -->
<div class="sidebar-nav mt-auto">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav-link w-100 text-start" style="background: none; border: none; color: rgba(255,255,255,0.8); padding: 0.75rem 1.5rem;">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </button>
    </form>
</div>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="top-bar">
        <h4 class="page-title">@yield('title')</h4>
        <button class="btn btn-sm btn-outline-primary d-md-none" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $('#sidebarToggle').on('click', function() {
        $('#sidebar').toggleClass('show');
    });
</script>

@stack('scripts')
</body>
</html>