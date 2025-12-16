<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi Pesanan - IVA Laundry</title>

    @if (session('role') !== 'kurir')
    <script>
    window.location.href = "{{ route('login.show') }}";
    </script>
    @endif

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    body {
        font-family: "Poppins", sans-serif;
        background: linear-gradient(to bottom, #f9f9f9 0%, #e7eef7 100%);
        min-height: 100vh;
    }

    h2 {
        text-align: center;
        font-weight: 700;
        color: #2d4b74;
        margin-top: 40px;
        margin-bottom: 30px;
    }

    .pesanan-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #dbe8ec;
        border-radius: 40px;
        padding: 18px 25px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .pesanan-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .pesanan-info h5 {
        color: #4273b8;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .pesanan-info small {
        color: #d65a50;
        font-weight: 500;
    }

    .status {
        padding: 6px 18px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.9rem;
        border: none;
    }

    .status-proses {
        background-color: #f4b400;
        color: white;
    }

    .status-diantar {
        background-color: #64b5f6;
        color: white;
    }

    .status-selesai {
        background-color: #8bc34a;
        color: white;
    }

    /* Tombol kembali */
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

    .btn-back:hover {
        background-color: #315b94;
        transform: scale(1.08);
    }

    .btn-detail {
        background-color: #2d4b74;
        color: white;
        border-radius: 20px;
        padding: 5px 15px;
        font-size: 0.9rem;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-detail:hover {
        background-color: #1e3555;
    }

    .filter-wrapper {
        max-width: 1000px;
        margin: 0 auto;
        /* Biar ke tengah */
        padding: 0 20px;
        /* Biar tidak mepet kiri kanan */
        margin-top: 40px;
        /* Tambahkan jarak dari judul */
        margin-bottom: 35px;
        /* Tambahin jarak bawah */
    }
    </style>
</head>

<body>
    {{-- Sidebar kurir --}}
    @include('Dashboard.kurir_sidenav')

    <div class="container mt-4">
        <h2>Daftar Pesanan Belum Diverifikasi</h2>

        <!-- @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif -->
        <div class="filter-wrapper">

            <form method="GET" class="row g-3 mb-4 px-4">

                <!-- From Date -->
                <div class="col-md-3">
                    <label class="form-label">Dari Tanggal</label>
                    <input type="date" name="from" class="form-control" value="{{ request('from') }}">
                </div>

                <!-- To Date -->
                <div class="col-md-3">
                    <label class="form-label">Sampai Tanggal</label>
                    <input type="date" name="to" class="form-control" value="{{ request('to') }}">
                </div>

                <!-- Status -->
                <div class="col-md-4">
                    <label class="form-label">Filter Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="Diproses" {{ request('status')=='Diproses'?'selected':'' }}>Diproses</option>
                        <option value="Menunggu Pengantaran"
                            {{ request('status')=='Menunggu Pengantaran'?'selected':'' }}>Menunggu Pengantaran</option>
                        <option value="Sudah Diantar" {{ request('status')=='Sudah Diantar'?'selected':'' }}>Sudah
                            Diantar</option>
                        <option value="Selesai" {{ request('status')=='Selesai'?'selected':'' }}>Selesai</option>
                    </select>
                </div>

                <!-- Tombol -->
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-primary w-100">Filter</button>
                </div>

            </form>
        </div>

        @forelse ($pesanan as $p)
        <div class="pesanan-card">
            <div class="pesanan-info">
                <h5>{{ $p->pelanggan->namaPelanggan ?? 'Tidak ada'}}</h5>
                <small>{{ \Carbon\Carbon::parse($p->tanggalMasuk)->format('d/m/Y') }}</small>
            </div>

            <div class="d-flex align-items-center gap-2">
                <span class="status status-proses">{{ $p->statusPesanan }}</span>
                <a href="{{ route('detail', $p->idPesanan) }}" class="btn-detail">
                    Lihat Detail
                </a>
            </div>
        </div>
        @empty
        <div class="alert alert-info text-center mt-4">
            Tidak ada pesanan yang perlu diverifikasi.
        </div>
        @endforelse
    </div>

    <!-- Tombol kembali -->
    <a href="{{ route('dashboard.kurir') }}" class="btn-back" title="Kembali">
        <i class="bi bi-arrow-left"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>