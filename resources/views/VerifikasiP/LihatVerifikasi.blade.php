<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi Pesanan - Kurir | IVA Laundry</title>

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

    .card {
        border-radius: 15px;
    }

    .header-bg {
        background: url('https://i.ibb.co/Nn6g8jV/water-bg.jpg') no-repeat center/cover;
        border-radius: 15px;
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
    </style>
</head>

<body>
    @include('Dashboard.kurir_sidenav')

    <!-- Header -->
    <div class="text-center p-4 mb-4 header-bg text-light shadow-sm">
        <h1 class="fw-bold" style="font-size:3rem; text-shadow:2px 2px 4px #000;">
            Verifikasi<br>Pesanan
        </h1>
    </div>

    <div class="container">

        @foreach($pesanan as $p)
        <a href="/detailVer/{{ $p->idPesanan }}" class="text-decoration-none text-dark">
            <div class="card shadow-sm mb-3 border-0">
                <div class="card-body bg-info-subtle rounded-4">
                    <!-- Nama pelanggan -->
                    <h5 class="fw-semibold mb-0">{{ $p->pelanggan->namaPelanggan }}</h5>

                    <!-- Username (ambil sebelum tanda @) -->
                    <small class="text-muted d-block">
                        {{ '@' . explode('@', $p->pelanggan->email)[0] }}
                    </small>

                    <!-- Tanggal selesai -->
                    <small class="text-danger fw-semibold">
                        {{ $p->tanggalMasuk ? \Carbon\Carbon::parse($p->tanggalSelesai)->format('d/m/Y') : '-' }}
                    </small>
                </div>
            </div>
        </a>
        @endforeach

        @if($pesanan->isEmpty())
        <div class="alert alert-info text-center rounded-4">
            Belum ada pesanan.
        </div>
        @endif

        <!-- Tombol kembali -->
        <div class="mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>