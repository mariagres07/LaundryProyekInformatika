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
            background-color: #619cf5;
        }

        .navbar-brand {
            color: white;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            color: white;
            font-weight: 500;
            margin-right: 20px;
        }

        .navbar-nav .nav-link:hover {
            color: #ffd700;
        }

        /* Hero section */
        .hero {
            background: linear-gradient(rgba(84, 149, 246, 0.7), rgba(13, 110, 253, 0.6)),
                url('beranda.png') center/cover no-repeat;
            color: white;
            padding: 120px 20px;
            text-align: center;
        }

        .hero h1 {
            font-weight: 700;
        }

        .hero p {
            font-size: 1.1rem;
        }

        /* Diskon Section */
        .discount {
            background-color: #e9f2ff;
            padding: 60px 20px;
            text-align: center;
        }

        .discount h2 {
            color: #0d6efd;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .discount .card {
            border: none;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .discount .card-body {
            padding: 25px;
        }

        .discount .discount-badge {
            background-color: #ff4757;
            color: white;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 20px;
        }

        /* Tentang IVA Laundry */
        .about {
            padding: 60px 20px;
            text-align: center;
        }

        .about h2 {
            color: #0d6efd;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .about p {
            color: #555;
            font-size: 1.1rem;
            max-width: 700px;
            margin: auto;
        }

        /* Footer */
        footer {
            background-color: #0d6efd;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand">IVA Laundry</a>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-white"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="#" class="nav-link active">Beranda</a></li>
                    <li class="nav-item"><a href="#diskon" class="nav-link">Pesan Laundry</a></li>
                    <li class="nav-item"><a href="{{ route('lihatdata.index') }}" class="nav-link">Lihat Pesanan</a></li>
                    <li class="nav-item"><a href="{{ route('pelanggan.edit') }}" class="nav-link">Edit Profil</a></li>
                    <li class="nav-item"><a href="#tentang" class="nav-link">Tentang</a></li>
                    <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf
                <button type="submit" class="btn btn-light btn-sm">Logout</button>
                </form>
                </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Solusi Laundry Cepat & Terpercaya</h1>
            <p>Kami hadir untuk menjaga pakaian Anda tetap bersih, wangi, dan rapi setiap hari.</p>
        </div>
    </section>

    <!-- Diskon Section -->
    <section class="discount" id="diskon">
        <div class="container">
            <h2>Promo & Diskon Spesial</h2>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <span class="discount-badge">Diskon 20%</span>
                            <h5 class="mt-3">Cuci Setrika Minimal 5 Kg</h5>
                            <p>Dapatkan potongan harga 20% untuk setiap transaksi di atas 5 Kg.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <span class="discount-badge">Gratis Antar</span>
                            <h5 class="mt-3">Untuk Wilayah Dalam 3 KM</h5>
                            <p>Gratis layanan antar-jemput tanpa minimal order di area sekitar laundry.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang IVA Laundry -->
    <section class="about" id="tentang">
        <div class="container">
            <h2>Tentang IVA Laundry</h2>
            <p>
                IVA Laundry adalah layanan laundry profesional yang mengutamakan kualitas, kebersihan,
                dan ketepatan waktu. Kami hadir untuk memudahkan Anda dalam menjaga pakaian tetap bersih,
                wangi, dan rapi setiap hari.
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 IVA Laundry. Semua Hak Dilindungi.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
