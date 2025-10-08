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
    <div class="text-center p-4 mb-4"
        style="background:url('https://i.ibb.co/Nn6g8jV/water-bg.jpg') no-repeat center/cover;">
        <h1 class="fw-bold text-light" style="font-size:3rem; text-shadow:2px 2px 4px #000;">
            Verifikasi<br>Pesanan
        </h1>
    </div>

    <div class="container">

        @foreach($pesanan as $p)
        <a href="/detailVer/{{ $p->idPesanan }}" class="text-decoration-none text-dark">
            <div class="card rounded-pill shadow-sm mb-3 border-0">
                <div class="card-body bg-info-subtle rounded-pill">
                    <!-- Nama pelanggan -->
                    <h5 class="fw-semibold mb-0">
                        {{ $p->pelanggan->namaPelanggan }}
                    </h5>

                    <!-- Username (ambil sebelum tanda @) -->
                    <small class="text-muted d-block">
                        {{ '@' . explode('@', $p->pelanggan->email)[0] }}
                    </small>

                    <!-- Tanggal selesai -->
                    <small class="text-danger fw-semibold">
                        {{ $p->tanggalSelesai ? \Carbon\Carbon::parse($p->tanggalSelesai)->format('d/m/Y') : '-' }}
                    </small>
                </div>
            </div>
        </a>
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