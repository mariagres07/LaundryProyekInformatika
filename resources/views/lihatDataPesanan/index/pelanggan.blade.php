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
    }

    /* ==== HEADER WRAPPER ==== */
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
        filter: brightness(0.7);
    }

    /* TITLE LEFT */
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
        font-size: 1.2rem;
        font-weight: 400;
    }

    /* ==== CARD PESANAN ==== */
    .pesanan-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-left: 5px solid #007bff;
        transition: .2s;
    }

    .pesanan-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .pesanan-info h5 {
        margin: 0;
        color: #2d4b74;
        font-weight: 600;
    }

    .status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .status-menunggu {
        background: #f8d7da;
        color: #721c24;
    }

    .status-diproses {
        background: #d1ecf1;
        color: #0c5460;
    }

    .status-diantar {
        background: #cce7ff;
        color: #004085;
    }

    .status-selesai {
        background: #d4edda;
        color: #155724;
    }

    .status-lunas {
        background: #fff3cd;
        /* kuning pastel */
        color: #856404;
        /* coklat gelap */
    }

    .btn-detail {
        background: #2d4b74;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 8px;
        text-decoration: none;
    }

    .btn-back {
        position: fixed;
        bottom: 25px;
        left: 25px;
        background-color: #8ab2d3ff;
        color: white;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        transition: 0.3s;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    </style>
</head>

<body>

    @include('Dashboard.pelanggan_sidenav')

    <!-- HEADER -->
    <div class="header-wrapper">
        <div class="header-bg-img"></div>

        <div class="header-content-left">
            <h2>Data Pesanan</h2>
        </div>
    </div>

    <!-- FILTER FORM -->
    <form method="GET" action="{{ route('lihatdata.index') }}" class="mb-4">
        <div class="row g-3 mb-3 mt-3 px-3 justify-content-center">
            <!-- Filter Status -->
            <div class="col-md-3">
                <label for="status" class="form-label">Filter Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="Menunggu Penjemputan"
                        {{ request('status')=='Menunggu Penjemputan' ? 'selected' : '' }}>Menunggu Penjemputan</option>
                    <option value="Menunggu Pembayaran"
                        {{ request('status')=='Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                    <option value="Diproses" {{ request('status')=='Diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="Menunggu Pengantaran"
                        {{ request('status')=='Menunggu Pengantaran' ? 'selected' : '' }}>Menunggu Pengantaran</option>
                    <option value="Sudah Diantar" {{ request('status')=='Sudah Diantar' ? 'selected' : '' }}>Sudah
                        Diantar</option>
                    <option value="Selesai" {{ request('status')=='Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Lunas" {{ request('status')=='Lunas' ? 'selected' : '' }}>Lunas</option>
                </select>
            </div>

            <!-- Filter Date From -->
            <div class="col-md-2">
                <label for="from" class="form-label">Dari Tanggal</label>
                <input type="date" name="from" value="{{ request('from') }}" class="form-control"
                    placeholder="Dari tanggal">
            </div>

            <!-- Filter Date To -->
            <div class="col-md-2">
                <label for="to" class="form-label">Sampai Tanggal</label>
                <input type="date" name="to" value="{{ request('to') }}" class="form-control"
                    placeholder="Sampai tanggal">
            </div>

            <!-- Submit -->
            <div class="col-md-1 d-flex align-items-end">
                <button class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>
    <!-- ALERT KECIL DI BAWAH FORM -->
    @if (session('error'))
    <div class="alert alert-danger py-1 px-2 small w-50 mx-auto text-center">
        {{ session('error') }}
    </div>
    @endif

    <!-- CONTENT -->
    <div class="container mt-4">

        @forelse($pesanan as $p)
        <div class="pesanan-card">

            <div class="pesanan-info">
                {{-- <h5>Pesanan {{ $p->no_pesanan ?? $p->idPesanan }}</h5> --}}
                <small>
                    {{-- <i class="bi bi-calendar3 me-1"></i> --}}
                    {{ \Carbon\Carbon::parse($p->tanggalMasuk)->format('d/m/Y') }}
                </small>

                <div class="pesanan-detail">
                    {{ $p->layanan->namaLayanan ?? 'Layanan Reguler' }} -
                    Rp {{ number_format($p->totalHarga ?? 0, 0, ',', '.') }}
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
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

                @elseif($p->statusPesanan == 'Lunas')
                <span class="status status-lunas">Lunas</span>

                @elseif($p->statusPesanan == 'Selesai')
                <span class="status status-selesai">Selesai</span>

                @else
                <span class="status">{{ $p->statusPesanan }}</span>
                @endif

                <a href="{{ route('lihatdata.detail', $p->idPesanan) }}" class="btn-detail">
                    <i class="bi bi-eye me-1"></i> Detail
                </a>
            </div>

        </div>
        @empty

        <div class="text-center mt-5">
            <i class="bi bi-inbox" style="font-size:3rem;color:#d1d1d1;"></i>
            <h5 class="mt-3">Belum ada data pesanan</h5>
        </div>

        @endforelse
    </div>

    <a href="{{ url('/tampilanPelanggan?tab=pengguna') }}" class="btn-back" title="Kembali">
    <i class="bi bi-arrow-left"></i>
</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>