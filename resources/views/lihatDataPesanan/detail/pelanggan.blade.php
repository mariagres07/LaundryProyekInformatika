<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pesanan Saya - IVA Laundry</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #f9f9f9 0%, #e7eef7 100%);
            min-height: 100vh;
        }

        .container-small {
            max-width: 650px;
            margin: 0 auto;
        }

        /* HEADER */
        .header-wrapper {
            position: relative;
            width: 100%;
            height: 180px;
            overflow: hidden;
            border-bottom-left-radius: 50px;
            border-bottom-right-radius: 50px;
        }

        .header-bg-img {
            background: url('/images/water.jpg') no-repeat center/cover;
            width: 100%;
            height: 100%;
            filter: brightness(0.65);
        }

        .header-content-left {
            position: absolute;
            top: 50%;
            left: 40px;
            transform: translateY(-50%);
            color: white;
            z-index: 2;
            text-align: left;
        }

        .header-content-left h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .header-content-left span {
            font-size: 1rem;
            font-weight: 400;
        }

        /* CARD STYLE */
        .info-card,
        .status-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .progress-bar-custom {
            height: 8px;
            border-radius: 4px;
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
            z-index: 2000;
        }

        .btn-back:hover {
            background: #1e3a5c;
            transform: scale(1.08);
        }

        .help-box {
            position: fixed;
            bottom: 20px;
            right: 20px;
            text-align: right;
            z-index: 2000;
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

    <!-- HEADER -->
    <div class="header-wrapper">
        <div class="header-bg-img"></div>

        <div class="header-content-left">
            <h2>Detail Pesanan</h2>
            <span>Pesanan #{{ $pesanan->no_pesanan ?? $pesanan->idPesanan }}</span>
        </div>
    </div>

    <div class="container-small mt-4">

        <!-- STATUS PROGRESS -->
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
            if ($currentIndex === false) $currentIndex = 0;

            $progress = (($currentIndex + 1) / count($statuses)) * 100;
            @endphp

            <div class="d-flex justify-content-between align-items-center mb-3">
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

        <!-- INFORMASI PESANAN -->
        <div class="info-card">
            <h5 class="fw-bold text-primary mb-3">
                <i class="bi bi-info-circle"></i> Informasi Pesanan
            </h5>

            <div class="mb-3">
                <strong class="text-primary">Tanggal Masuk:</strong><br>
                {{ \Carbon\Carbon::parse($pesanan->tanggalMasuk)->format('d/m/Y H:i') }}
            </div>

            <div class="mb-3">
                <strong class="text-primary">Paket Layanan:</strong><br>
                {{ $pesanan->layanan->namaLayanan ?? '-' }}
            </div>

            <strong class="text-primary">Item Laundry:</strong><br>
            <div class="mt-2">
                @forelse($pesanan->detailTransaksi as $detail)
                <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded mb-2">
                    <span>{{ $detail->kategoriItem->namaKategori ?? 'Kategori' }}</span>
                    <span class="badge bg-primary">{{ $detail->jumlahItem ?? '0' }} pcs</span>
                </div>
                @empty
                <div class="text-muted p-2">Tidak ada item</div>
                @endforelse
            </div>
        </div>

        <!-- RINCIAN BIAYA -->
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
                <a href="{{ url('pembayaran/'.($pesanan->idPesanan ?? $pesanan->id)) }}" class="btn btn-primary btn-sm ms-3">
                    <i class="bi bi-credit-card me-1"></i> Lanjut ke Pembayaran
                </a>
            </div>
        </div>

    </div>

    <!-- TOMBOL KEMBALI -->
    <a href="javascript:history.back()" class="btn-back" title="Kembali">
        <i class="bi bi-arrow-left"></i>
    </a>

    <!-- BANTUAN -->
    <div class="help-box">
        <a href="https://wa.me/6283840554803" target="_blank" class="btn-help">Hubungi CS</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>