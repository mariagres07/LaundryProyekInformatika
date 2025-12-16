<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan Pengantaran - IVA Laundry</title>

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
        background-image: url("{{ asset('water.jpg') }}");
        background-repeat: no-repeat;
        background-position: left center;
        background-size: cover;
        border-radius: 15px;
        padding: 30px 20px;
        margin-bottom: 25px;
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
        font-size: 1.7rem;
        font-weight: 700;
        text-align: left;
    }

    .pesanan-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-left: 5px solid #ffc107;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .pesanan-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .delivery-info {
        color: #495057;
        font-size: 0.9rem;
        margin-top: 5px;
    }

    .address-info {
        background: #f8f9fa;
        padding: 8px 12px;
        border-radius: 8px;
        margin-top: 8px;
        font-size: 0.85rem;
        border-left: 3px solid #ffc107;
    }

    .status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .status-ready {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .btn-detail {
        background: #2d4b74;
        color: white;
        padding: 8px 15px;
        border-radius: 8px;
        text-decoration: none;
    }

    .btn-deliver {
        background: #28a745;
        color: white;
        padding: 8px 15px;
        border-radius: 8px;
        border: none;
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
        z-index: 10;
    }
    </style>
</head>

<body>

    @include('Dashboard.kurir_sidenav')

    <div class="container mt-4">

        <!-- HEADER -->
        <div class="header-bg">
            <div class="header-content">
                <i class="bi bi-truck me-2"></i>Pesanan Ready untuk Diantar
            </div>
        </div>

        <!-- LIST PESANAN -->
        @forelse($pesanan as $p)
        <div class="pesanan-card">
            <div class="pesanan-info">
                <h5>Pesanan {{ $p->no_pesanan ?? $p->idPesanan }}</h5>

                <div class="delivery-info">
                    <i class="bi bi-person me-1"></i>
                    <strong>{{ $p->pelanggan->namaPelanggan }}</strong> • {{ $p->pelanggan->noHp }}
                </div>

                <div class="address-info">
                    <i class="bi bi-geo-alt me-1"></i>
                    {{ $p->pelanggan->alamat }}
                </div>

                <small>
                    <i class="bi bi-calendar3 me-1"></i>
                    {{ \Carbon\Carbon::parse($p->tanggalSelesai)->format('d/m/Y') }}
                </small>
            </div>

            <div class="d-flex align-items-center gap-3">
                <span class="status status-ready">Menunggu Diantar</span>

                <a href="{{ route('lihatdata.detail', $p->idPesanan) }}" class="btn-detail">
                    <i class="bi bi-eye"></i> Detail
                </a>
            </div>
        </div>
        @empty
        <div class="text-center mt-5">
            <i class="bi bi-inbox" style="font-size:3rem;color:#d1d1d1;"></i>
            <h5 class="mt-3">Tidak ada pesanan untuk diantar</h5>
        </div>
        @endforelse

    </div>

    <a href="{{ url('/tampilanKurir') }}" class="btn-back" title="Kembali">
        <i class="bi bi-arrow-left"></i>
    </a>
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
</body>

</html>