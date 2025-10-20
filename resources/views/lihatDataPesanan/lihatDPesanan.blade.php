<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Header -->
    <div class="text-center p-3 mb-4"
        style="background:url('https://i.ibb.co/Nn6g8jV/water-bg.jpg') no-repeat center/cover;">
        <h2 class="fw-bold text-primary" style="text-shadow:1px 1px white;">Pesanan</h2>
    </div>

    <!-- Daftar Pesanan -->
    <div class="container">
        @php
        $adaProses = false;
        @endphp

        @foreach($pesanan as $p)
        @if($p->statusPesanan == '0')
        @php
        $adaProses = true;
        @endphp

        <div class="card rounded-4 shadow-sm mb-3">
            <div class="card-body d-flex justify-content-between align-items-center bg-info-subtle rounded-4">
                <div>
                    <!-- Nama pelanggan -->
                    <h5 class="mb-0 fw-semibold">
                        {{ $p->pelanggan->namaPelanggan }}
                    </h5>

                    <!-- Email pelanggan -->
                    <small class="text-muted">
                        {{ $p->pelanggan->email }}
                    </small><br>

                    <!-- Tanggal selesai -->
                    <small class="text-danger fw-semibold">
                        {{ $p->tanggalSelesai ? \Carbon\Carbon::parse($p->tanggalSelesai)->format('d/m/Y') : '-' }}
                    </small>
                </div>

                <!-- Tombol status -->
                <a href="/lihat-detail/{{ $p->idPesanan }}" class="btn btn-warning fw-semibold rounded-3">
                    Proses
                </a>
            </div>
        </div>
        @endif
        @endforeach

        @unless($adaProses)
        <div class="alert alert-info text-center rounded-4">
            Belum ada pesanan yang sedang diproses.
        </div>
        @endunless

        <!-- Tombol kembali (di kiri bawah) -->
        <div class="d-flex justify-content-start mt-4 mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>