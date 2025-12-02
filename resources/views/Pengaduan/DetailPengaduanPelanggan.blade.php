<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    {{-- SIDENAV --}}
    @include('Dashboard.pelanggan_sidenav')

    <div class="container mt-4">

        {{-- JUDUL --}}
        <h2 class="text-center mb-4 fw-bold">Detail Pengaduan</h2>

        <div class="card shadow-sm border-0">
            <div class="card-body">

                {{-- JUDUL PENGADUAN --}}
                <h4 class="fw-bold">{{ $pengaduan->judulPengaduan }}</h4>

                {{-- INFORMASI UTAMA --}}
                <div class="mt-3">
                    <p class="mb-1">
                        <strong>Tanggal Pengaduan:</strong>
                        {{ \Carbon\Carbon::parse($pengaduan->tanggalPengaduan)->format('d/m/Y') }}
                    </p>

                    <p class="mb-1">
                        <strong>ID Pesanan:</strong>
                        {{ $pengaduan->idPesanan }}
                    </p>

                    <p class="mb-2">
                        <strong>Status:</strong>
                        @if ($pengaduan->statusPengaduan == 'Belum Ditanggapi')
                            <span class="badge bg-warning text-dark">Belum Ditanggapi</span>
                        @elseif ($pengaduan->statusPengaduan == 'Diproses')
                            <span class="badge bg-primary">Diproses</span>
                        @else
                            <span class="badge bg-success">Selesai</span>
                        @endif
                    </p>

                </div>

                <hr>

                {{-- DESKRIPSI --}}
                <h6 class="fw-bold">Deskripsi Pengaduan:</h6>
                <p>{{ $pengaduan->deskripsi }}</p>

                {{-- LAMPIRAN MEDIA --}}
                <h6 class="fw-bold">Lampiran Media:</h6>
                @if ($pengaduan->media)
                    <img src="{{ asset('storage/' . $pengaduan->media) }}"
                         class="img-fluid rounded border mb-3"
                         style="max-height: 320px; object-fit: contain;">
                @else
                    <p class="text-muted">Tidak ada lampiran.</p>
                @endif

                {{-- TANGGAPAN --}}
                @if ($pengaduan->tanggapanPengaduan)
                    <div class="alert alert-info mt-4">
                        <strong>Tanggapan Petugas:</strong>
                        <br>{{ $pengaduan->tanggapanPengaduan }}
                    </div>
                @endif

            </div>
        </div>

        {{-- TOMBOL KEMBALI --}}
        <a href="{{ route('pelanggan.pengaduan.riwayat') }}" class="btn btn-secondary mb-3">
            ← Kembali
        </a>
    </div>

</body>
</html>
