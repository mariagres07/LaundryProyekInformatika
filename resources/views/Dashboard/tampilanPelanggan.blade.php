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
            margin-top: 60px; /* Add space for fixed top navbar */
        }
        
        /* Top Navigation Bar */
        .top-navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #abcfecff; /* Primary blue color */
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

        .top-navbar .profile-icon {
            font-size: 1.5rem;
            cursor: pointer;
            color: white;
            text-decoration: none;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(64, 118, 207, 0.7), rgba(64, 118, 207, 0.7)),
                url('image.png') center/cover no-repeat;
            padding: 150px 20px 130px; /* Increased top padding to account for navbar */
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
            display: inline-block;
            margin-top: 15px;
        }

        .btn-order:hover {
            background-color: #2e6edb;
            color: #ffffff;
        }

        /* Order Data Section */
        .order-data {
            padding: 70px 20px;
            text-align: center;
            background-color: #ffffff;
        }

        .order-data h2 {
            color: #0d3b66;
            font-weight: 700;
            margin-bottom: 40px;
        }

        .order-data .card {
            background: #e6f1ff;
            border: none;
            border-radius: 20px;
            transition: 0.3s;
            margin-bottom: 20px;
        }

        .order-data .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .btn-view-orders {
            background-color: #4a8fe7;
            color: white;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-view-orders:hover {
            background-color: #2e6edb;
            color: #ffffff;
        }

        .btn-complaint {
            background-color: #d64045;
            color: white;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            display: inline-block;
            margin-top: 15px;
        }

        .btn-complaint:hover {
            background-color: #b02a2f;
            color: #ffffff;
        }

        /* Footer */
        footer {
            background-color: #b9d7f2;
            color: #0d3b66;
            font-weight: 500;
            padding: 18px;
            text-align: center;
        }


        .btn-back:hover {
            background: #2e6edb;
        }
    </style>
</head>

<body>

    <!-- Top Navigation Bar -->
    <nav class="top-navbar">
        <h3 class="title">IVA Laundry</h3>
        <a href="{{ route('pelanggan.edit') }}" class="profile-icon">
            <i class="bi bi-person-circle"></i>
        </a>
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

    <!-- Order Data Section -->
    <section class="order-data">
        <div class="container">
            <h2>Lihat Data Pesanan & Buat Pengaduan</h2>

            <div class="row justify-content-center">
                <div class="col-md-6 mb-4">
                    <div class="card p-4">
                        <h4 class="fw-bold text-primary"><i class="bi bi-clipboard-check me-2"></i>Lihat Data Pesanan</h4>
                        <p class="text-muted">Lacak status dan riwayat pesanan laundry Anda.</p>
                        <a href="{{ route('lihatdata.index') }}" class="btn-view-orders">
                            <i class="bi bi-eye me-2"></i>Lihat Pesanan
                        </a>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card p-4">
                        <h4 class="fw-bold text-danger"><i class="bi bi-chat-dots me-2"></i>Buat Pengaduan</h4>
                        <p class="text-muted">Sampaikan keluhan atau masukan Anda kepada kami.</p>
                        <a href="{{ route('pengaduan.create') }}" class="btn-complaint">
                            <i class="bi bi-pencil me-2"></i>Buat Pengaduan
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