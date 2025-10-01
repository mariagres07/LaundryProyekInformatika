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

    <div class="container">

        @foreach($pesanan as $p)
        <div class="card rounded-4 shadow-sm mb-3">
            <div class="card-body d-flex justify-content-between align-items-center bg-info-subtle rounded-4">
                <div>
                    <!-- Nama pelanggan -->
                    <h5 class="mb-0 fw-semibold">
                        {{ $p->pelanggan->namaPelanggan}}
                    </h5>

                    <!-- Email pelanggan -->
                    <small class="text-muted">
                        {{ $p->pelanggan->email}}
                    </small><br>

                    <!-- Tanggal selesai -->
                    <small class="text-danger fw-semibold">
                        {{ $p->tanggalSelesai ? \Carbon\Carbon::parse($p->tanggalSelesai)->format('d/m/Y') : '-' }}
                    </small>
                </div>

                <!-- Status -->
                @if($p->statusPesanan == '0')
                <button class="btn btn-warning fw-semibold rounded-3">Proses</button>
                @elseif($p->statusPesanan == '1')
                <button class="btn btn-success fw-semibold rounded-3">Selesai</button>
                @else
                <button class="btn btn-secondary fw-semibold rounded-3">
                    {{ ucfirst($p->statusPesanan) }}
                </button>
                @endif
            </div>
        </div>
        @endforeach

        @if($pesanan->isEmpty())
        <div class="alert alert-info text-center rounded-4">
            Belum ada pesanan.
        </div>
        @endif

        <!-- Tombol kembali -->
        <div class="mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>