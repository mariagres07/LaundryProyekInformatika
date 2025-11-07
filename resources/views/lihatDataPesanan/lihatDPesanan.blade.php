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
    }

    footer {
        text-align: center;
        padding: 15px 0;
        font-weight: 600;
        color: #2d4b74;
    }

    .offcanvas-body a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 15px;
        margin-bottom: 8px;
        border-radius: 12px;
        text-decoration: none;
        color: #2d4b74;
        transition: 0.3s;
    }

    .offcanvas-body a:hover {
        background-color: #7ba6e0;
        color: #fff;
    }

    .logout-btn {
        background-color: #dce3e8;
        color: red;
        font-weight: bold;
        border-radius: 12px;
        padding: 8px 20px;
        border: none;
        width: 100%;
        text-align: center;
        margin-top: 15px;
    }

    .logout-btn:hover {
        background-color: #f8d7da;
        color: #a00;
    }

    .card {
        border-radius: 15px;
    }

    .header-bg {
        background: url('https://i.ibb.co/Nn6g8jV/water-bg.jpg') no-repeat center/cover;
        border-radius: 15px;
    }
    </style>
</head>

<body>

    @include('Dashboard.pelanggan_sidenav')

    <!-- HEADER DENGAN BACKGROUND WATER -->
    <div class="header-wrapper">
        <div class="header-bg"></div>
        <div class="header-content">
            Lihat Data Pesanan
        </div>
    </div>

    <div class="container">

        <!-- daftar pesanan dari database-->
        @forelse($pesanan as $p)
        <div class="pesanan-card">
            <div class="pesanan-info">
                <h5>{{ $p->pelanggan->namaPelanggan ?? 'Tidak diketahui' }}</h5>
                <small>{{ \Carbon\Carbon::parse($p->tanggalMasuk)->format('d/m/Y') }}</small>
            </div>

            @if($p->statusPesanan == 'Menunggu Penjemputan')
            <span class="status status-proses">Proses</span>
            @elseif($p->statusPesanan == 'Menunggu Pengantaran')
            <span class="status status-diantar">Diantar</span>
            @elseif($p->statusPesanan == 'Selesai')
            <span class="status status-selesai">Selesai</span>
            @else
            <span class="status">{{ $p->statusPesanan }}</span>
            @endif
        </div>
        @empty
        <p class="text-center text-muted">Belum ada data pesanan.</p>
        @endforelse
    </div>

    <!-- tombol kembali -->
    <a href="{{ url()->previous() }}" class="btn-back" title="Kembali">
        <i class="bi bi-arrow-left"></i>
    </a>

</body>
</html>
