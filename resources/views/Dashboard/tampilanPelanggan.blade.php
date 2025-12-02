<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IVA Laundry</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f9ff;
            margin-top: 60px;
        }

        /* Navbar */
        .top-navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #abcfecff;
            color: white;
            padding: 15px 20px;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-navbar .title {
            font-weight: 700;
            font-size: 1.4rem;
            margin: 0;
        }

        .nav-icon {
            font-size: 1.5rem;
            color: white;
            text-decoration: none;
        }

        /* Hero */
        .hero {
            background: linear-gradient(rgba(64, 118, 207, 0.7), rgba(64, 118, 207, 0.7)),
                url('image.png') center/cover no-repeat;
            padding: 150px 20px 130px;
            text-align: center;
            color: white;
        }

        .btn-order {
            background-color: #4a8fe7;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-order:hover {
            background-color: #2e6edb;
            color: #ffffff;
        }

        /* SECTION CARD */
        .order-data {
            padding: 70px 20px;
            text-align: center;
        }

        /* CARD BESAR */
        .card-equal {
            background: #eaf3ff;
            border: none;
            border-radius: 25px;
            padding: 40px 30px;
            min-height: 250px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;

            /* Efek hover lembut */
            transition: transform 0.35s ease, box-shadow 0.35s ease;
            transform: translateY(0) scale(1);
        }

        /* Animasi hover naik lembut */
        .card-equal:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 18px 35px rgba(0, 0, 0, 0.12);
        }

        .card-equal h4 {
            font-weight: 700;
            font-size: 1.8rem;
        }

        /* Tombol panjang */
        .btn-long {
            width: 100%;
            padding: 14px 0;
            border-radius: 40px;
            font-size: 1.1rem;
            font-weight: 600;
        }

        footer {
            background-color: #b9d7f2;
            color: #0d3b66;
            font-weight: 500;
            padding: 18px;
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="top-navbar">
        <h3 class="title">IVA Laundry</h3>
        <div class="nav-icons">
            <a href="{{ route('pelanggan.edit') }}" class="nav-icon">
                <i class="bi bi-person-circle"></i>
            </a>

            <a href="{{ route('logout') }}" class="nav-icon"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="container">
            <h1>Solusi Laundry Bersih, Cepat, & Terpercaya</h1>
            <p>Percayakan pakaian Anda pada layanan laundry terbaik pilihan keluarga!</p>

            <a href="{{ route('pesanLaundry.index') }}" class="btn-order">
                <i class="bi bi-bag-check"></i> Pesan Laundry
            </a>
        </div>
    </section>

    <!-- Cards -->
    <section class="order-data">
        <div class="container">
            <h2>Lihat Data Pesanan & Buat Pengaduan</h2>

            <div class="row justify-content-center">

                <!-- Card Lihat Pesanan -->
                <div class="col-md-6 mb-4">
                    <div class="card-equal">
                        <div>
                            <h4 class="text-primary">
                                <i class="bi bi-clipboard-check me-2"></i>Lihat Data Pesanan
                            </h4>
                            <p class="text-muted">Lacak status dan riwayat pesanan laundry Anda.</p>
                        </div>

                        <a href="{{ route('lihatdata.index') }}" class="btn btn-primary btn-long">
                            <i class="bi bi-eye me-2"></i> Lihat Pesanan
                        </a>
                    </div>
                </div>

                <!-- Card Pengaduan -->
                <div class="col-md-6 mb-4">
                    <div class="card-equal">
                        <div>
                            <h4 class="text-danger">
                                <i class="bi bi-chat-dots me-2"></i>Buat Pengaduan
                            </h4>
                            <p class="text-muted">Sampaikan keluhan atau masukan Anda kepada kami.</p>
                        </div>

                        <a href="{{ route('pengaduan.create') }}" class="btn btn-danger btn-long">
                            <i class="bi bi-pencil me-2"></i> Buat Pengaduan
                        </a>
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
