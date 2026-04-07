<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>OSIS SMA 5 Morotai - @yield('title')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #0F6E56;
            --primary-light: #1D9E75;
            --secondary: #EF9F27;
            --secondary-light: #FAC775;
            --dark: #04342C;
            --gray-bg: #F8F9FA;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #fff;
            overflow-x: hidden;
        }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            padding: 0.85rem 2rem;
            box-shadow: 0 1px 0 rgba(0,0,0,0.06);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

       .logo-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background: var(--primary);
}

.logo-icon img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

        .logo-text {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            color: #111;
        }

        .logo-sub { font-size: 0.7rem; color: #999; }

        .nav-link-custom {
            color: #555;
            font-weight: 500;
            font-size: 0.82rem;
            padding: 0.45rem 0.7rem;
            margin: 0 0.2rem;
            border-radius: 8px;
            transition: all 0.25s;
            text-decoration: none;
        }

        .nav-link-custom:hover { color: var(--primary); background: rgba(15,110,86,0.07); }
        .nav-link-custom.active { color: var(--primary); background: rgba(15,110,86,0.1); font-weight: 600; }

        .btn-nav-contact {
            background: var(--primary);
            color: white;
            padding: 0.45rem 1.2rem;
            border-radius: 50px;
            font-size: 0.82rem;
            font-weight: 600;
            border: none;
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn-nav-contact:hover {
            background: var(--primary-light);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(15,110,86,0.3);
        }

        /* ===== SECTION COMMONS ===== */
        .section-tag {
            display: inline-block;
            background: rgba(15,110,86,0.1);
            color: var(--primary);
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 50px;
            margin-bottom: 0.75rem;
        }

        .section-title {
            font-family: 'Syne', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            color: #111;
            margin-bottom: 0.4rem;
        }

        .section-subtitle { color: #888; font-size: 0.88rem; }

        /* ===== OUTLINE BUTTON ===== */
        .btn-outline-green {
            border: 1.5px solid var(--primary);
            color: var(--primary);
            background: transparent;
            font-size: 0.83rem;
            font-weight: 600;
            padding: 0.55rem 1.4rem;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-outline-green:hover { background: var(--primary); color: white; }

        /* ===== FOOTER ===== */
        .footer-new {
            background: var(--dark);
            position: relative;
            overflow: hidden;
        }

        .footer-pattern {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(29,158,117,0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(29,158,117,0.08) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        .footer-top {
            position: relative;
            z-index: 1;
            padding: 4rem 0 2.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }

       .footer-brand-icon {
    width: 52px;
    height: 52px;
    background: var(--primary);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    margin-bottom: 1rem;
}

.footer-brand-icon img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

        .footer-brand-name {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: white;
            margin-bottom: 4px;
        }

        .footer-brand-sub { font-size: 0.8rem; color: rgba(255,255,255,0.4); line-height: 1.6; }

        .footer-tagline {
            display: inline-block;
            margin-top: 1rem;
            font-family: 'Syne', sans-serif;
            font-style: italic;
            font-size: 0.8rem;
            color: var(--secondary-light);
            opacity: 0.8;
        }

        .footer-col-title {
            font-family: 'Syne', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            color: rgba(255,255,255,0.5);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 1.25rem;
        }

        .footer-links { list-style: none; padding: 0; }
        .footer-links li { margin-bottom: 0.6rem; }
        .footer-links a {
            color: rgba(255,255,255,0.5);
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .footer-links a:hover { color: var(--secondary-light); transform: translateX(3px); }
        .footer-links a i { font-size: 11px; opacity: 0.6; }

        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 0.85rem;
        }

        .footer-contact-icon {
            width: 32px;
            height: 32px;
            min-width: 32px;
            background: rgba(255,255,255,0.07);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: var(--secondary-light);
        }

        .footer-contact-text { font-size: 0.8rem; color: rgba(255,255,255,0.5); line-height: 1.5; }
        .footer-contact-text strong { color: rgba(255,255,255,0.75); font-weight: 600; display: block; margin-bottom: 1px; }

        .footer-social { display: flex; gap: 8px; margin-top: 1.5rem; }
        .footer-social a {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.5);
            font-size: 14px;
            text-decoration: none;
            transition: all 0.25s;
        }
        .footer-social a:hover { background: var(--primary); border-color: var(--primary); color: white; transform: translateY(-2px); }

        .footer-bottom {
            position: relative;
            z-index: 1;
            padding: 1.5rem 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .footer-copy { font-size: 0.78rem; color: rgba(255,255,255,0.3); }
        .footer-copy span { color: rgba(255,255,255,0.5); }
        .footer-made { font-size: 0.75rem; color: rgba(255,255,255,0.25); display: flex; align-items: center; gap: 5px; }
        .footer-made i { color: #e05; font-size: 12px; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .nav-link-custom.active {
                border-bottom: none;
                background: rgba(15, 110, 86, 0.1);
                border-radius: 8px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <x-loading />

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <div class="logo-icon">
                <img src="{{ asset('icon/icon.png') }}" alt="Logo OSIS" style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">
            </div>
                <div>
                    <div class="logo-text">OSIS SMANLI</div>
                    <div class="logo-sub">Kab. Pulau Morotai</div>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link-custom {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom {{ request()->routeIs('public.pengurus*') ? 'active' : '' }}" href="{{ route('public.pengurus') }}">
                            <i class="fas fa-users me-1"></i> Pengurus
                        </a>
                    </li>
                    <li class="nav-item">
    <a class="nav-link-custom {{ request()->routeIs('public.proker*') ? 'active' : '' }}" href="{{ route('public.proker') }}">
        <i class="fas fa-tasks me-1"></i> Proker
    </a>
</li>
                    <li class="nav-item">
                        <a class="nav-link-custom {{ request()->routeIs('public.agenda*') ? 'active' : '' }}" href="{{ route('public.agenda') }}">
                            <i class="fas fa-calendar-alt me-1"></i> Agenda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom {{ request()->routeIs('public.berita*') ? 'active' : '' }}" href="{{ route('public.berita') }}">
                            <i class="fas fa-newspaper me-1"></i> Berita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom {{ request()->routeIs('public.galeri*') ? 'active' : '' }}" href="{{ route('public.galeri') }}">
                            <i class="fas fa-image me-1"></i> Galeri
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom {{ request()->routeIs('public.pengurus_terdahulu*') ? 'active' : '' }}" href="{{ route('public.pengurus_terdahulu') }}">
                            <i class="fas fa-history me-1"></i> Pengurus Terdahulu
                        </a>
                    </li>
                    <li class="nav-item">
                       <a class="nav-link-custom {{ request()->routeIs('public.dokumen*') ? 'active' : '' }}" href="{{ route('public.dokumen') }}">
        <i class="fas fa-database me-1"></i> One Data
    </a>
                    </li>
                </ul>
                <button class="btn-nav-contact" data-bs-toggle="modal" data-bs-target="#contactModal">
                    <i class="fas fa-envelope me-2"></i>Hubungi
                </button>
            </div>
        </div>
    </nav>

    <!-- ===== MAIN CONTENT ===== -->
    @yield('content')

    <!-- ===== FOOTER ===== -->
    <footer class="footer-new">
        <div class="footer-pattern"></div>
        <div class="container">
            <div class="footer-top">
                <div class="row g-5">
                    <!-- Brand -->
                    <div class="col-lg-4 col-md-6">
                         <div class="footer-brand-icon">
        <img src="{{ asset('icon/icon.png') }}" alt="Logo OSIS" style="width: 100%; height: 100%; object-fit: cover; border-radius: 14px;">
    </div>
                        <div class="footer-brand-name">OSIS SMA Negeri 5 Morotai</div>
                        <div class="footer-brand-sub">Kabupaten Pulau Morotai<br>Maluku Utara, Indonesia</div>
                        <div class="footer-tagline">"Bergerak, Berkarya, Berprestasi"</div>
                        <div class="footer-social">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fab fa-tiktok"></i></a>
                        </div>
                    </div>

                    <!-- Navigasi -->
                    <div class="col-lg-2 col-md-6 col-6">
                        <div class="footer-col-title">Navigasi</div>
                        <ul class="footer-links">
                            <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right"></i> Beranda</a></li>
                            <li><a href="{{ route('public.pengurus') }}"><i class="fas fa-chevron-right"></i> Pengurus</a></li>
                            <li><a href="{{ route('public.agenda') }}"><i class="fas fa-chevron-right"></i> Agenda</a></li>
                            <li><a href="{{ route('public.berita') }}"><i class="fas fa-chevron-right"></i> Berita</a></li>
                            <li><a href="{{ route('public.galeri') }}"><i class="fas fa-chevron-right"></i> Galeri</a></li>
                        </ul>
                    </div>

                    <!-- Program -->
                    <div class="col-lg-2 col-md-6 col-6">
                        <div class="footer-col-title">Program</div>
                        <ul class="footer-links">
                            <li><a href="{{ route('public.pengurus') }}"><i class="fas fa-chevron-right"></i> Proker OSIS</a></li>
                            <li><a href="{{ route('public.galeri') }}"><i class="fas fa-chevron-right"></i> Galeri</a></li>
                            <li><a href="{{ route('public.berita') }}"><i class="fas fa-chevron-right"></i> Prestasi</a></li>
                            <li><a href="{{ route('public.pengurus_terdahulu') }}"><i class="fas fa-chevron-right"></i> Terdahulu</a></li>
                        </ul>
                    </div>

                    <!-- Kontak -->
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-col-title">Kontak</div>
                        <div class="footer-contact-item">
                            <div class="footer-contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="footer-contact-text">
                                <strong>Alamat Sekolah</strong>
                                Jl. Pendidikan, Kab. Pulau Morotai, Maluku Utara
                            </div>
                        </div>
                        <div class="footer-contact-item">
                            <div class="footer-contact-icon"><i class="fab fa-instagram"></i></div>
                            <div class="footer-contact-text">
                                <strong>Instagram</strong>
                                @osis.sman5morotai
                            </div>
                        </div>
                        <div class="footer-contact-item">
                            <div class="footer-contact-icon"><i class="fas fa-envelope"></i></div>
                            <div class="footer-contact-text">
                                <strong>Email</strong>
                                osis@sman5morotai.sch.id
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom bar -->
            <div class="footer-bottom">
                <div class="footer-copy">
                    &copy; {{ date('Y') }} <span>OSIS SMA Negeri 5 Kabupaten Pulau Morotai</span>. Semua hak dilindungi.
                </div>
                <div class="footer-made">
                    Dibuat dengan <i class="fas fa-heart"></i> untuk pendidikan Maluku Utara
                </div>
            </div>
        </div>
    </footer>

    <!-- Contact Modal -->
<div class="modal fade" id="contactModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-envelope me-2"></i>Hubungi OSIS
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="contactForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="contactName" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="contactEmail" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No. WhatsApp (Opsional)</label>
                        <input type="tel" class="form-control" id="contactPhone" placeholder="08xxxxxxxxxx">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subjek <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="contactSubject" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pesan <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="contactMessage" rows="4" required></textarea>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="btnSendContact">
                            <i class="fas fa-paper-plane me-1"></i>Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Active nav link
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link-custom');
            navLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href === currentPath) {
                    navLinks.forEach(l => l.classList.remove('active'));
                    link.classList.add('active');
                }
            });
        });

        // Contact form with AJAX
$('#contactForm').on('submit', function(e) {
    e.preventDefault();
    
    const btn = $('#btnSendContact');
    const originalText = btn.html();
    
    // Disable button
    btn.prop('disabled', true);
    btn.html('<i class="fas fa-spinner fa-spin me-1"></i> Mengirim...');
    
    // Get form data
    const formData = {
        nama: $('#contactName').val(),
        email: $('#contactEmail').val(),
        no_hp: $('#contactPhone').val(),
        subjek: $('#contactSubject').val(),
        pesan: $('#contactMessage').val(),
        _token: $('meta[name="csrf-token"]').attr('content')
    };
    
    // Send AJAX request
    $.ajax({
        url: '/kontak/send',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Pesan Terkirim!',
                text: response.message,
                confirmButtonColor: '#0F6E56'
            });
            $('#contactModal').modal('hide');
            $('#contactForm')[0].reset();
        },
        error: function(xhr) {
            let errorMessage = 'Gagal mengirim pesan. Silakan coba lagi.';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: errorMessage,
                confirmButtonColor: '#d33'
            });
        },
        complete: function() {
            btn.prop('disabled', false);
            btn.html(originalText);
        }
    });
});
    </script>

    @stack('scripts')
</body>
</html>
