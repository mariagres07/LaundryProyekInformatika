<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanggapi Pengaduan</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .card-pengaduan:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
            border-left-width: 6px !important;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-primary text-white rounded-top-3 p-4">
                <h1 class="h3 mb-0">Tanggapi Pengaduan Pelanggan</h1>
            </div>
            <div class="card-body p-4 p-md-5">
                
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if ($pengaduans->isEmpty())
                    <div class="alert alert-info text-center" role="alert">
                        <p class="mb-0">Tidak ada pengaduan yang perlu ditanggapi saat ini.</p>
                    </div>
                @else
                    <div class="list-group">
                        @foreach ($pengaduans as $pengaduan)
                        @php
                            $borderColor = ($pengaduan->status == 'Baru' || $pengaduan->status == null) ? 'border-danger' : 'border-warning';
                            $statusBadge = ($pengaduan->status == 'Baru' || $pengaduan->status == null) ? 'bg-danger' : 'bg-warning';
                            $statusText = $pengaduan->status ?? 'Baru';
                        @endphp
                        
                        <a href="{{ route('karyawan.pengaduan.show', $pengaduan->idPengaduan) }}" class="list-group-item list-group-item-action py-3 px-4 mb-3 rounded-3 shadow-sm card-pengaduan border-start border-5 {{ $borderColor }}">
                            <div class="d-flex w-100 justify-content-between align-items-center">
                                <div class="col-10">
                                    <!-- Judul/Deskripsi Awal Pengaduan -->
                                    <h5 class="mb-1 text-primary">
                                        {{ \Illuminate\Support\Str::limit($pengaduan->deskripsi, 60) }}
                                    </h5>
                                    
                                    <!-- Username Pelanggan -->
                                    <small class="d-block text-muted">
                                        @if($pengaduan->pelanggan) 
                                            <span class="fw-bold text-dark">@</span>{{ $pengaduan->pelanggan->username ?? 'Pelanggan #' . $pengaduan->idPelanggan }} 
                                        @else 
                                            Pelanggan Tidak Ditemukan 
                                        @endif
                                    </small>
                                    
                                    <span class="badge {{ $statusBadge }} text-white mt-1">{{ $statusText }}</span>
                                </div>
                                <div class="col-2 text-end">
                                    <small class="text-muted d-block mb-1">
                                        {{ \Carbon\Carbon::parse($pengaduan->tanggalPengaduan)->translatedFormat('d F Y') }}
                                    </small>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chevron-right text-secondary" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
