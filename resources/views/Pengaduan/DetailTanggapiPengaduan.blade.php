<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    body {
        background-color: #f7f9fc;
        min-height: 100vh;
    }

    .content {
        padding: 100px 30px;
        display: flex;
        justify-content: center;
    }

    .form-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        padding: 40px;
        width: 85%;
        max-width: 1100px;
    }

    .text-label {
        font-weight: 600;
        color: #2D4B74;
        margin-bottom: 5px;
    }

    .form-control {
        border-radius: 8px;
    }

    button {
        border-radius: 8px;
    }

    .btn-back {
        position: fixed;
        bottom: 25px;
        left: 25px;
        background-color: #8ab2d3ff;
        color: white;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    </style>
</head>

<body>

    @include('Dashboard.karyawan_sidenav')

    <div class="content">
        <div class="form-container">

            <h3 class="section-title"><i class="bi bi-chat-left-dots"></i> Detail Pengaduan</h3>

            {{-- Flash Messages --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            {{-- Info Pengaduan (Read-only) --}}
            <div class="mb-3">
                <label class="text-label">Judul Pengaduan:</label>
                <input type="text" class="form-control" value="{{ $pengaduan->judulPengaduan ?? '-' }}" readonly>
            </div>
            <div class="mb-3">
                <label class="text-label">Tanggal Pengaduan:</label>
                <input type="text" class="form-control"
                    value="{{ $pengaduan->tanggalPengaduan ? \Carbon\Carbon::parse($pengaduan->tanggalPengaduan)->format('d/m/Y') : '-' }}"
                    readonly>
            </div>
            <div class="mb-3">
                <label class="text-label">ID Pengaduan:</label>
                <input type="text" class="form-control" value="{{ $pengaduan->idPengaduan }}" readonly>
            </div>

            <div class="mb-3">
                <label class="text-label">ID Pesanan:</label>
                <input type="text" class="form-control" value="{{ $pengaduan->idPesanan ?? '-' }}" readonly>
            </div>

            <div class="mb-3">
                <label class="text-label">Deskripsi Pengaduan:</label>
                <textarea class="form-control" rows="5" readonly>{{ $pengaduan->deskripsi ?? '-' }}</textarea>
            </div>



            {{-- Status Badge --}}
            <div class="mb-3">
                <label class="text-label">Status:</label><br>
                @if($pengaduan->statusPengaduan === 'Ditanggapi')
                <span class="badge bg-success badge-status">
                    <i class="bi bi-check-circle"></i> Ditanggapi
                </span>
                @elseif($pengaduan->statusPengaduan === 'Selesai')
                <span class="badge bg-info badge-status">
                    <i class="bi bi-check-all"></i> Selesai
                </span>
                @else
                <span class="badge bg-warning text-dark badge-status">
                    <i class="bi bi-exclamation-triangle"></i> {{ $pengaduan->statusPengaduan ?? 'Menunggu' }}
                </span>
                @endif
            </div>

            {{-- Lampiran Media --}}
            @if($pengaduan->media)
            <div class="mb-3">
                <label class="text-label">Lampiran:</label><br>

                @php
                // Ambil path dari database (misal: pengaduan/namafile.jpg)
                $mediaPath = $pengaduan->media;

                // Hilangkan kemungkinan double folder
                $mediaPath = ltrim($mediaPath, '/'); // buang slash depan kalau ada

                // Path full ke file di storage
                $storagePath = storage_path('app/public/' . $mediaPath);

                // URL untuk ditampilkan
                $storageUrl = asset('storage/' . $mediaPath);

                // cek file benar-benar ada
                $finalUrl = file_exists($storagePath) ? $storageUrl : null;
                @endphp

                {{-- Tampilkan lampiran --}}
                @if ($finalUrl)
                @if(Str::endsWith($mediaPath, ['jpg','jpeg','png','gif']))
                <img src="{{ $finalUrl }}" class="img-thumbnail mt-2" style="max-width: 300px;">
                @else
                <a href="{{ $finalUrl }}" target="_blank" class="btn btn-info btn-sm">
                    <i class="bi bi-file-earmark"></i> Lihat Lampiran
                </a>
                @endif
                @else
                <div class="alert alert-warning">
                    Lampiran tidak ditemukan di server.
                </div>
                @endif

            </div>
            @endif
            {{-- END Lampiran Media --}}

            {{-- Form Tanggapan --}}
            @if($pengaduan->statusPengaduan !== 'Selesai')
            <hr class="my-4">
            <h5 class="mb-3"><i class="bi bi-reply"></i> Berikan Tanggapan</h5>

            <form action="{{ route('pengaduan.kirim', $pengaduan->idPengaduan) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="tanggapan" class="text-label">Tanggapan Pengaduan:</label>
                    <textarea name="tanggapan" id="tanggapan"
                        class="form-control @error('tanggapan') is-invalid @enderror" rows="5" required
                        placeholder="Tuliskan tanggapan untuk pengaduan ini...">{{ old('tanggapan', $pengaduan->tanggapanPengaduan ?? '') }}</textarea>

                    @error('tanggapan')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-send"></i> Kirim Tanggapan
                        </button>
                        <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </form>

            @else

            <hr class="my-4">
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Pengaduan ini sudah ditandai sebagai selesai.
            </div>
            <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>

            @endif

            <a href="{{ url()->previous() }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
            </a>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>