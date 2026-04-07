@extends('layouts.dashboard')

@section('title', 'Detail Pesan')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-envelope-open-text me-2 text-primary"></i>Detail Pesan
                </h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="fw-semibold">Nama:</label>
                        <p>{{ $pesan->nama }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-semibold">Email:</label>
                        <p>{{ $pesan->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-semibold">No HP:</label>
                        <p>{{ $pesan->no_hp ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-semibold">Tanggal:</label>
                        <p>{{ $pesan->created_at->format('d F Y H:i') }}</p>
                    </div>
                    <div class="col-12">
                        <label class="fw-semibold">Subjek:</label>
                        <p class="bg-light p-2 rounded">{{ $pesan->subjek }}</p>
                    </div>
                    <div class="col-12">
                        <label class="fw-semibold">Pesan:</label>
                        <div class="bg-light p-3 rounded" style="min-height: 150px;">
                            {{ $pesan->pesan }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Balasan -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-reply-all me-2 text-success"></i>Balas Pesan
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.pesan.reply', $pesan->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Balasan Email <span class="text-danger">*</span></label>
                        <textarea name="balasan" class="form-control" rows="6" required placeholder="Tulis balasan untuk {{ $pesan->nama }}..."></textarea>
                        <small class="text-muted">Balasan akan dikirim ke email: {{ $pesan->email }}</small>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('dashboard.pesan') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-paper-plane me-1"></i>Kirim Balasan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-info-circle me-2 text-info"></i>Informasi
                </h5>
            </div>
            <div class="card-body">
                <p class="mb-2">
                    <strong>Status:</strong><br>
                    {!! $pesan->status_badge !!}
                </p>
                @if($pesan->dibaca_pada)
                <p class="mb-2">
                    <strong>Dibaca pada:</strong><br>
                    {{ $pesan->dibaca_pada->format('d F Y H:i') }}
                </p>
                @endif
                @if($pesan->balasan)
                <hr>
                <p class="mb-0">
                    <strong>Balasan terkirim:</strong><br>
                    <small class="text-muted">{{ $pesan->updated_at->format('d F Y H:i') }}</small>
                </p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection