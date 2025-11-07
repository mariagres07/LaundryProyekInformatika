<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pengaduan</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f7f9fc;
      min-height: 100vh;
    }

    /* Navbar */
    .navbar {
      background-color: #7BBDE8;
    }

    .navbar-brand {
      color: white !important;
      font-weight: bold;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .navbar-brand img {
      height: 36px;
      width: 36px;
      object-fit: cover;
      border-radius: 50%;
    }

    .navbar-toggler {
      border: none;
    }

    .navbar-toggler:focus {
      box-shadow: none;
    }

    /* Sidebar (Offcanvas) */
    .offcanvas {
      background-color: #7ba6e0;
      color: white;
      width: 230px !important;
    }

    .offcanvas a {
      display: flex;
      align-items: center;
      gap: 10px;
      color: white;
      text-decoration: none;
      padding: 10px 15px;
      border-radius: 8px;
      margin-bottom: 10px;
      transition: background-color 0.3s;
    }

    .offcanvas a:hover {
      background-color: #5a8cd6;
    }

    .logout-btn {
      background-color: #f8d7da;
      color: red;
      font-weight: bold;
      border: none;
      border-radius: 10px;
      padding: 8px;
      width: 100%;
    }

    .logout-btn:hover {
      background-color: #f1b0b7;
    }

    /* Konten */
    .content {
      padding: 100px 30px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* Form */
    .form-container {
      background: white;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
      padding: 40px;
      width: 85%;
      max-width: 1100px;
    }

    .form-container h3 {
      text-align: center;
      color: #2d4b74;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .form-container p {
      text-align: center;
      font-size: 14px;
      color: #555;
      margin-bottom: 25px;
    }

    .form-control {
      border-radius: 8px;
    }

    button {
      border-radius: 8px;
    }

    .btn-back {
      position: fixed;
      bottom: 25px;
      left: 25px;
      background-color: #8ab2d3ff;
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
    }
  </style>
</head>

<body>
  @include('Dashboard.pelanggan_sidenav')

  <!-- Konten -->
  <div class="content">
    <div class="form-container">
      <h3>Form Pengaduan</h3>
      <p>Sampaikan keluhan atau masukanmu agar layanan kami lebih baik 💬</p>
      <form>
        <div class="mb-3">
          <label for="judul" class="form-label fw-semibold">Judul Pengaduan *</label>
          <input type="text" id="judul" class="form-control" placeholder="Masukkan judul pengaduan...">
        </div>

        <div class="mb-3">
          <label for="deskripsi" class="form-label fw-semibold">Deskripsi *</label>
          <textarea id="deskripsi" rows="5" class="form-control"
            placeholder="Tuliskan deskripsi pengaduanmu..."></textarea>
        </div>

        <div class="mb-3">
          <label for="lampiran" class="form-label fw-semibold">Lampiran (opsional)</label>
          <input type="file" id="lampiran" class="form-control">
        </div>

        <div class="d-flex justify-content-end gap-2">
          <button type="submit" class="btn btn-primary px-4">Kirim</button>
          <button type="reset" class="btn btn-secondary px-4">Batal</button>
        </div>
      </form>
    </div>
  </div>

  <!-- tombol kembali -->
  <a href="{{ url()->previous() }}" class="btn-back" title="Kembali">
    <i class="bi bi-arrow-left"></i>
  </a>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>