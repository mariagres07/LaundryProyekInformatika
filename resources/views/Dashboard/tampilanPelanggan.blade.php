<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IVA Laundry - Dashboard Pelanggan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(to right, #528ef5, #2f6df3);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            color: white;
            font-weight: 500;
        }

        .navbar-nav .nav-link:hover {
            color: #ffdd57;
        }

        /* Hero section */
        .hero {
            background: 
                linear-gradient(rgba(63, 123, 243, 0.8), rgba(17, 54, 148, 0.8)),
                url('image.png') center/cover no-repeat;
            color: white;
            padding: 130px 20px;
            text-align: center;
        }

        .hero h1 {
            font-weight: 700;
            font-size: 2.8rem;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 25px;
        }

        .btn-order,
        .btn-pengaduan {
            background-color: #ffdd57;
            color: #0d6efd;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 30px;
        }

        .btn-order:hover,
        .btn-pengaduan:hover {
            background-color: #ffe477;
            color: #084298;
        }

        /* Diskon Section */
        .discount {
            background-color: #f4f8ff;
            padding: 70px 20px;
            text-align: center;
        }

        .discount h2 {
            color: #0d6efd;
            font-weight: 700;
            margin-bottom: 40px;
        }

        .discount .card {
            transition: transform .3s ease, box-shadow .3s ease;
            border: none;
            border-radius: 18px;
        }

        .discount .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .discount .discount-badge {
            background-color: #ff4757;
            color: white;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 25px;
        }

        /* Footer */
        footer {
            background: #2f6df3;
            color: white;
            text-align: center;
            padding: 18px;
            font-size: 0.95rem;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand">IVA Laundry</a>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon text-white"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="#" class="nav-link active">Beranda</a></li>
                    <li class="nav-item"><a href="{{ route('pesanLaundry') }}" class="nav-link">Pesan Laundry</a></li>
                    <li class="nav-item"><a href="{{ route('lihatdata.index') }}" class="nav-link">Lihat Pesanan</a></li>
                    <li class="nav-item"><a href="{{ route('pengaduan.create') }}" class="nav-link">Buat Pengaduan</a></li>
                    <li class="nav-item"><a href="{{ route('pelanggan.edit') }}" class="nav-link">Edit Profil</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Solusi Laundry Bersih, Cepat, & Terpercaya</h1>
            <p>Percayakan pakaian Anda pada layanan laundry terbaik pilihan keluarga!</p>

            <a href="{{ route('pesanLaundry') }}" class="btn btn-order me-2">
                <i class="bi bi-bag-check"></i> Pesan Laundry
            </a>
        </div>
    </section>

    <!-- Diskon Section -->
    <section class="discount" id="diskon">
        <div class="container">
            <h2>Promo & Penawaran Khusus 🎉</h2>
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
                        <p class="text-muted">Nikmati layanan antar-jemput gratis tanpa minimal order!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 IVA Laundry. Semua Hak Dilindungi.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
