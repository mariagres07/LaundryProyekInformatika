<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan - Kurir | IVA Laundry</title>

    <!--@if (session('role') !== 'kurir')
    <script>
    window.location.href = "{{ route('login.show') }}";
    </script>
    @endif-->

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

    @include('dashboard.kurir_sidenav')

    <!-- Header -->
    <div class="container mt-4">
        <div class="header-bg text-center py-4 mb-4 shadow-sm">
            <h2 class="fw-bold text-primary" style="text-shadow:1px 1px white;">Pesanan</h2>
        </div>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container-fluid px-4 d-flex align-items-center justify-content-between">

                <!-- Tombol Toggle Sidebar -->
                <button class="btn text-white me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
                    aria-controls="sidebar">
                    <i class="bi bi-list fs-3"></i>
                </button>

            </div>
        </nav>

        <!-- Sidebar Offcanvas -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column">
                <a href="#"><i class="bi bi-house"></i> Dashboard</a>
                <a href="#"><i class="bi bi-basket2-fill"></i> Pesan Laundry</a>
                <a href="#"><i class="bi bi-chat-dots"></i> Pengaduan</a>
                <form method="POST" action="{{ route('logout') }}" class="mt-auto">
                    @csrf
                    <button type="submit" class="logout-btn mt-3">Keluar</button>
                </form>
            </div>
        </div>

        <!-- Daftar Pesanan -->
        @php $adaProses = false; @endphp

        @foreach($pesanan as $p)
        @if($p->statusPesanan == '0')
        @php $adaProses = true; @endphp

        <div class="card shadow-sm mb-3">
            <div class="card-body d-flex justify-content-between align-items-center bg-info-subtle rounded-3">
                <div>
                    <h5 class="mb-0 fw-semibold">{{ $p->pelanggan->namaPelanggan }}</h5>
                    <small class="text-muted">{{ $p->pelanggan->email }}</small><br>
                    <small class="text-danger fw-semibold">
                        {{ $p->tanggalSelesai ? \Carbon\Carbon::parse($p->tanggalSelesai)->format('d/m/Y') : '-' }}
                    </small>
                </div>

                <a href="/lihat-detail/{{ $p->idPesanan }}" class="btn btn-warning fw-semibold rounded-3">
                    Proses
                </a>
            </div>
        </div>
        @endif
        @endforeach

        @unless($adaProses)
        <div class="alert alert-info text-center rounded-4">
            Belum ada pesanan yang sedang diproses.
        </div>
        @endunless

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