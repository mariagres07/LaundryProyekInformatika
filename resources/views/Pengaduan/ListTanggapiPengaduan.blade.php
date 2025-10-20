<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        /* Navbar */
        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Tombol menu di navbar */
        .menu-btn {
            background-color: #0d6efd;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 8px 12px;
        }

        .menu-btn:hover {
            background-color: #0b5ed7;
        }

        /* Sidebar */
        .offcanvas-body a {
            display: block;
            padding: 10px 0;
            color: #212529;
            text-decoration: none;
            font-weight: 500;
        }

        .offcanvas-body a:hover {
            color: #0d6efd;
        }

        .logout-btn {
            width: 100%;
            background-color: #f8f9fa;
            color: red;
            border: none;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
        }

        .logout-btn:hover {
            background-color: #f5c2c7;
        }

        /* Jarak konten dari navbar */
        .main-content {
            margin-top: 80px;
        }
    </style>
</head>

<body>

    <!-- 🔹 Navbar Atas -->
    <nav class="navbar navbar-custom fixed-top px-3">
        <div class="container-fluid d-flex">
            <button class="menu-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
                aria-controls="sidebar">
                <i class="bi bi-list"></i>
            </button>
            <span class="fw-bold text-dark">IVA Laundry</span>
        </div>
    </nav>

    <!-- 🔹 Sidebar Offcanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <a href="#"><i class="bi bi-house"></i> Dashboard</a>
            <a href="#"><i class="bi bi-people"></i> Manajemen Pengguna</a>
            <a href="#"><i class="bi bi-basket"></i> Manajemen Laundry</a>
            <a href="{{ route('laporan.index') }}"><i class="bi bi-list-check"></i> Pesanan</a>
            <a href="{{ route('pengaduan.index') }}"><i class="bi bi-chat-dots"></i> Pengaduan</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">KELUAR</button>
            </form>
        </div>
    </div>

    <!-- 🔹 Konten Utama -->
    <div class="container-fluid py-4 px-5 main-content">
        <h3 class="text-primary mb-4">
            <i class="bi bi-bell-fill me-2"></i>Daftar Pengaduan
        </h3>

        {{-- Pesan sukses / error --}}
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Daftar pengaduan --}}
        @if(isset($pengaduans) && count($pengaduans) > 0)
        @foreach($pengaduans as $p)
        <div class="card mb-3 shadow-sm w-100 border-0 rounded-3">
            <div class="card-body">
                <h5 class="text-primary">{{ $p->judulPengaduan }}</h5>
                <p class="text-muted small mb-2">
                    Tanggal: {{ \Carbon\Carbon::parse($p->tanggalPengaduan)->format('d/m/Y') }}
                </p>
                <p>{{ $p->deskripsi }}</p>

                @php
                $badgeClass = match($p->statusPengaduan) {
                'Selesai' => 'bg-success',
                'Ditanggapi' => 'bg-info',
                default => 'bg-warning',
                };
                @endphp

                <span class="badge {{ $badgeClass }} text-white mb-3">
                    Status: <strong>{{ $p->statusPengaduan ?? 'Menunggu' }}</strong>
                </span>

                <div class="mt-2">
                    @if(($p->statusPengaduan ?? 'Menunggu') != 'Selesai')
                    <a href="{{ route('pengaduan.show', $p->idPengaduan) }}" class="btn btn-sm btn-primary me-2">
                        <i class="bi bi-chat-dots me-1"></i>Tanggapi
                    </a>
                    <form action="{{ route('pengaduan.selesai', $p->idPengaduan) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-sm btn-success" type="submit" onclick="return confirm('Tandai sebagai selesai?');">
                            <i class="bi bi-check-circle me-1"></i>Selesai
                        </button>
                    </form>
                    @else
                    <a href="{{ route('pengaduan.show', $p->idPengaduan) }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-eye me-1"></i>Lihat Detail
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        @else
        {{-- alert hanya tampil kalau benar-benar di halaman index --}}
        @if(request()->routeIs('pengaduan.index'))
        <div class="alert alert-info">Tidak ada pengaduan ditemukan.</div>
        @endif
        @endif
    </div>

    <!-- 🔹 Tombol kembali -->
    <div class="d-flex justify-content-start mt-4 mb-3 px-5">
        <a href="{{ url()->previous() }}" class="btn btn-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>