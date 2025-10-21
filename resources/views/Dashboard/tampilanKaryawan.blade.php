<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Karyawan - IVA Laundry</title>

  <!-- Cek role -->
  @if (session('role') !== 'karyawan')
    <script>window.location.href = "{{ route('login.show') }}";</script>
  @endif

  <!-- Bootstrap 5.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to bottom, #f9f9f9 0%, #e7eef7 100%);
      min-height: 100vh;
    }

    .hidden {
      display: none !important;
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

    .section-header {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      border-radius: 15px;
      background: url('https://i.ibb.co/YjJ4pMK/water-bg.jpg') no-repeat center;
      background-size: cover;
      color: #fff;
      text-align: center;
    }

    .btn-section {
      max-width: 300px;
      margin: 8px auto;
      display: block;
    }

    footer {
      text-align: center;
      padding: 15px 0;
      font-weight: 600;
      color: #2d4b74;
    }

    .offcanvas-body a {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 15px;
      margin-bottom: 8px;
      border-radius: 12px;
      text-decoration: none;
      color: #2d4b74;
      transition: 0.3s;
    }

    .offcanvas-body a:hover {
      background-color: #7ba6e0;
      color: #fff;
    }

    .logout-btn {
      background-color: #dce3e8;
      color: red;
      font-weight: bold;
      border-radius: 12px;
      padding: 8px 20px;
      border: none;
      width: 100%;
      text-align: center;
      margin-top: 15px;
    }

    .logout-btn:hover {
      background-color: #f8d7da;
      color: #a00;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-light bg-light shadow-sm">
    <div class="container-fluid">
      <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
        <i class="bi bi-list"></i>
      </button>
      <span class="navbar-brand mb-0 h1">IVA Laundry</span>
    </div>
  </nav>

  <!-- Sidebar Offcanvas -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
      <a href="#" onclick="showDashboard()" data-bs-dismiss="offcanvas"><i class="bi bi-house"></i> Dashboard</a>
      <a href="#" onclick="showPengguna()" data-bs-dismiss="offcanvas"><i class="bi bi-people"></i> Manajemen Pengguna</a>
      <a href="#" onclick="showLaundry()" data-bs-dismiss="offcanvas"><i class="bi bi-basket"></i> Manajemen Laundry</a>
      <a href="{{ route('laporan.index') }}"><i class="bi bi-list-check"></i> Pesanan</a>
      <a href="{{ route('pengaduan.index') }}"><i class="bi bi-chat-dots"></i> Pengaduan</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">KELUAR</button>
      </form>
    </div>
  </div>

  <!-- Content -->
  <div class="container py-4">

    <!-- Dashboard -->
    <div id="dashboard" class="row justify-content-center">
      <div class="col-md-3 mb-4">
        <div class="menu-card" onclick="showPengguna()">
          <i class="bi bi-people menu-icon"></i>
          <h5>Manajemen Pengguna</h5>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="menu-card" onclick="showLaundry()">
          <i class="bi bi-basket menu-icon"></i>
          <h5>Manajemen Laundry</h5>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <a href="{{ route('laporan.index') }}" class="text-decoration-none text-dark">
          <div class="menu-card">
            <i class="bi bi-list-check menu-icon"></i>
            <h5>Pesanan</h5>
          </div>
        </a>
      </div>
      <div class="col-md-3 mb-4">
        <a href="{{ route('pengaduan.index') }}" class="text-decoration-none text-dark">
          <div class="menu-card">
            <i class="bi bi-chat-dots menu-icon"></i>
            <h5>Pengaduan</h5>
          </div>
        </a>
      </div>
    </div>

   <!-- Manajemen Pengguna -->
<div id="pengguna" class="hidden row justify-content-center py-4">
  <div class="col-md-4 mb-4">
    <div class="menu-card" onclick="window.location='{{ route('karyawan') }}'">
      <i class="bi bi-person-badge menu-icon"></i>
      <h5>Manajemen Karyawan</h5>
    </div>
  </div>
  <div class="col-md-4 mb-4">
    <div class="menu-card" onclick="window.location='{{ route('kurir.index') }}'">
      <i class="bi bi-truck menu-icon"></i>
      <h5>Manajemen Kurir</h5>
    </div>
  </div>
</div>

<!-- Manajemen Laundry -->
<div id="laundry" class="hidden row justify-content-center py-4">
  <div class="col-md-4 mb-4">
    <div class="menu-card" onclick="window.location='{{ route('layanan.index') }}'">
      <i class="bi bi-list-task menu-icon"></i>
      <h5>Kelola Layanan</h5>
    </div>
  </div>
  <div class="col-md-4 mb-4">
    <div class="menu-card" onclick="window.location='{{ route('laporan.index') }}'">
      <i class="bi bi-graph-up menu-icon"></i>
      <h5>Lihat Laporan</h5>
    </div>
  </div>
</div>

  </div>

  <!-- Footer -->
  <footer>
    <i class="bi bi-instagram text-danger"></i> iva.laundry &nbsp; | &nbsp; 
    <i class="bi bi-whatsapp text-success"></i> iva.laundry
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function showPengguna() {
      document.getElementById('dashboard').classList.add('hidden');
      document.getElementById('pengguna').classList.remove('hidden');
      document.getElementById('laundry').classList.add('hidden');
    }

    function showLaundry() {
      document.getElementById('dashboard').classList.add('hidden');
      document.getElementById('laundry').classList.remove('hidden');
      document.getElementById('pengguna').classList.add('hidden');
    }

    function showDashboard() {
      document.getElementById('dashboard').classList.remove('hidden');
      document.getElementById('pengguna').classList.add('hidden');
      document.getElementById('laundry').classList.add('hidden');
    }
  </script>

</body>
</html>