@extends('layouts.app')

@section('title', 'Filosofi Logo OSIS')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <img src="{{ asset('icon.png') }}" alt="Logo OSIS" class="img-fluid mb-4" style="max-width: 200px;">
                    <h1 class="fw-bold">Filosofi Logo</h1>
                    <h3 class="text-primary">OSIS SMA Negeri 5 Morotai</h3>
                    <p class="text-muted">"Bergerak, Berkarya, Berprestasi"</p>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <p class="lead">Logo ini dirancang dengan konsep modern, berwibawa, dan beridentitas lokal, yang mencerminkan semangat pelajar Morotai dalam berkarya dan berprestasi.</p>
                    </div>
                </div>

                <!-- Bentuk Perisai -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h4 class="mb-0"><span class="display-6 me-2">🛡️</span> Bentuk Perisai</h4>
                    </div>
                    <div class="card-body">
                        <p>Melambangkan <strong>perlindungan, keteguhan, dan tanggung jawab</strong>. OSIS sebagai organisasi siswa menjadi pelindung nilai-nilai disiplin, kepemimpinan, dan kebersamaan di lingkungan sekolah.</p>
                    </div>
                </div>

                <!-- Bintang -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h4 class="mb-0"><span class="display-6 me-2">⭐</span> Bintang</h4>
                    </div>
                    <div class="card-body">
                        <p>Melambangkan <strong>Pancasila sebagai dasar negara dan pedoman hidup</strong>. Cahaya bintang juga menggambarkan harapan, cita-cita, dan arah masa depan siswa yang terus bersinar.</p>
                    </div>
                </div>

                <!-- Buku & Pena -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h4 class="mb-0"><span class="display-6 me-2">📖✒️</span> Buku Terbuka & Pena</h4>
                    </div>
                    <div class="card-body">
                        <p>Melambangkan <strong>ilmu pengetahuan dan pendidikan</strong>. Ini menunjukkan bahwa OSIS tidak hanya aktif dalam organisasi, tetapi juga menjunjung tinggi prestasi akademik dan literasi.</p>
                    </div>
                </div>

                <!-- Ombak -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h4 class="mb-0"><span class="display-6 me-2">🌊</span> Ombak / Laut Morotai</h4>
                    </div>
                    <div class="card-body">
                        <p>Melambangkan <strong>identitas daerah kepulauan Morotai</strong>. Ombak mencerminkan:</p>
                        <ul>
                            <li>Semangat yang dinamis</li>
                            <li>Ketangguhan menghadapi tantangan</li>
                            <li>Karakter siswa yang fleksibel namun kuat</li>
                        </ul>
                    </div>
                </div>

                <!-- Padi dan Kapas -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h4 class="mb-0"><span class="display-6 me-2">🌾</span> Padi dan Kapas</h4>
                    </div>
                    <div class="card-body">
                        <p>Melambangkan <strong>kemakmuran dan kesejahteraan</strong>. Ini mencerminkan harapan agar siswa tidak hanya cerdas, tetapi juga seimbang antara ilmu, moral, dan kesejahteraan sosial.</p>
                    </div>
                </div>

                <!-- Warna -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h4 class="mb-0"><span class="display-6 me-2">🎨</span> Warna Logo</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 40px; height: 40px; background: #0F6E56; border-radius: 8px;"></div>
                                    <div>
                                        <strong>Hijau Toska (#0F6E56)</strong><br>
                                        <small>Pertumbuhan, ketenangan, kestabilan</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 40px; height: 40px; background: #1D9E75; border-radius: 8px;"></div>
                                    <div>
                                        <strong>Hijau Muda (#1D9E75)</strong><br>
                                        <small>Harmoni, keseimbangan, kebersamaan</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 40px; height: 40px; background: #EF9F27; border-radius: 8px;"></div>
                                    <div>
                                        <strong>Oranye (#EF9F27)</strong><br>
                                        <small>Semangat, energi, kreativitas</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 40px; height: 40px; background: #FAC775; border-radius: 8px;"></div>
                                    <div>
                                        <strong>Emas (#FAC775)</strong><br>
                                        <small>Prestasi, kejayaan, masa depan gemilang</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3"><strong>Putih</strong> → Kesucian, kejujuran, dan integritas</p>
                    </div>
                </div>

                <!-- Tipografi -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h4 class="mb-0"><span class="display-6 me-2">🔤</span> Tipografi</h4>
                    </div>
                    <div class="card-body">
                        <p>Menggunakan gaya <strong>tegas, modern, dan mudah dibaca</strong>, melambangkan:</p>
                        <ul>
                            <li>Profesionalitas organisasi</li>
                            <li>Kesiapan menghadapi era digital</li>
                            <li>Identitas sekolah yang kuat</li>
                        </ul>
                    </div>
                </div>

                <!-- Tagline -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h4 class="mb-0"><span class="display-6 me-2">💬</span> Tagline: "Bergerak, Berkarya, Berprestasi"</h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><strong>Bergerak</strong> → Aktif dan progresif</li>
                            <li><strong>Berkarya</strong> → Kreatif dan inovatif</li>
                            <li><strong>Berprestasi</strong> → Berorientasi pada hasil dan pencapaian</li>
                        </ul>
                    </div>
                </div>

                <!-- Makna Keseluruhan -->
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body text-center">
                        <h4 class="fw-bold mb-3">Makna Keseluruhan</h4>
                        <p class="mb-0">Logo ini menggambarkan OSIS SMA Negeri 5 Morotai sebagai organisasi pelajar yang <strong>kuat, cerdas, berkarakter, dan berakar pada budaya lokal</strong>, namun tetap siap bersaing di tingkat yang lebih luas.</p>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection