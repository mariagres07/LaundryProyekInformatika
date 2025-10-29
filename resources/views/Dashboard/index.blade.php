<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Iva Laundry</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Lora:wght@400;600&display=swap" rel="stylesheet">

  <style>
    /* Font default seluruh body */
    * {
      font-family: 'Poppins', sans-serif;
    }

    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      overflow-x: hidden;
      background-color: #f8f9fa;
    }

    /* ================= NAVBAR ================= */
    .navbar {
      background-color: #afe6ffae;
    }

    /* Ganti font hanya untuk teks "Iva Laundry" di navbar */
    .navbar-brand {
      font-family: 'Lora', serif;
      font-weight: 600;
      color: #1a5986ff !important;
      font-size: 1.4rem;
    }

    .navbar-nav .nav-link {
      color: #1a5986ff !important;
      font-weight: 500;
      margin: 0 10px;
      transition: 0.3s;
    }

    .navbar-nav .nav-link:hover {
      color: #062d4a !important;
      transform: scale(1.05);
    }

    /* ================= HERO ================= */
    .hero {
      background: url('IvaStore.jpg') no-repeat center center/cover;
      height: 75vh;
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
      text-align: center;
    }

    .hero::before {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0, 0, 0, 0.35);
      z-index: 1;
    }

    .hero-content {
      position: relative;
      z-index: 2;
    }

    .hero h1 {
      font-size: 3.5rem;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .hero p {
      font-size: 1.2rem;
      color: #e0e0e0;
    }

    /* ================= FRAME PUTIH ================= */
    .bottom-frame {
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      padding: 40px 20px;
      margin: -60px auto 70px auto;
      max-width: 650px;
      position: relative;
      z-index: 5;
      text-align: center;
    }

    .btn-custom {
      background-color: #19a5e6ae;
      border: none;
      color: white;
      font-weight: 600;
      border-radius: 30px;
      padding: 12px 35px;
      margin: 10px;
      transition: all 0.3s ease;
    }

    .btn-custom:hover {
      background-color: #039be5;
      transform: scale(1.05);
    }

    /* ================= LAYANAN ================= */
    .layanan-section {
      background-color: #19a5e6ae;
      color: white;
      text-align: center;
      padding: 80px 20px;
      position: relative;
      z-index: 2;
    }

    .layanan-section h2 {
      color: #fff;
      font-weight: 700;
      margin-bottom: 20px;
    }

    .layanan-section h4 {
      font-weight: 600;
      margin-top: 30px;
      color: #080603ff;
    }

    .layanan-card {
      background: #fff;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      color: #000;
    }

    .layanan-card h5 {
      color: #49769F;
      font-weight: 700;
    }

    /* ================= FOOTER ================= */
    .footer {
      position: relative;
      background: linear-gradient(to bottom, #19a5e6ae 0%, #ffffff 100%);
      color: #000000ff;
      text-align: center;
      padding: 120px 20px 80px 20px;
      overflow: hidden;
      z-index: 2;
    }

    /* Ganti font di bagian kontak IVA Laundry */
    .footer .logo {
      font-family: 'Lora', serif;
      font-weight: 600;
      font-size: 2rem;
      color: #0A4174;
    }

    .footer h4 {
      font-weight: 700;
      font-size: 1.5rem;
      margin-bottom: 15px;
    }

    .footer p {
      font-size: 1rem;
      color: #6483d3ff;
    }

    .footer a {
      color: #000000ff;
      text-decoration: none;
    }

    .footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#">Iva Laundry</a>
      <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="#home">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
          <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/masuk') }}">Masuk</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/daftar') }}">Daftar</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero" id="home">
    <div class="hero-content">
      <h1>Iva Laundry</h1>
      <p>Jl. Paingan 3 No. 3, Sleman, Yogyakarta</p>
    </div>
  </section>

  <!-- FRAME PUTIH -->
  <div class="bottom-frame">
    <h4 class="mb-4" style="color:#0A4174; font-weight:600;">Selamat Datang di Iva Laundry</h4>
    <h5 class="mb-4" style="color:#49769F; font-weight:600;">"Laundry Antar Jemput Jogja Tanpa Ribet dan Praktis"</h5>
    <a href="{{ url('/masuk') }}" class="btn btn-custom">MASUK</a>
    <a href="{{ url('/daftar') }}" class="btn btn-custom">DAFTAR</a>
  </div>

  <!-- LAYANAN -->
  <section class="layanan-section" id="layanan">
    <p class="text-uppercase" style="color:#0A4174; letter-spacing:1px;">──── Layanan Kami ────</p>
    <h2>Pilih Layanan Laundry Sesuai Kebutuhan Anda</h2>

    <h4>LAYANAN LAUNDRY EXPRESS</h4>
    <div class="container mt-5">
      <div class="row justify-content-center g-4">
        <div class="col-md-4">
          <div class="layanan-card">
            <h5>EXPRESS 1 HARI</h5>
            <p class="fs-4 fw-bold mb-0">Rp. 10.000/Kg</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="layanan-card">
            <h5>REGULAR 3 HARI</h5>
            <p class="fs-4 fw-bold mb-0">Rp. 5.000/Kg</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer" id="kontak">
    <div class="container">
      <div class="row text-start justify-content-center align-items-start">
        <div class="col-md-3 text-center text-md-start mb-4 mb-md-0">
          <div class="logo fs-3 fw-bold">IVA</div>
          <p>Laundry Service</p>
        </div>
        <div class="col-md-4">
          <h4>Kontak & Media Sosial</h4>
          <p>📱 0821-1165-5758</p>
          <p><i class="bi bi-instagram"></i> ivalaundryjogja</p>
        </div>
        <div class="col-md-4">
          <h4>Open Hours</h4>
          <p>Buka Setiap Hari</p>
          <p>⏰ 08.00 - 21.00 WIB</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
