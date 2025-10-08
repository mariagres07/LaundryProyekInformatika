<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>

<body class="bg-light">

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ route('pengaduan.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                    <h4 class="text-primary mb-0">Detail Pengaduan</h4>
                    <div></div>
                </div>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-title text-primary mb-0">{{ $pengaduan->judulPengaduan }}</h5>
                            @php
                            $badgeClass = match($pengaduan->status) {
                            'Selesai' => 'bg-success',
                            'Ditanggapi' => 'bg-info',
                            default => 'bg-warning',
                            };
                            @endphp
                            <span class="badge {{ $badgeClass }} text-white">{{ $pengaduan->status ?? 'Menunggu' }}</span>
                        </div>

                        <p class="text-muted mb-3 small">
                            <strong>Dari: {{ $pengaduan->pelanggan->nama ?? 'Anonim' }}</strong> |
                            Tanggal: {{ \Carbon\Carbon::parse($pengaduan->tanggalPengaduan)->format('d/m/Y H:i') }}
                        </p>

                        <div class="bg-light p-3 rounded mb-4">
                            <p class="mb-0">{{ $pengaduan->deskripsi }}</p>
                        </div>

                        @if($pengaduan->media)
                        <div class="mb-4">
                            <p class="fw-bold mb-2">Lampiran:</p>
                            <img src="{{ asset('storage/' . $pengaduan->media) }}"
                                class="img-fluid rounded shadow-sm"
                                alt="Lampiran Media"
                                style="max-height: 300px;"
                                onerror="this.onerror=null;this.src='https://placehold.co/600x400/808080/FFFFFF?text=Gambar+Tidak+Ditemukan';">
                        </div>
                        @endif

                        <!-- Form Kirim Tanggapan -->
                        @if(($pengaduan->status ?? 'Menunggu') != 'Selesai')
                        <form action="{{ route('pengaduan.kirim', $pengaduan->idPengaduan) }}" method="POST" class="mt-4">
                            @csrf
                            <div class="mb-3">
                                <label for="pesan" class="form-label fw-bold">Kirim Tanggapan:</label>
                                <textarea name="pesan" id="pesan" class="form-control" rows="4"
                                    placeholder="Ketik tanggapan atau pembaruan status di sini..."
                                    required>{{ old('pesan') }}</textarea>
                                @error('pesan')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send me-1"></i>Kirim Tanggapan
                                </button>
                            </div>
                        </form>
                        @endif

                        <!-- Tombol Selesai -->
                        @if(($pengaduan->status ?? 'Menunggu') != 'Selesai')
                        <form action="{{ route('pengaduan.selesai', $pengaduan->idPengaduan) }}" method="POST" class="mt-3">
                            @csrf
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success"
                                    onclick="return confirm('Apakah Anda yakin ingin menandai pengaduan ini sebagai selesai?')">
                                    <i class="bi bi-check-circle me-1"></i>Tandai Selesai
                                </button>
                            </div>
                        </form>
                        @else
                        <div class="alert alert-success mt-3">
                            <i class="bi bi-check-circle-fill me-1"></i>Pengaduan ini telah selesai.
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>