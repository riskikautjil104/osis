@extends('layouts.dashboard')

@section('title', 'Visi & Misi OSIS')

@section('content')
<style>
    .visi-card, .misi-card {
        transition: all 0.3s ease;
    }
    .visi-card:hover, .misi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .misi-item {
        background: #f8f9fa;
        border-left: 4px solid #0F6E56;
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 8px;
        transition: all 0.3s;
        cursor: pointer;
    }
    .misi-item:hover {
        background: #e8f5e9;
        transform: translateX(5px);
    }
    .misi-text {
        margin: 0;
        font-size: 0.95rem;
        line-height: 1.6;
    }
    .misi-actions {
        opacity: 0;
        transition: opacity 0.3s;
    }
    .misi-item:hover .misi-actions {
        opacity: 1;
    }
    .btn-icon {
        padding: 4px 8px;
        font-size: 12px;
    }
</style>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-semibold"><i class="fas fa-eye me-2 text-primary"></i>Visi & Misi OSIS</h5>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        <!-- Preview Section -->
        <div class="row mb-5">
            <div class="col-md-5 mb-4">
                <div class="card visi-card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block">
                                <i class="fas fa-eye fa-3x text-primary"></i>
                            </div>
                        </div>
                        <h4 class="text-center fw-bold mb-3">Visi</h4>
                        <div class="visi-content">
                            @if($visiMisi)
                                <p class="text-muted" style="line-height: 1.8;">{{ $visiMisi->visi }}</p>
                            @else
                                <p class="text-muted text-center">Belum ada visi yang ditetapkan</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-7">
                <div class="card misi-card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3 d-inline-block">
                                <i class="fas fa-list-check fa-3x text-success"></i>
                            </div>
                        </div>
                        <h4 class="text-center fw-bold mb-3">Misi</h4>
                        <div class="misi-list">
                            @if($visiMisi && count($visiMisi->misi) > 0)
                                @foreach($visiMisi->misi as $index => $misi)
                                    <div class="misi-item">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="flex-grow-1">
                                                <div class="d-flex">
                                                    <span class="badge bg-primary rounded-circle me-2" style="width: 24px; height: 24px; display: inline-flex; align-items: center; justify-content: center;">{{ $index + 1 }}</span>
                                                    <p class="misi-text flex-grow-1">{{ $misi }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted text-center">Belum ada misi yang ditetapkan</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Edit Form -->
        <div class="card border-0 bg-light">
            <div class="card-header bg-white">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-edit me-2 text-warning"></i>Edit Visi & Misi</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.visimisi.update') }}" method="POST" id="visiMisiForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-eye text-primary me-1"></i> Visi OSIS
                        </label>
                        <textarea name="visi" class="form-control @error('visi') is-invalid @enderror" rows="4" placeholder="Tulis visi OSIS di sini...">{{ old('visi', $visiMisi->visi ?? '') }}</textarea>
                        @error('visi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-muted">Visi harus singkat, jelas, dan inspiratif</small>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-list-check text-success me-1"></i> Misi OSIS
                        </label>
                        <div id="misiContainer">
                            @php
                                $misiArray = [];
                                if($visiMisi && $visiMisi->misi) {
                                    $misiArray = $visiMisi->misi;
                                } elseif(old('misi')) {
                                    $misiArray = old('misi');
                                } else {
                                    $misiArray = [''];
                                }
                            @endphp
                            
                            @foreach($misiArray as $index => $misi)
                                <div class="misi-input-group mb-3" data-index="{{ $index }}">
                                    <div class="input-group">
                                        <span class="input-group-text bg-primary text-white">{{ $index + 1 }}</span>
                                        <input type="text" name="misi[]" class="form-control" value="{{ $misi }}" placeholder="Tulis misi ke-{{ $index + 1 }}" required>
                                        <button type="button" class="btn btn-danger remove-misi" {{ $index == 0 ? 'disabled' : '' }}>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <button type="button" id="addMisi" class="btn btn-sm btn-success mt-2">
                            <i class="fas fa-plus me-1"></i>Tambah Misi
                        </button>
                        <small class="text-muted d-block mt-2">Minimal 1 misi, maksimal 10 misi</small>
                    </div>
                    
                    <hr>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let misiCount = {{ count($misiArray) }};
    const maxMisi = 10;
    
    // Add misi
    $('#addMisi').click(function() {
        if (misiCount >= maxMisi) {
            Swal.fire('Perhatian!', `Maksimal ${maxMisi} misi!`, 'warning');
            return;
        }
        
        misiCount++;
        const newIndex = misiCount - 1;
        const newMisiHtml = `
            <div class="misi-input-group mb-3" data-index="${newIndex}">
                <div class="input-group">
                    <span class="input-group-text bg-primary text-white">${misiCount}</span>
                    <input type="text" name="misi[]" class="form-control" placeholder="Tulis misi ke-${misiCount}" required>
                    <button type="button" class="btn btn-danger remove-misi">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
        
        $('#misiContainer').append(newMisiHtml);
        updateMisiNumbers();
    });
    
    // Remove misi
    $(document).on('click', '.remove-misi', function() {
        if ($('.misi-input-group').length <= 1) {
            Swal.fire('Perhatian!', 'Minimal 1 misi!', 'warning');
            return;
        }
        
        $(this).closest('.misi-input-group').remove();
        misiCount--;
        updateMisiNumbers();
    });
    
    // Update numbering
    function updateMisiNumbers() {
        $('.misi-input-group').each(function(index) {
            $(this).find('.input-group-text').text(index + 1);
            $(this).find('input').attr('placeholder', `Tulis misi ke-${index + 1}`);
            $(this).attr('data-index', index);
        });
        misiCount = $('.misi-input-group').length;
        
        // Disable remove button if only one left
        if (misiCount <= 1) {
            $('.remove-misi').prop('disabled', true);
        } else {
            $('.remove-misi').prop('disabled', false);
        }
    }
    
    // Form validation
    $('#visiMisiForm').submit(function(e) {
        let hasEmpty = false;
        $('input[name="misi[]"]').each(function() {
            if ($(this).val().trim() === '') {
                hasEmpty = true;
            }
        });
        
        if (hasEmpty) {
            e.preventDefault();
            Swal.fire('Error!', 'Semua misi harus diisi!', 'error');
        }
    });
    
    // Preview update on input
    $('textarea[name="visi"]').on('input', function() {
        $('.visi-content p').text($(this).val() || 'Belum ada visi yang ditetapkan');
    });
    
    // Live preview for misi (optional)
    function updatePreview() {
        const misiList = [];
        $('input[name="misi[]"]').each(function() {
            if ($(this).val().trim()) {
                misiList.push($(this).val());
            }
        });
        
        const previewHtml = misiList.map((misi, idx) => `
            <div class="misi-item">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <div class="d-flex">
                            <span class="badge bg-primary rounded-circle me-2" style="width: 24px; height: 24px; display: inline-flex; align-items: center; justify-content: center;">${idx + 1}</span>
                            <p class="misi-text flex-grow-1">${misi}</p>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');
        
        $('.misi-list').html(previewHtml || '<p class="text-muted text-center">Belum ada misi yang ditetapkan</p>');
    }
    
    // Update preview on input
    $(document).on('input', 'input[name="misi[]"]', updatePreview);
</script>
@endpush
@endsection