<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Header -->
    <div class="text-start p-3 mb-4"
        style="background:url('https://i.ibb.co/Nn6g8jV/water-bg.jpg') no-repeat center/cover;">
        <h2 class="fw-bold text-primary" style="text-shadow:1px 1px white;">
            {{ $pesanan->pelanggan->nama ?? '-' }}
        </h2>
    </div>

    <div class="container">

        <!-- Status & Batas Waktu -->
        <div class="rounded-4 p-3 mb-4 bg-info-subtle">
            <div class="row">
                <div class="col-6 text-primary fw-semibold">Status</div>
                <div class="col-6">: {{ ucfirst($pesanan->statusPesanan) }}</div>
            </div>
            <div class="row">
                <div class="col-6 text-primary fw-semibold">Batas waktu pengantaran</div>
                <div class="col-6">: 10.00</div>
            </div>
        </div>

        <!-- Detail -->
        <div class="row mb-2">
            <div class="col-4 text-primary fw-semibold">Nama</div>
            <div class="col-8">: {{ $pesanan->pelanggan->nama ?? '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-4 text-primary fw-semibold">Kategori</div>
            <div class="col-8">
                @foreach($pesanan->kategoriItems as $item)
                : {{ $item->kategori->namaKategori ?? '-' }} : {{ $item->jumlah }} <br>
                @endforeach
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
            <div class="col-8">: {{ $pesanan->pelanggan->noHP ?? '-' }}</div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>