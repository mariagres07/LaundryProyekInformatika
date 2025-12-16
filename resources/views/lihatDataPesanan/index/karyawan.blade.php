<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Pesanan - IVA Laundry</title>

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
        border-left: 5px solid #28a745;
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

    .customer-info {
        color: #495057;
        font-size: 0.9rem;
        margin-top: 5px;
    }

    .status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        margin-right: 10px;
    }

    .status-menunggu-penjemputan {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .status-menunggu-pembayaran {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .status-diproses {
        background-color: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }

    .status-menunggu-pengantaran {
        background-color: #cce7ff;
        color: #004085;
        border: 1px solid #b3d7ff;
    }

    .status-sudah-diantar {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .status-selesai {
        background-color: #28a745;
        color: white;
        border: 1px solid #218838;
    }

    .btn-back {
        position: fixed;
        bottom: 25px;
        left: 25px;
        background-color: #8ab2d3;
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
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        text-decoration: none;
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

    .badge-new {
        background: #dc3545;
        color: white;
        padding: 3px 8px;
        border-radius: 10px;
        font-size: 0.7rem;
        margin-left: 8px;
    }
    </style>
</head>

<body>

    @include('Dashboard.karyawan_sidenav')

    <div class="container mt-4">
        <!-- HEADER -->
        <div class="header-bg">
            <div class="header-content">
                <i class="bi bi-clipboard-data me-2"></i>Manajemen Semua Pesanan
            </div>
        </div>

        <!-- FILTERS -->
        <div class="card p-3 mb-4 shadow-sm">
            <form method="GET" action="">
                <div class="row g-3">

                    <!-- Filter Status -->
                    <div class="col-md-4">
                        <label class="form-label">Filter Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="Menunggu Penjemputan"
                                {{ request('status')=='Menunggu Penjemputan'?'selected':'' }}>Menunggu Penjemputan
                            </option>
                            <option value="Menunggu Pembayaran"
                                {{ request('status')=='Menunggu Pembayaran'?'selected':'' }}>Menunggu Pembayaran
                            </option>
                            <option value="Diproses" {{ request('status')=='Diproses'?'selected':'' }}>Diproses</option>
                            <option value="Menunggu Pengantaran"
                                {{ request('status')=='Menunggu Pengantaran'?'selected':'' }}>Menunggu Pengantaran
                            </option>
                            <option value="Sudah Diantar" {{ request('status')=='Sudah Diantar'?'selected':'' }}>Sudah
                                Diantar</option>
                            <option value="Selesai" {{ request('status')=='Selesai'?'selected':'' }}>Selesai</option>
                        </select>
                    </div>

                    <!-- Tanggal Mulai -->
                    <div class="col-md-3">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" name="from" class="form-control" value="{{ request('from') }}">
                    </div>

                    <!-- Tanggal Akhir -->
                    <div class="col-md-3">
                        <label class="form-label">Sampai Tanggal</label>
                        <input type="date" name="to" class="form-control" value="{{ request('to') }}">
                    </div>

                    <!-- Tombol -->
                    <div class="col-md-2 d-flex align-items-end">
                        <button class="btn btn-primary w-100">
                            <i class="bi bi-funnel me-1"></i>Filter
                        </button>
                    </div>

                </div>
            </form>
        </div>

        <!-- DAFTAR PESANAN -->
        @forelse($pesanan as $p)
        <div class="pesanan-card">
            <div class="pesanan-info">
                <h5>
                    Pesanan {{ $p->no_pesanan ?? $p->idPesanan }}
                    @if($p->statusPesanan == 'Menunggu Penjemputan' || $p->statusPesanan == 'Menunggu Pembayaran')
                    {{-- <span class="badge-new">BARU</span> --}}
                    @endif
                </h5>
                <div class="customer-info">
                    <i class="bi bi-person me-1"></i>
                    {{ $p->pelanggan->namaPelanggan ?? 'Tidak diketahui' }}
                    {{-- {{ $p->pelanggan->noHp ?? '-' }} --}}
                </div>
                {{-- <small> --}}
                {{-- <i class="bi bi-calendar3 me-1"></i> --}}
                {{-- {{ Carbon::parse($p->tanggalMasuk)->format('d/m/Y H:i') }} --}}
                {{-- {{ $p->layanan->namaLayanan ?? 'Layanan Reguler' }} --}}
                {{-- Rp {{ number_format($p->totalPembayaran ?? 0, 0, ',', '.') }} --}}
                {{-- </small> --}}
            </div>

            <div class="d-flex align-items-center gap-3">
                <!-- STATUS PESANAN -->
                @if($p->statusPesanan == 'Menunggu Penjemputan')
                <span class="status status-menunggu-penjemputan">Menunggu Penjemputan</span>
                @elseif($p->statusPesanan == 'Menunggu Pembayaran')
                <span class="status status-menunggu-pembayaran">Menunggu Pembayaran</span>

                {{-- Cek bukti pembayaran --}}
                @if($p->transaksiPembayaran && $p->transaksiPembayaran->buktiPembayaran)
                <span class="badge bg-success" title="Bukti pembayaran sudah diterima"
                    style="font-size:0.7rem; margin-left:5px;">✔</span>
                @endif

                @elseif($p->statusPesanan == 'Diproses')
                <span class="status status-diproses">Diproses</span>
                @elseif($p->statusPesanan == 'Menunggu Pengantaran')
                <span class="status status-menunggu-pengantaran">Menunggu Pengantaran</span>
                @elseif($p->statusPesanan == 'Sudah Diantar')
                <span class="status status-sudah-diantar">Sudah Diantar</span>
                @elseif($p->statusPesanan == 'Selesai')
                <span class="status status-selesai">Selesai</span>
                @else
                <span class="status">{{ $p->statusPesanan }}</span>
                @endif

                <!-- TOMBOL DETAIL -->
                <a href="{{ route('lihatdata.detail', $p->idPesanan) }}" class="btn-detail">
                    <i class="bi bi-gear me-1"></i>Kelola
                </a>
            </div>

        </div>
        @empty
        <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <h5>Belum ada data pesanan</h5>
            <p>Tidak ada pesanan yang tercatat dalam sistem</p>
        </div>
        @endforelse
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false
    });
    </script>
    @endif

    @if (session('error'))
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: "{{ session('error') }}",
        confirmButtonColor: '#d33'
    });
    </script>
    @endif

    <!-- Base URL untuk digunakan di file JS -->
    <script>
    const baseUrl = "{{ url('') }}";
    </script>

    <!-- File JS utama -->
    <script src="{{ asset('js/dashboard.js') }}"></script>

    <!--Tombol back-->
    <a href="{{ url('/tampilanKaryawan') }}" class="btn-back" title="Kembali">
        <i class="bi bi-arrow-left"></i>
    </a>

</body>

</html>