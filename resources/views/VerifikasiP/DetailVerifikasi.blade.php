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
            Verifikasi {{ $pesanan->pelanggan->namaPelanggan ?? '-' }}
        </h2>
    </div>

    <div class="container">

        <!-- Alert jika sukses -->
        @if(session('success'))
        <div class="alert alert-success rounded-4">{{ session('success') }}</div>
        @endif

        <!-- Detail Pesanan -->
        <div class="row mb-2">
            <div class="col-4 text-primary fw-semibold">Nama</div>
            <div class="col-8">: {{ $pesanan->pelanggan->namaPelanggan ?? '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-4 text-primary fw-semibold">Kategori</div>
            <div class="col-8">:
                @foreach($pesanan->detailTransaksi as $detail)
                {{ $detail->namaKategori ?? '-' }} :
                {{ $detail->jumlahKategori ?? '-' }} <br>
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
            <div class="col-8">: {{ $pesanan->pelanggan->noHp ?? '-' }}</div>
        </div>

        <!-- Form input berat -->
        <form action="{{ route('verifikasi.perhitungan', $pesanan->idPesanan) }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-4 text-primary fw-semibold">Berat</div>
                <div class="col-8">
                    <input type="number" step="0.1" class="form-control" name="beratBarang"
                        value="{{ old('beratBarang', $pesanan->beratBarang) }}" placeholder="Masukkan berat (kg)"
                        required>

                </div>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">Verifikasi Pesanan</button>
            </div>
        </form>

        <!-- Tombol kembali -->
        <div class="mt-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>