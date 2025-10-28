<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Iva Laundry</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    * { font-family: 'Poppins', sans-serif; }

    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      overflow-x: hidden;
      background-color: #f8f9fa;
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

/* Footer biru dengan batas bergelombang di atas */
/* Footer biru dengan batas bergelombang di atas */
.footer {
  position: relative;
  background: linear-gradient(to bottom, #19a5e6ae 0%, #ffffff 100%);
  color: #000000ff;
  text-align: center;
  padding: 120px 20px 80px 20px;
  overflow: hidden;
  z-index: 2;
}

/* Teks footer */
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
  <!-- HERO -->
  <section class="hero">
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
  <section class="layanan-section">
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
  <footer class="footer">
    <div class="container">
      <div class="row text-start justify-content-center align-items-start">
        <div class="col-md-3 text-center text-md-start mb-4 mb-md-0">
          <div class="logo">IVA</div>
          <p style="color:#0A4174;">Laundry Service</p>
        </div>
        <div class="col-md-4">
          <h4>Kontak & Media Sosial</h4>
          <p>📱 0821-1165-5758</p>
          <p>📷 ivalaundryjogja</p>
        </div>
        <div class="col-md-4">
          <h4>Open Hours</h4>
          <p>Buka Setiap Hari</p>
          <p>⏰ 08.00 - 21.00 WIB</p>
        </div>
      </div>
    </div>
  </footer>

</body>
</html>
