<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan Laundry - IVA Laundry</title>

    <!-- Bootstrap 5.3 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    body {
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
        background: #f9f9f9;
        padding-bottom: 80px;
        /* supaya konten tidak tertutup tombol fixed */
    }

    /* Sidebar */
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
        margin-top: 15px;
    }

    .logout-btn:hover {
        background-color: #f8d7da;
        color: #a00;
    }

    /* Main container */
    .main-container {
        max-width: 700px;
        margin: 40px auto;
        padding: 30px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        font-weight: bold;
        font-size: 1.1rem;
    }

    .list-group-item strong {
        display: block;
        margin-bottom: 8px;
    }

    .text-center a.btn {
        margin-top: 20px;
    }

    /* Tombol kembali fixed */
    .btn-back {
        position: fixed;
        bottom: 25px;
        left: 25px;
        background-color: #0d6efd;
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
        z-index: 1055;
        /* pastikan di atas offcanvas */
    }

    .btn-back:hover {
        background-color: #0056b3;
        transform: scale(1.1);
    }

    /* Responsive: tombol tetap terlihat di mobile */
    @media (max-width: 576px) {
        .btn-back {
            bottom: 20px;
            left: 20px;
            width: 45px;
            height: 45px;
            font-size: 1.2rem;
        }
    }
    </style>
</head>

<body>

    @include('Dashboard.karyawan_sidenav')

    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
                aria-controls="sidebar">
                <i class="bi bi-list"></i>
            </button>
            <span class="navbar-brand mb-0 h1">IVA Laundry</span>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container">

        <h2 class="mb-4 text-center">Detail Pesanan Laundry</h2>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-receipt"></i> Ringkasan Pesanan
            </div>
            <div class="card-body">

                <ul class="list-group list-group-flush">

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Nama Pelanggan</span>
                        <span>{{ $pesanan->pelanggan->namaPelanggan ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Alamat</span>
                        <span>{{ $pesanan->alamat ?? '-' }}</span>
                    </li>

                    <li class="list-group-item">
                        <strong>Kategori Laundry:</strong>
                        <ul class="mt-2 mb-0">
                            @php
                            $kategori = ['pakaian', 'seprai', 'handuk'];
                            @endphp
                            @foreach($kategori as $kat)
                            <li>{{ ucfirst($kat) }}: {{ $pesanan->{$kat} ?? 0 }}</li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Jenis Paket</span>
                        <span>{{ $pesanan->paket ?? '-' }}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Estimasi Hari</span>
                        @php
                        $hari = str_contains(strtolower($pesanan->paket ?? ''), 'express') ? 1 : 3;
                        @endphp
                        <span>{{ $hari }} Hari</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Total Harga</span>
                        <span>Rp {{ number_format($pesanan->totalHarga ?? 0, 0, ',', '.') }}</span>
                    </li>

                </ul>

            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('pesanLaundry') }}" class="btn btn-primary px-4">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>

    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>

    <!-- Tombol kembali fixed -->
    <a href="javascript:history.back()" class="btn-back" title="Kembali">
        <i class="bi bi-arrow-left"></i>
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>