<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pengantaran - IVA Laundry</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to bottom, #f9f9f9, #e7eef7);
    }

    .header-bg {
        background-image: url("{{ asset('water.jpg') }}");
        background-repeat: no-repeat;
        background-position: left center;
        background-size: cover;
        padding: 30px 20px;
        border-radius: 15px;
        margin: 20px;
        color: white;
        position: relative;
    }

    .header-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        border-radius: 15px;
    }

    .header-content {
        position: relative;
        z-index: 1;
        text-align: left;
    }

    .info-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        margin: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-left: 5px solid #ffc107;
    }

    .btn-back {
        position: fixed;
        bottom: 20px;
        left: 20px;
        background: #2d4b74;
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        z-index: 10000;
    }
    </style>
</head>

<body>

    @include('Dashboard.kurir_sidenav')

    <!-- HEADER -->
    <div class="header-bg">
        <div class="header-content">
            <h2 class="fw-bold mb-1">
                <i class="bi bi-truck me-2"></i>Detail Pengantaran
            </h2>
            <p class="mb-0">Pesanan #{{ $pesanan->no_pesanan ?? $pesanan->idPesanan }}</p>
        </div>
    </div>

    <!-- Informasi Pelanggan -->
    <div class="info-card">
        <h5 class="fw-bold text-primary mb-3">
            <i class="bi bi-person me-2"></i>Informasi Pelanggan
        </h5>

        <strong>Nama:</strong> {{ $pesanan->pelanggan->namaPelanggan }} <br>
        <strong>No HP:</strong> {{ $pesanan->pelanggan->noHp }} <br>
        <strong>Alamat:</strong>
        <div class="p-2 bg-light rounded mt-2">{{ $pesanan->pelanggan->alamat }}</div>
    </div>

    <!-- Informasi Pesanan -->
    <div class="info-card">
        <h5 class="fw-bold text-primary mb-3">
            <i class="bi bi-clipboard-check me-2"></i>Detail Pesanan
        </h5>

        <p><strong>Tanggal Masuk:</strong> {{ \Carbon\Carbon::parse($pesanan->tanggalMasuk)->format('d/m/Y') }}</p>
        <p><strong>Paket:</strong> {{ $pesanan->layanan->namaLayanan }}</p>
        <p><strong>Total Harga:</strong>
            <span class="fw-bold text-success">Rp {{ number_format($pesanan->totalHarga, 0, ',', '.') }}</span>
        </p>
        <form action="{{ route('update.status', $pesanan->idPesanan) }}" method="POST">
            @csrf
            <input type="hidden" name="statusPesanan" value="Sudah Diantar">
            <button class="btn-deliver" onclick="return confirm('Konfirmasi pesanan sudah diantar?')">
                <i class="bi bi-check-circle"></i> Sudah Diantar
            </button>
        </form>
    </div>

    <!-- Tombol Kembali -->
    <a href="javascript:history.back()" class="btn-back">
        <i class="bi bi-arrow-left"></i>
    </a>

</body>

</html>