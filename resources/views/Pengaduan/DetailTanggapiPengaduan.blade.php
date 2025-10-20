<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan</title>
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
            background-color: #f8f9fae5;
            color: red;
            border: none;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
        }

        .logout-btn:hover {
            background-color: #f5c2c7;
        }

        /* Spasi bawah navbar */
        .main-content {
            margin-top: 80px;
        }
    </style>
</head>

<body class="bg-light">

    <!-- 🔹 Navbar Atas -->
    <nav class="navbar navbar-custom fixed-top px-3">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <button class="menu-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
                aria-controls="sidebar">
                <i class="bi bi-list"></i>
            </button>
            <span class="fw-bold text-dark">IVA Laundry</span>
        </div>
    </nav>

    <!-- 🔹 Sidebar -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <a href="#" onclick="showDashboard()" data-bs-dismiss="offcanvas"><i class="bi bi-house"></i> Dashboard</a>
            <a href="#" onclick="showPengguna()" data-bs-dismiss="offcanvas"><i class="bi bi-people"></i> Manajemen Pengguna</a>
            <a href="#" onclick="showLaundry()" data-bs-dismiss="offcanvas"><i class="bi bi-basket"></i> Manajemen Laundry</a>
            <a href="{{ route('laporan.index') }}"><i class="bi bi-list-check"></i> Pesanan</a>
            <a href="{{ route('pengaduan.index') }}"><i class="bi bi-chat-dots"></i> Pengaduan</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">KELUAR</button>
            </form>
        </div>
    </div>

    <!-- 🔹 Konten Utama -->
    <div class="container py-4 main-content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center mb-4">

                    <h4 class="text-primary mb-0">Detail Pengaduan</h4>
                    <div></div>
                </div>

                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @elseif(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-title text-primary mb-0">{{ $pengaduan->judulPengaduan }}</h5>
                            @php
                            $badgeClass = match($pengaduan->statusPengaduan) {
                            'Selesai' => 'bg-success',
                            'Ditanggapi' => 'bg-info',
                            default => 'bg-warning',
                            };
                            @endphp
                            <span class="badge {{ $badgeClass }} text-white">
                                {{ $pengaduan->statusPengaduan ?? 'Menunggu' }}
                            </span>
                        </div>

                        <p class="text-muted mb-3 small">
                            <strong>Dari: {{ $pengaduan->pelanggan->nama ?? 'Anonim' }}</strong> |
                            Tanggal: {{ \Carbon\Carbon::parse($pengaduan->tanggalPengaduan)->format('d/m/Y') }}
                        </p>

                        <div class="bg-light p-3 rounded mb-4">
                            <p class="mb-0">{{ $pengaduan->deskripsi }}</p>
                        </div>

                        @if($pengaduan->media)
                        <div class="mb-4">
                            <p class="fw-bold mb-2">Lampiran:</p>
                            <img src="{{ asset('storage/' . $pengaduan->media) }}"
                                class="img-fluid rounded shadow-sm"
                                alt="Lampiran Media"
                                </div>
                            @endif

                            @if(($pengaduan->statusPengaduan ?? 'Menunggu') != 'Selesai')
                            <form action="{{ route('pengaduan.kirim', $pengaduan->idPengaduan) }}" method="POST" class="mt-4">
                                @csrf
                                <div class="mb-3">
                                    <label for="pesan" class="form-label fw-bold">Kirim Tanggapan:</label>
                                    <textarea name="pesan" id="pesan" class="form-control" rows="4"
                                        placeholder="Ketik tanggapan di sini..." required>{{ old('pesan') }}</textarea>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-send me-1"></i>Kirim Tanggapan
                                    </button>
                                </div>
                            </form>

                            <form action="{{ route('pengaduan.selesai', $pengaduan->idPengaduan) }}" method="POST" class="mt-3">
                                @csrf
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success"
                                        onclick="return confirm('Apakah yakin ingin menandai pengaduan ini sebagai selesai?')">
                                        <i class="bi bi-check-circle me-1"></i>Tandai Selesai
                                    </button>
                                </div>
                            </form>
                            @else
                            <div class="alert alert-success mt-3">
                                <i class="bi bi-check-circle-fill me-1"></i>Pengaduan ini telah selesai.
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- 🔹 Tombol kembali di bagian bawah -->
                    <div class="d-flex justify-content-start mt-4 mb-3">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left">Kembali</i>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>