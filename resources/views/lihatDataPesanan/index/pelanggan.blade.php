<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lihat Data Pesanan - IVA Laundry</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #f9f9f9 0%, #e7eef7 100%);
            min-height: 100vh;
            padding-bottom: 80px;
            /* Untuk hindari overlap dengan tombol */
        }

        .header-bg {
            background: url('https://i.ibb.co/Nn6g8jV/water-bg.jpg') no-repeat center/cover;
            border-radius: 15px;
            padding: 30px 20px;
            margin-bottom: 25px;
            color: white;
            text-align: center;
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
            font-size: 1.5rem;
            font-weight: 600;
        }

        .pesanan-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: between;
            align-items: center;
            transition: transform 0.2s, box-shadow 0.2s;
            border-left: 5px solid #007bff;
        }

        .pesanan-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .pesanan-info {
            flex: 1;
        }

        .pesanan-info h5 {
            margin: 0;
            color: #2d4b74;
            font-weight: 600;
        }

        .pesanan-info small {
            color: #6c757d;
        }

        .pesanan-detail {
            color: #007bff;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-proses {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-diantar {
            background-color: #cce7ff;
            color: #004085;
            border: 1px solid #b3d7ff;
        }

        .status-selesai {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-menunggu {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .status-diproses {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
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

        .btn-detail {
            background: #2d4b74;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 0.85rem;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-detail:hover {
            background: #1e3a5c;
            color: white;
            text-decoration: none;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #dee2e6;
        }
    </style>
</head>

<body>

    @include('Dashboard.pelanggan_sidenav')

    <div class="container mt-4">
        <!-- HEADER -->
        <div class="header-bg">
            <div class="header-content">
                <i class="bi bi-list-check me-2"></i>Data Pesanan Saya
            </div>
        </div>

        <!-- DAFTAR PESANAN -->
        @forelse($pesanan as $p)
        <div class="pesanan-card">
            <div class="pesanan-info">
                <h5>Pesanan #{{ $p->no_pesanan ?? $p->idPesanan }}</h5>
                <small>
                    <i class="bi bi-calendar3 me-1"></i>
                    {{ \Carbon\Carbon::parse($p->tanggalMasuk)->format('d/m/Y') }}
                </small>
                <div class="pesanan-detail">
                    <i class="bi bi-info-circle me-1"></i>
                    {{ $p->layanan->namaLayanan ?? 'Layanan Reguler' }} -
                    Rp {{ number_format($p->total_harga ?? 0, 0, ',', '.') }}
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <!-- STATUS PESANAN -->
                @if($p->statusPesanan == 'Menunggu Penjemputan')
                <span class="status status-menunggu">Menunggu Penjemputan</span>
                @elseif($p->statusPesanan == 'Menunggu Pembayaran')
                <span class="status status-menunggu">Menunggu Pembayaran</span>
                @elseif($p->statusPesanan == 'Diproses')
                <span class="status status-diproses">Diproses</span>
                @elseif($p->statusPesanan == 'Menunggu Pengantaran')
                <span class="status status-diantar">Menunggu Diantar</span>
                @elseif($p->statusPesanan == 'Sudah Diantar')
                <span class="status status-diantar">Sudah Diantar</span>
                @elseif($p->statusPesanan == 'Selesai')
                <span class="status status-selesai">Selesai</span>
                @else
                <span class="status">{{ $p->statusPesanan }}</span>
                @endif

                <!-- TOMBOL DETAIL -->
                <a href="{{ route('lihatdata.detail', $p->idPesanan) }}" class="btn-detail">
                    <i class="bi bi-eye me-1"></i>Detail
                </a>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <h5>Belum ada data pesanan</h5>
            <p>Silakan membuat pesanan laundry terlebih dahulu</p>
        </div>
        @endforelse
    </div>

    <!-- TOMBOL KEMBALI -->
    <a href="{{ url('/dashboard') }}" class="btn-back" title="Kembali ke Dashboard">
        <i class="bi bi-arrow-left"></i>
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>