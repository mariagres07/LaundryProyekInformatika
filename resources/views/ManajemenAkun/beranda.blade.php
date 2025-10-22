<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Pelanggan - Iva Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .hero {
            background: linear-gradient(rgba(0, 105, 255, 0.5), rgba(0, 105, 255, 0.5)), 
                        url('/images/laundry-bg.jpg') center/cover no-repeat;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .section-title {
            text-align: center;
            margin: 60px 0 30px;
            color: #007bff;
            font-weight: 700;
        }
        .feature-icon {
            font-size: 40px;
            color: #007bff;
            margin-bottom: 15px;
        }
        footer {
            background-color: #007bff;
            color: white;
            padding: 25px 0;
            text-align: center;
            margin-top: 60px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">IvaLaundry</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="/layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="/riwayat">Riwayat Pesanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="/profil">Profil Saya</a></li>
                    <li class="nav-item"><a class="btn btn-primary ms-2 text-white" href="/logout">Keluar</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="fw-bold">Selamat Datang, {{ session('nama_pelanggan') ?? 'Pelanggan' }}!</h1>
            <p class="lead mt-3">Kami siap memberikan layanan laundry terbaik dengan harga terjangkau dan hasil maksimal.</p>
            <a href="/layanan" class="btn btn-light mt-3">Pesan Sekarang</a>
        </div>
    </section>

    <!-- Why Choose Us -->
    <div class="container">
        <h2 class="section-title">Kenapa Memilih Kami?</h2>
        <div class="row text-center">
            <div class="col-md-3">
                <div class="feature-icon">🧺</div>
                <h5>Expert Cleaner</h5>
                <p>Pekerja profesional yang menangani pakaian Anda dengan penuh perhatian.</p>
            </div>
            <div class="col-md-3">
                <div class="feature-icon">💸</div>
                <h5>Harga Terjangkau</h5>
                <p>Layanan berkualitas tinggi dengan biaya yang bersahabat untuk semua kalangan.</p>
            </div>
            <div class="col-md-3">
                <div class="feature-icon">🚚</div>
                <h5>Antar Jemput Cepat</h5>
                <p>Layanan express delivery agar pakaian Anda cepat kembali bersih dan rapi.</p>
            </div>
            <div class="col-md-3">
                <div class="feature-icon">✅</div>
                <h5>Garansi Kepuasan</h5>
                <p>Kepuasan pelanggan adalah prioritas kami — kami jamin hasil terbaik.</p>
            </div>
        </div>
    </div>

    <!-- Services -->
    <div class="container">
        <h2 class="section-title">Layanan Kami</h2>
        <div class="row text-center">
            <div class="col-md-4">
                <img src="/images/coin-laundry.jpg" class="img-fluid rounded-circle mb-3" width="150">
                <h5>Coin Laundry</h5>
                <p>Laundry cepat dan praktis dengan sistem koin.</p>
            </div>
            <div class="col-md-4">
                <img src="/images/residential.jpg" class="img-fluid rounded-circle mb-3" width="150">
                <h5>Residential Laundry</h5>
                <p>Layanan untuk pakaian rumah tangga, sprei, selimut, dan lainnya.</p>
            </div>
            <div class="col-md-4">
                <img src="/images/business-laundry.jpg" class="img-fluid rounded-circle mb-3" width="150">
                <h5>Business Laundry</h5>
                <p>Solusi laundry untuk hotel, restoran, dan bisnis lainnya.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>© 2025 Iva Laundry | Bersih, Cepat, Terpercaya</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
