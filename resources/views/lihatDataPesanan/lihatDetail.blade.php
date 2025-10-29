<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    @include('Dashboard.kurir_sidenav')

    <!-- Header -->
    <div class="text-start p-3 mb-4"
        style="background:url('https://i.ibb.co/Nn6g8jV/water-bg.jpg') no-repeat center/cover;">
        <h2 class="fw-bold text-primary" style="text-shadow:1px 1px white;">
            Detail Pesanan {{ $pesanan->pelanggan->namaPelanggan ?? '-' }}
        </h2>
    </div>

    <div class="container">

        <!-- Status & Batas Waktu -->
        <div class="rounded-4 p-3 mb-4 bg-info-subtle">
            <div class="row">
                <div class="col-6 text-primary fw-semibold">Status</div>
                <div class="col-6">:
                    {{ $pesanan->statusPesanan ?? '-' }}
                </div>
            </div>
            <div class="row">
                <div class="col-6 text-primary fw-semibold">Batas waktu pengantaran</div>
                <div class="col-6">
                    : {{ $pesanan->batasWaktu ? \Carbon\Carbon::parse($pesanan->batasWaktu)->format('d/m/Y') : '-' }}
                </div>
            </div>
        </div>

        <!-- Detail Pesanan-->
        <div class="row mb-2">
            <div class="col-4 text-primary fw-semibold">Nama</div>
            <div class="col-8">: {{ $pesanan->pelanggan->namaPelanggan ?? '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-4 text-primary fw-semibold">Kategori</div>
            <div class="col-8">:
                @forelse($pesanan->detailTransaksi as $detail)
                    <span class="badge bg-primary badge-category">
                            {{ $detail->kategoriItem->namaKategori ?? '-' }} : {{ $detail->jumlahItem ?? '-' }}
                    </span>
                @empty
                        <span class="text-muted">Tidak ada kategori</span>
                        @endforelse
            </div>
        </div>


        <div class="row mb-2">
            <div class="col-4 text-primary fw-semibold">Paket (Pewangi)</div>
            <div class="col-8">: {{ $pesanan->layanan->namaLayanan ?? '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-4 text-primary fw-semibold">Alamat</div>
            <div class="col-8">: {{ $pesanan->pelanggan->alamat ?? '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-4 text-primary fw-semibold">No HP</div>
            <div class="col-8">: {{ $pesanan->pelanggan->noHp ?? '-' }}</div>
        </div>
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