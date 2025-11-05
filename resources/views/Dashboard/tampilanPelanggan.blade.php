<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IVA Laundry </title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f9ff;
        }

        /* Navbar */
        .navbar {
            background: #b9d7f2;
        }

        .navbar-brand {
            color: #0d3b66 ;
            font-weight: 600;
        }

        .navbar-nav .nav-link {
            color: #0d3b66 !important;
            font-weight: 500;
            padding: 8px 12px;
        }

        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link:hover {
            border-bottom: 3px solid #0d3b66;
            color: #0d3b66 !important;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(64, 118, 207, 0.7), rgba(64, 118, 207, 0.7)),
                url('image.png') center/cover no-repeat;
            padding: 130px 20px;
            text-align: center;
            color: white;
        }

        .hero h1 {
            font-weight: 700;
            font-size: 2.8rem;
        }

        .btn-order {
            background-color: #4a8fe7;
            color: white;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
        }

        .btn-order:hover {
            background-color: #2e6edb;
            color: #ffffff;
        }

        /* Diskon Section */
        .discount {
            padding: 70px 20px;
            text-align: center;
            background-color: #ffffff;
        }

        .discount h2 {
            color: #0d3b66;
            font-weight: 700;
            margin-bottom: 40px;
        }

        .discount .card {
            background: #e6f1ff;
            border: none;
            border-radius: 20px;
            transition: 0.3s;
        }

        .discount .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .discount-badge {
            background: #d64045;
            color: white;
            border-radius: 20px;
            padding: 7px 18px;
            font-weight: bold;
        }

        /* Footer */
        footer {
            background-color: #b9d7f2;
            color: #0d3b66;
            font-weight: 500;
            padding: 18px;
            text-align: center;
        }

        /* Tombol Kembali */
        .btn-back {
            position: fixed;
            bottom: 25px;
            left: 25px;
            background: #4a8fe7;
            color: white;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            text-decoration: none;
            transition: 0.3s;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
        }

        .btn-back:hover {
            background: #2e6edb;
        }
    </style>
</head>

<body>

    @include('Dashboard.pelanggan_sidenav')

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand">IVA Laundry</a>

            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active">Beranda</a></li>
                    <li class="nav-item"><a href="{{ route('pesanLaundry') }}" class="nav-link">Pesan Laundry</a></li>
                    <li class="nav-item"><a href="{{ route('lihatdata.index') }}" class="nav-link">Lihat Pesanan</a></li>
                    <li class="nav-item"><a href="{{ route('pengaduan.create') }}" class="nav-link">Buat Pengaduan</a></li>
                    <li class="nav-item"><a href="{{ route('pelanggan.edit') }}" class="nav-link">Edit Profil</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="container">
            <h1>Solusi Laundry Bersih, Cepat, & Terpercaya</h1>
            <p>Percayakan pakaian Anda pada layanan laundry terbaik pilihan keluarga!</p>

            <a href="{{ route('pesanLaundry') }}" class="btn-order">
                <i class="bi bi-bag-check"></i> Pesan Laundry
            </a>
        </div>
    </section>

    <!-- Diskon -->
    <section class="discount">
        <div class="container">
            <h2>Promo & Penawaran Khusus </h2>

            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="card p-3">
                        <span class="discount-badge">Diskon 20%</span>
                        <h5 class="mt-3 fw-bold">Cuci Setrika Minimal 5 Kg</h5>
                        <p class="text-muted">Potongan harga spesial untuk transaksi di atas 5 Kg.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card p-3">
                        <span class="discount-badge">Gratis Antar</span>
                        <h5 class="mt-3 fw-bold">Wilayah Dalam Radius 3 KM</h5>
                        <p class="text-muted">Tanpa minimal order!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 IVA Laundry | Semua Hak Dilindungi.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
