<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard OSIS - @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
       :root {
    --primary: #0F6E56;
    --primary-light: #1D9E75;
    --primary-dark: #04342C;
    --secondary: #EF9F27;
    --secondary-light: #FAC775;
    --bg-soft: #f8faf9;
    --border-soft: #e8eeeb;
    --text-soft: #6b7280;
}

/* ===== GLOBAL BASE ===== */
body {
    background: #f5f7f6;
    color: #1f2937;
}

.page-body {
    animation: fadePage .25s ease;
}

@keyframes fadePage {
    from { opacity: 0; transform: translateY(4px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ===== BOOTSTRAP BUTTON OVERRIDE ===== */
.btn {
    border-radius: 12px;
    font-size: 0.84rem;
    font-weight: 600;
    padding: 0.6rem 1rem;
    transition: all 0.25s ease;
    box-shadow: none !important;
}

.btn-primary {
    background: var(--primary);
    border-color: var(--primary);
}

.btn-primary:hover,
.btn-primary:focus,
.btn-primary:active {
    background: var(--primary-light) !important;
    border-color: var(--primary-light) !important;
}

.btn-outline-primary {
    color: var(--primary);
    border-color: var(--primary);
}

.btn-outline-primary:hover,
.btn-outline-primary:focus,
.btn-outline-primary:active {
    background: var(--primary) !important;
    border-color: var(--primary) !important;
    color: #fff !important;
}

.btn-success {
    background: var(--primary-light);
    border-color: var(--primary-light);
}

.btn-success:hover,
.btn-success:focus,
.btn-success:active {
    background: var(--primary);
    border-color: var(--primary);
}

.btn-warning {
    background: var(--secondary);
    border-color: var(--secondary);
    color: var(--primary-dark);
}

.btn-warning:hover,
.btn-warning:focus,
.btn-warning:active {
    background: var(--secondary-light);
    border-color: var(--secondary-light);
    color: var(--primary-dark);
}

/* ===== FORM OVERRIDE ===== */
.form-control,
.form-select {
    border-radius: 12px;
    border: 1.5px solid var(--border-soft);
    font-size: 0.86rem;
    min-height: 44px;
    box-shadow: none !important;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(15,110,86,0.08) !important;
}

textarea.form-control {
    min-height: 110px;
}

/* ===== CARD OVERRIDE ===== */
.card {
    border-radius: 18px;
    border: 1px solid var(--border-soft);
    box-shadow: 0 8px 25px rgba(0,0,0,0.04);
    overflow: hidden;
}

.card-header {
    background: #fff;
    border-bottom: 1px solid var(--border-soft);
    font-weight: 700;
}

.shadow-sm {
    box-shadow: 0 8px 24px rgba(0,0,0,0.05) !important;
}

/* ===== TABLE OVERRIDE ===== */
.table {
    --bs-table-bg: transparent;
}

.table thead th {
    font-size: 0.78rem;
    text-transform: uppercase;
    letter-spacing: .4px;
    color: #6b7280;
    border-bottom-width: 1px;
    border-color: var(--border-soft);
    padding-top: 0.9rem;
    padding-bottom: 0.9rem;
}

.table tbody td {
    vertical-align: middle;
    border-color: #eef2f0;
    padding-top: 0.9rem;
    padding-bottom: 0.9rem;
}

/* ===== BADGE ===== */
.badge {
    border-radius: 999px;
    font-size: 0.68rem;
    font-weight: 700;
    padding: 0.48rem 0.7rem;
}

/* ===== ALERT ===== */
.alert {
    border-radius: 14px;
    border: 1px solid transparent;
}

.alert-success {
    background: rgba(29,158,117,0.10);
    color: var(--primary-dark);
    border-color: rgba(29,158,117,0.15);
}

.alert-danger {
    background: rgba(239,68,68,0.08);
    color: #991b1b;
    border-color: rgba(239,68,68,0.14);
}

/* ===== PAGINATION ===== */
.pagination {
    gap: 6px;
}

.page-link {
    border: none;
    border-radius: 12px !important;
    color: #667085;
    padding: 0.55rem 0.9rem;
    box-shadow: none !important;
}

.page-item.active .page-link {
    background: var(--primary);
    color: white;
}

.page-link:hover {
    background: rgba(15,110,86,0.08);
    color: var(--primary);
}

/* ===== DROPDOWN ===== */
.dropdown-menu {
    border: 1px solid var(--border-soft);
    border-radius: 16px;
    box-shadow: 0 16px 36px rgba(0,0,0,0.07);
    padding: 0.5rem;
}

.dropdown-item {
    border-radius: 10px;
    font-size: 0.84rem;
    padding: 0.65rem 0.8rem;
}

.dropdown-item:hover {
    background: rgba(15,110,86,0.08);
    color: var(--primary);
}

/* ===== MODAL ===== */
.modal-content {
    border: none;
    border-radius: 20px;
    overflow: hidden;
}

.modal-header {
    border-bottom: 1px solid var(--border-soft);
}

.modal-footer {
    border-top: 1px solid var(--border-soft);
}

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f0f2f5;
            overflow-x: hidden;
        }

        /* ============================================================
           SIDEBAR
        ============================================================ */
        .sidebar {
            width: 260px;
            position: fixed;
            left: 0; top: 0;
            height: 100vh;
            background: var(--primary-dark);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        /* --- Layers: pattern, dots, glow, circles --- */
        .sb-pattern {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(29,158,117,0.12) 1px, transparent 1px),
                linear-gradient(90deg, rgba(29,158,117,0.12) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
            z-index: 0;
        }

        .sb-dots {
            position: absolute;
            top: 0; right: 0;
            width: 130px; height: 180px;
            background-image: radial-gradient(circle, rgba(250,199,117,0.32) 1.5px, transparent 1.5px);
            background-size: 18px 18px;
            pointer-events: none;
            z-index: 0;
        }

        .sb-glow {
            position: absolute;
            bottom: -80px; left: -60px;
            width: 260px; height: 260px;
            background: radial-gradient(circle, rgba(15,110,86,0.28) 0%, transparent 68%);
            pointer-events: none;
            z-index: 0;
        }

        .sb-circle-1 {
            position: absolute;
            top: -40px; right: -70px;
            width: 200px; height: 200px;
            border: 1.5px solid rgba(250,199,117,0.1);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .sb-circle-2 {
            position: absolute;
            bottom: 60px; right: -90px;
            width: 280px; height: 280px;
            border: 1px solid rgba(29,158,117,0.12);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        /* --- Header --- */
        .sb-header {
            position: relative;
            z-index: 2;
            padding: 1.4rem 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sb-logo {
            width: 42px; height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border: 1.5px solid rgba(255,255,255,0.14);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
            position: relative;
        }

        .sb-logo img {
            width: 100%; height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .sb-logo-fallback {
            font-family: 'Syne', sans-serif;
            font-size: 0.85rem;
            font-weight: 800;
            color: var(--secondary-light);
            letter-spacing: -0.5px;
        }

        .sb-header-title {
            font-family: 'Syne', sans-serif;
            font-size: 0.83rem;
            font-weight: 700;
            color: white;
            margin-bottom: 2px;
        }

        .sb-header-sub {
            font-size: 0.62rem;
            color: rgba(255,255,255,0.38);
        }

        /* --- Section label --- */
        .sb-section {
            position: relative;
            z-index: 2;
            font-size: 0.58rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.22);
            padding: 1.1rem 1.5rem 0.35rem;
        }

        /* --- Nav --- */
        .sb-nav {
            position: relative;
            z-index: 2;
            flex: 1;
            overflow-y: auto;
            padding: 0.35rem 0 0.5rem;
        }

        .sb-nav::-webkit-scrollbar { width: 3px; }
        .sb-nav::-webkit-scrollbar-track { background: transparent; }
        .sb-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }

        .sb-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.6rem 1.5rem;
            color: rgba(255,255,255,0.52);
            font-size: 0.78rem;
            font-weight: 500;
            text-decoration: none;
            border-left: 2.5px solid transparent;
            transition: all 0.2s ease;
            position: relative;
        }

        .sb-link:hover {
            color: rgba(255,255,255,0.85);
            background: rgba(255,255,255,0.055);
            border-left-color: rgba(250,199,117,0.35);
        }

        .sb-link.active {
            color: white;
            background: rgba(29,158,117,0.16);
            border-left-color: var(--secondary-light);
            font-weight: 600;
        }

        .sb-icon {
            width: 30px; height: 30px;
            border-radius: 8px;
            background: rgba(255,255,255,0.06);
            display: flex; align-items: center; justify-content: center;
            font-size: 12px;
            color: rgba(255,255,255,0.45);
            flex-shrink: 0;
            transition: all 0.2s;
        }

        .sb-link.active .sb-icon {
            background: rgba(250,199,117,0.16);
            color: var(--secondary-light);
        }

        .sb-link:hover .sb-icon {
            background: rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.75);
        }

        .sb-badge {
            margin-left: auto;
            background: var(--secondary);
            color: var(--primary-dark);
            font-size: 0.58rem;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 50px;
            min-width: 20px;
            text-align: center;
        }

        /* --- Footer / user --- */
        .sb-footer {
            position: relative;
            z-index: 2;
            padding: 0.85rem 1.1rem 1rem;
            border-top: 1px solid rgba(255,255,255,0.07);
        }

        .sb-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.6rem 0.8rem;
            border-radius: 10px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            margin-bottom: 7px;
            cursor: default;
            transition: background 0.2s;
        }

        .sb-user:hover { background: rgba(255,255,255,0.08); }

        .sb-avatar {
            width: 32px; height: 32px;
            border-radius: 9px;
            background: linear-gradient(135deg, var(--primary), var(--secondary-light));
            display: flex; align-items: center; justify-content: center;
            font-family: 'Syne', sans-serif;
            font-size: 11px;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .sb-user-name {
            font-size: 0.74rem;
            font-weight: 600;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sb-user-role {
            font-size: 0.61rem;
            color: rgba(255,255,255,0.32);
        }

        .sb-logout-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0.5rem 0.8rem;
            width: 100%;
            border: none;
            background: none;
            border-radius: 8px;
            font-size: 0.74rem;
            font-weight: 500;
            color: rgba(255,255,255,0.32);
            cursor: pointer;
            transition: all 0.2s;
            text-align: left;
        }

        .sb-logout-btn:hover {
            color: #fca5a5;
            background: rgba(248,113,113,0.08);
        }

        /* ============================================================
           MAIN CONTENT
        ============================================================ */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease;
        }

        .topbar {
            background: white;
            border-bottom: 1px solid #e8eaed;
            padding: 0.85rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar-left { display: flex; align-items: center; gap: 12px; }

        .topbar-toggle {
            display: none;
            background: none;
            border: 1.5px solid #ddd;
            border-radius: 8px;
            width: 36px; height: 36px;
            align-items: center; justify-content: center;
            cursor: pointer;
            font-size: 14px;
            color: #555;
            transition: all 0.2s;
        }

        .topbar-toggle:hover { border-color: var(--primary); color: var(--primary); }

        .topbar-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: #111;
        }

        .topbar-right { display: flex; align-items: center; gap: 10px; }

        .topbar-date {
            font-size: 0.72rem;
            color: #bbb;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .topbar-avatar {
            width: 34px; height: 34px;
            border-radius: 9px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            display: flex; align-items: center; justify-content: center;
            font-family: 'Syne', sans-serif;
            font-size: 10px;
            font-weight: 700;
            color: white;
        }

        .page-body {
            flex: 1;
            padding: 1.75rem;
        }

        /* Alerts */
        .alert {
            border-radius: 12px;
            border: none;
            font-size: 0.83rem;
            padding: 0.85rem 1.25rem;
            margin-bottom: 1.25rem;
        }

        /* Mobile overlay */
        .sb-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        /* ============================================================
           RESPONSIVE
        ============================================================ */
        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .topbar-toggle {
                display: flex;
            }

            .sb-overlay.visible {
                display: block;
            }
        }
        .page-loader {
    position: fixed;
    inset: 0;
    background: rgba(255,255,255,0.82);
    backdrop-filter: blur(4px);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.25s ease;
}

.page-loader.hide {
    opacity: 0;
    visibility: hidden;
}

.page-loader-box {
    text-align: center;
}

.page-loader-text {
    margin-top: 10px;
    font-size: 0.78rem;
    color: #6b7280;
}
    </style>

    @stack('styles')
</head>
<body>
<div id="pageLoader" class="page-loader">
    <div class="page-loader-box">
        <div class="spinner-border text-success" role="status" style="width: 2.6rem; height: 2.6rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="page-loader-text">Memuat halaman...</div>
    </div>
</div>
<!-- ===== SIDEBAR ===== -->
<div class="sidebar" id="sidebar">
    <div class="sb-pattern"></div>
    <div class="sb-dots"></div>
    <div class="sb-glow"></div>
    <div class="sb-circle-1"></div>
    <div class="sb-circle-2"></div>

    {{-- Header --}}
    <div class="sb-header">
        <div class="sb-logo">
            <img src="{{ asset('icon/icon.png') }}" alt="Logo OSIS"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
            <span class="sb-logo-fallback" style="display:none;">O5</span>
        </div>
        <div>
            <div class="sb-header-title">Dashboard OSIS</div>
            <div class="sb-header-sub">SMA 5 Kab. Morotai</div>
        </div>
    </div>

    {{-- Nav --}}
    <div class="sb-nav">

        <div class="sb-section">Menu Utama</div>

        <a class="sb-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
           href="{{ route('dashboard') }}">
            <span class="sb-icon"><i class="fas fa-tachometer-alt"></i></span>
            Dashboard
        </a>

        <a class="sb-link {{ request()->routeIs('dashboard.pengurus*') ? 'active' : '' }}"
           href="{{ route('dashboard.pengurus') }}">
            <span class="sb-icon"><i class="fas fa-users"></i></span>
            Pengurus
        </a>

        <a class="sb-link {{ request()->routeIs('dashboard.agenda*') ? 'active' : '' }}"
           href="{{ route('dashboard.agenda') }}">
            <span class="sb-icon"><i class="fas fa-calendar-alt"></i></span>
            Agenda
        </a>

        <a class="sb-link {{ request()->routeIs('dashboard.berita*') ? 'active' : '' }}"
           href="{{ route('dashboard.berita') }}">
            <span class="sb-icon"><i class="fas fa-newspaper"></i></span>
            Berita
        </a>

        <a class="sb-link {{ request()->routeIs('dashboard.galeri*') ? 'active' : '' }}"
           href="{{ route('dashboard.galeri') }}">
            <span class="sb-icon"><i class="fas fa-images"></i></span>
            Galeri
        </a>

        <div class="sb-section">Program</div>

        <a class="sb-link {{ request()->routeIs('dashboard.pengurus_terdahulu*') ? 'active' : '' }}"
           href="{{ route('dashboard.pengurus_terdahulu') }}">
            <span class="sb-icon"><i class="fas fa-history"></i></span>
            Pengurus Terdahulu
        </a>

        <a class="sb-link {{ request()->routeIs('dashboard.visimisi*') ? 'active' : '' }}"
           href="{{ route('dashboard.visimisi') }}">
            <span class="sb-icon"><i class="fas fa-eye"></i></span>
            Visi &amp; Misi
        </a>

        <a class="sb-link {{ request()->routeIs('dashboard.proker*') ? 'active' : '' }}"
           href="{{ route('dashboard.proker') }}">
            <span class="sb-icon"><i class="fas fa-tasks"></i></span>
            Program Kerja
        </a>

        <a class="sb-link {{ request()->routeIs('dashboard.sambutan*') ? 'active' : '' }}"
           href="{{ route('dashboard.sambutan') }}">
            <span class="sb-icon"><i class="fas fa-microphone-alt"></i></span>
            Sambutan Ketua
        </a>

        <div class="sb-section">Data &amp; Komunikasi</div>

        <a class="sb-link {{ request()->routeIs('dashboard.dokumen*') ? 'active' : '' }}"
           href="{{ route('dashboard.dokumen') }}">
            <span class="sb-icon"><i class="fas fa-database"></i></span>
            One Data
        </a>

        <a class="sb-link {{ request()->routeIs('dashboard.pesan*') ? 'active' : '' }}"
           href="{{ route('dashboard.pesan') }}">
            <span class="sb-icon"><i class="fas fa-envelope"></i></span>
            Pesan Masuk
            @php $unreadCount = \App\Models\Pesan::where('status', 'belum_dibaca')->count(); @endphp
            @if($unreadCount > 0)
                <span class="sb-badge">{{ $unreadCount }}</span>
            @endif
        </a>

    </div>

    {{-- Footer / User --}}
    <div class="sb-footer">
        <div class="sb-user">
            <div class="sb-avatar">AD</div>
            <div style="flex:1; min-width:0;">
                <div class="sb-user-name">Administrator</div>
                <div class="sb-user-role">Super Admin</div>
            </div>
            <i class="fas fa-cog" style="font-size:11px; color:rgba(255,255,255,0.2);"></i>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sb-logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </button>
        </form>
    </div>
</div>

{{-- Overlay for mobile --}}
<div class="sb-overlay" id="sbOverlay" onclick="closeSidebar()"></div>

<!-- ===== MAIN CONTENT ===== -->
<div class="main-content">

    {{-- Top bar --}}
    <div class="topbar">
        <div class="topbar-left">
            <button class="topbar-toggle" id="sidebarToggle" onclick="openSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <h4 class="topbar-title">@yield('title')</h4>
        </div>
        <div class="topbar-right">
            <div class="topbar-date">
                <i class="fas fa-calendar-alt"></i>
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </div>
            <div class="topbar-avatar">AD</div>
        </div>
    </div>

    {{-- Alerts --}}
    <div style="padding: 0 1.75rem;">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    {{-- Page content --}}
    <div class="page-body">
        @yield('content')
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function openSidebar() {
        document.getElementById('sidebar').classList.add('open');
        document.getElementById('sbOverlay').classList.add('visible');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sbOverlay').classList.remove('visible');
        document.body.style.overflow = '';
    }

    // Close on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeSidebar();
    });
        window.addEventListener('load', function () {
        const loader = document.getElementById('pageLoader');
        if (loader) {
            setTimeout(() => loader.classList.add('hide'), 200);
        }
    });

    document.addEventListener('click', function (e) {
        const link = e.target.closest('a[href]');
        if (!link) return;

        const href = link.getAttribute('href');
        const target = link.getAttribute('target');

        if (
            href &&
            href !== '#' &&
            !href.startsWith('javascript:') &&
            !href.startsWith('#') &&
            target !== '_blank'
        ) {
            const loader = document.getElementById('pageLoader');
            if (loader) loader.classList.remove('hide');
        }
    });

    if (window.jQuery) {
        $(document).ajaxStart(function () {
            $('#pageLoader').removeClass('hide');
        });

        $(document).ajaxStop(function () {
            $('#pageLoader').addClass('hide');
        });
    }
</script>

@stack('scripts')
</body>
</html>