<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pengantaran - IVA Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #f9f9f9 0%, #e7eef7 100%);
            min-height: 100vh;
        }

        .header-bg {
            background: url('https://i.ibb.co/Nn6g8jV/water-bg.jpg') no-repeat center/cover;
            border-radius: 15px;
            padding: 25px 20px;
            margin: 15px;
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
        }

        .info-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-left: 5px solid #ffc107;
        }

        .delivery-card {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            border-radius: 15px;
            padding: 20px;
            margin: 15px;
            border: 2px solid #ffc107;
        }

        .btn-deliver {
            background: #28a745;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-deliver:hover {
            background: #218838;
            transform: scale(1.05);
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .status-ready {
            background-color: #fff3cd;
            color: #856404;
            border: 2px solid #ffc107;
        }
    </style>
</head>

<body>

    @include('Dashboard.kurir_sidenav')

    <!-- Header -->
    <div class="header-bg">
        <div class="header-content">
            <h2 class="fw-bold mb-0">
                <i class="bi bi-truck"></i> Detail Pengantaran
            </h2>
            <p class="mb-0">Pesanan #{{ $pesanan->no_pesanan ?? $pesanan->idPesanan }}</p>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Status & Info Pengantaran -->
        <div class="delivery-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="fw-bold text-warning mb-2">
                        <i class="bi bi-clock"></i> Ready untuk Diantar
                    </h5>
                    <div class="row">
                        <div class="col-6">
                            <small class="text-muted">Status Pesanan</small>
                            <div>
                                <span class="status-badge status-ready">{{ $pesanan->statusPesanan }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Batas Waktu</small>
                            <div class="fw-bold">Hari ini - 17:00</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <form action="{{ route('pesanan.update-status', $pesanan->idPesanan) }}" method="POST">
                        @csrf
                        <input type="hidden" name="statusPesanan" value="Sudah Diantar">
                        <button type="submit" class="btn-deliver"
                            onclick="return confirm('Konfirmasi pesanan sudah sampai di tujuan?')">
                            <i class="bi bi-check-circle"></i> Konfirmasi Diantar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Informasi Pelanggan -->
        <div class="info-card">
            <h5 class="fw-bold text-primary mb-3">
                <i class="bi bi-person"></i> Informasi Pelanggan
            </h5>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <strong class="text-primary">Nama:</strong><br>
                    {{ $pesanan->pelanggan->namaPelanggan ?? '-' }}
                </div>
                <div class="col-md-6 mb-2">
                    <strong class="text-primary">No. HP:</strong><br>
                    <a href="tel:{{ $pesanan->pelanggan->noHp ?? '' }}" class="text-decoration-none">
                        <i class="bi bi-telephone"></i> {{ $pesanan->pelanggan->noHp ?? '-' }}
                    </a>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <strong class="text-primary">Alamat Pengantaran:</strong><br>
                    <div class="p-3 bg-light rounded mt-1">
                        <i class="bi bi-geo-alt text-danger"></i>
                        {{ $pesanan->pelanggan->alamat ?? 'Alamat tidak tersedia' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Pesanan -->
        <div class="info-card">
            <h5 class="fw-bold text-primary mb-3">
                <i class="bi bi-clipboard-check"></i> Detail Pesanan
            </h5>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <strong class="text-primary">Tanggal Masuk:</strong><br>
                    {{ \Carbon\Carbon::parse($pesanan->tanggalMasuk)->format('d/m/Y H:i') }}
                </div>
                <div class="col-md-6 mb-2">
                    <strong class="text-primary">Paket Layanan:</strong><br>
                    {{ $pesanan->layanan->namaLayanan ?? '-' }}
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-2">
                    <strong class="text-primary">Kategori Item:</strong><br>
                    <div class="mt-2">
                        @forelse($pesanan->detailTransaksi as $detail)
                        <span class="badge bg-primary me-2 mb-2 p-2">
                            {{ $detail->kategoriItem->namaKategori ?? '-' }}:
                            {{ $detail->kategoriItem->jumlahItem ?? '0' }}
                        </span>
                        @empty
                        <span class="text-muted">Tidak ada detail item</span>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <strong class="text-primary">Total Biaya:</strong><br>
                    <h4 class="text-success fw-bold">Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}
                    </h4>
                </div>
            </div>
        </div>

        <!-- Catatan Khusus -->
        <div class="info-card">
            <h5 class="fw-bold text-primary mb-3">
                <i class="bi bi-chat-dots"></i> Catatan Khusus
            </h5>
            <div class="bg-light p-3 rounded">
                {{ $pesanan->catatan_khusus ?? 'Tidak ada catatan khusus untuk pesanan ini.' }}
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="info-card text-center">
            <a href="{{ route('lihatdata.index') }}" class="btn btn-secondary me-2">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>
            <a href="https://maps.google.com?q={{ urlencode($pesanan->pelanggan->alamat ?? '') }}" target="_blank"
                class="btn btn-primary">
                <i class="bi bi-map"></i> Buka di Maps
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>