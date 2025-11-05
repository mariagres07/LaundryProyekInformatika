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

        h2 {
            text-align: center;
            font-weight: 700;
            color: #2d4b74;
            margin-top: 40px;
            margin-bottom: 30px;
        }

        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 25px;
            gap: 10px;
        }

        .search-container input[type="date"] {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 8px 12px;
            font-size: 0.95rem;
        }

        .search-container button {
            background-color: #4273b8;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 8px 14px;
            transition: 0.3s;
        }

        .search-container button:hover {
            background-color: #315b94;
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

        .btn-back {
            position: fixed;
            bottom: 25px;
            left: 25px;
            background-color: #4273b8;
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
    </style>
</head>

<body>

    @include('Dashboard.pelanggan_sidenav')

    <div class="container">
        <h2>Lihat Data Pesanan</h2>

        <!-- search -->
        <form action="{{ route('lihatdata.index') }}" method="GET" class="search-container">
            <input type="date" name="tanggalPesanan" value="{{ request('tanggalPesanan') }}">
            <button type="submit" class="btn btn-primary rounded-end-pill px-3">
                <i class="bi bi-search"></i>
            </button>
        </form>

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