<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda Pelanggan - IVA Laundry</title>

  <!-- Cek role -->
  @if (session('role') !== 'pelanggan')
    <script>window.location.href = "{{ route('login.show') }}";</script>
  @endif

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to bottom, #f9f9f9 0%, #e7eef7 100%);
      font-family: 'Poppins', sans-serif;
    }
    .logo {
      width: 130px;
    }
    .logout-btn {
      background-color: #dce3e8;
      color: red;
      font-weight: bold;
      border-radius: 12px;
      padding: 6px 20px;
      border: none;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      transition: 0.3s;
    }
    .logout-btn:hover {
      background-color: #f8d7da;
      color: #a00;
    }
    .menu-card {
      background-color: #ffffff;
      border-radius: 15px;
      padding: 30px 20px;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: transform 0.2s, box-shadow 0.2s;
      cursor: pointer;
    }
    .menu-card:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 14px rgba(0,0,0,0.15);
    }
    .menu-icon {
      font-size: 50px;
      color: #7ba6e0;
      margin-bottom: 15px;
    }
    footer {
      position: absolute;
      bottom: 15px;
      width: 100%;
      display: flex;
      justify-content: space-between;
      padding: 0 40px;
      font-weight: 600;
      color: #2d4b74;
    }
    footer i {
      margin-right: 6px;
    }
  </style>
</head>
<body>

  <div class="container py-4 text-center position-relative" style="min-height: 90vh;">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
      <img src="https://i.ibb.co/GHR6mt3/iva-laundry-logo.png" alt="IVA Laundry" class="logo">
      <a href="/" class="btn logout-btn">KELUAR</a>
    </div>

    <!-- Menu -->
     <!-- Pesaan Laundry -->
    <div class="row justify-content-center mt-5">
      <div class="col-md-3 mb-4">
        <a href="/pesanLaundry" class="text-decoration-none text-dark">
          <div class="menu-card">
            <i class="bi bi-washer menu-icon"></i>
            <h5>Pesan Laundry</h5>
          </div>
        </a>
      </div>

      <!-- Lihat Data Pesanan -->
      <div class="col-md-3 mb-4">
        <a href="/detailPesanan" class="text-decoration-none text-dark">
          <div class="menu-card">
            <i class="bi bi-file-text menu-icon"></i>
            <h5>Lihat Data Pesanan</h5>
          </div>
        </a>
      </div>

      <!-- Edit Profil -->
      <div class="col-md-3 mb-4">
        <a href="/editprofil" class="text-decoration-none text-dark">
          <div class="menu-card">
            <i class="bi bi-people-fill menu-icon"></i>
            <h5>Edit Profil</h5>
          </div>
        </a>
      </div>
    </div>

    <!-- Footer -->
    <footer>
      <div><i class="bi bi-instagram text-danger"></i>iva.laundry</div>
      <div><i class="bi bi-whatsapp text-success"></i>iva.laundry</div>
    </footer>
  </div>

</body>
</html>
