<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pesanan Saya - IVA Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #f9f9f9 0%, #e7eef7 100%);
            min-height: 100vh;
        }

        .container-small {
            max-width: 600px;
            margin: 0 auto;
        }

        .header-bg {
            background: url('https://i.ibb.co/Nn6g8jV/water-bg.jpg') no-repeat center/cover;
            border-radius: 15px;
            padding: 25px 20px;
            margin-bottom: 20px;
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

        .info-card,
        .status-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .progress-bar-custom {
            height: 8px;
            border-radius: 4px;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-menunggu {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-diproses {
            background-color: #cce7ff;
            color: #004085;
        }

        .status-diantar {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .status-selesai {
            background-color: #d4edda;
            color: #155724;
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
            z-index: 1000;
            transition: all 0.3s;
        }

        .btn-back:hover {
            background: #1e3a5c;
            color: white;
            transform: scale(1.1);
        }

        /* Box bantuan */
        .help-box {
            position: fixed;
            bottom: 20px;
            right: 20px;
            text-align: right;
            z-index: 1000;
        }

        .help-text {
            font-size: 0.8rem;
            color: #555;
            margin-bottom: 5px;
        }

        .btn-help {
            background: #007bff;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.9rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-help:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>

    @include('Dashboard.pelanggan_sidenav')

    <div class="container-small mt-3">

        <!-- Header -->
        <div class="header-bg">
            <div class="header-content">
                <h4 class="fw-bold mb-0">
                    <i class="bi bi-clipboard-check"></i> Detail Pesanan Saya
                </h4>
                <p class="mb-0">Pesanan #{{ $pesanan->no_pesanan ?? $pesanan->idPesanan }}</p>
            </div>
        </div>

        <!-- Status Progress -->
        <div class="status-card">

            @php
            $statuses = [
            'Menunggu Penjemputan',
            'Menunggu Pembayaran',
            'Diproses',
            'Menunggu Pengantaran',
            'Sudah Diantar',
            'Selesai'
            ];

            $currentStatus = $pesanan->statusPesanan ?? $statuses[0];
            $currentIndex = array_search($currentStatus, $statuses);
            if($currentIndex === false) {
            $currentIndex = 0;
            }
            $progress = (($currentIndex + 1) / count($statuses)) * 100;
            @endphp

            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="fw-bold text-primary mb-0">Status Pesanan</h5>

                <span class="status-badge 
            @if($currentStatus == 'Menunggu Penjemputan' || $currentStatus == 'Menunggu Pembayaran') status-menunggu
            @elseif($currentStatus == 'Diproses') status-diproses
            @elseif($currentStatus == 'Menunggu Pengantaran' || $currentStatus == 'Sudah Diantar') status-diantar
            @elseif($currentStatus == 'Selesai') status-selesai
            @endif">
                    {{ $currentStatus }}
                </span>
            </div>

            <div class="progress progress-bar-custom">
                <div class="progress-bar bg-success" style="width: {{ $progress }}%"></div>
            </div>
        </div>


        <!-- Informasi Pesanan -->
        <div class="info-card">
            <h5 class="fw-bold text-primary mb-3">
                <i class="bi bi-info-circle"></i> Informasi Pesanan
            </h5>

            <div class="row">
                <div class="col-12 mb-3">
                    <strong class="text-primary">Tanggal Masuk:</strong><br>
                    {{ \Carbon\Carbon::parse($pesanan->tanggalMasuk)->format('d/m/Y H:i') }}
                </div>

                <div class="col-12 mb-3">
                    <strong class="text-primary">Paket Layanan:</strong><br>
                    {{ $pesanan->layanan->namaLayanan ?? '-' }}
                </div>
            </div>

            <strong class="text-primary">Item Laundry:</strong><br>
            <div class="mt-2">
                @forelse($pesanan->detailTransaksi as $detail)
                <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded mb-2">
                    <span>{{ $detail->kategoriItem->namaKategori ?? 'Kategori' }}</span>
                    <span class="badge bg-primary">{{ $detail->kategoriItem->jumlahItem ?? '0' }} pcs</span>
                </div>
                @empty
                <div class="text-muted p-2">Tidak ada detail item</div>
                @endforelse
            </div>
        </div>

        <!-- Informasi Biaya -->
        <div class="info-card">
            <h5 class="fw-bold text-primary mb-3">
                <i class="bi bi-cash-coin"></i> Rincian Biaya
            </h5>

            <div class="d-flex justify-content-between mb-2">
                <span>Subtotal:</span>
                <span>Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</span>
            </div>

            <div class="d-flex justify-content-between mb-2">
                <span>Biaya Pengantaran:</span>
                <span>Rp {{ number_format($pesanan->biaya_pengantaran ?? 0, 0, ',', '.') }}</span>
            </div>

            <hr>

            <div class="d-flex justify-content-between fw-bold fs-5">
                <span>Total:</span>
                <span class="text-success">
                    Rp {{ number_format(($pesanan->total_harga + $pesanan->biaya_pengantaran) ?? 0, 0, ',', '.') }}
                </span>
            </div>
        </div>

    </div>

    <!-- Floating Tombol Kembali -->
    <a href="{{ url('/dashboard') }}" class="btn-back" title="Kembali">
        <i class="bi bi-arrow-left"></i>
    </a>

    <!-- Floating Bantuan -->
    <div class="help-box">
        <div class="help-text">Butuh bantuan?</div>
        <a href="https://wa.me/6281234567890" target="_blank" class="btn-help">Hubungi CS</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>