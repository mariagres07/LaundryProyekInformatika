<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pesan Laundry | Iva Laundry</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f7f9fc;
      font-family: 'Poppins', sans-serif;
    }

    /* Navbar */
    .navbar {
      background-color: #7bbde8;
      padding: 0.8rem 1rem;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
      color: white !important;
      font-weight: bold;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .navbar-brand img {
      height: 38px;
      width: 38px;
      border-radius: 50%;
      object-fit: cover;
    }

    .navbar-toggler {
      border: none;
      color: white;
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

    /* Konten utama */
    .main-container {
      margin: 100px auto;
      width: 90%;
      max-width: 900px;
      background: #fff;
      border-radius: 15px;
      padding: 30px 40px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .form-label {
      font-weight: 600;
      color: #2d4b74;
    }

    .nav-tabs .nav-link.active {
      background-color: #7bbde8;
      color: white;
      border: none;
    }

    .nav-tabs .nav-link {
      border: none;
      color: #7bbde8;
      font-weight: 500;
    }

    .list-group-item {
      border: 1px solid #e5e7eb;
      border-radius: 10px;
      padding: 12px 20px;
      font-size: 15px;
    }

    .quantity-control button {
      width: 32px;
      height: 32px;
      display: flex;
      justify-content: center;
      align-items: center;
      font-weight: bold;
    }

    .btn-checkout {
      margin-top: 25px;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
      padding: 8px 30px;
    }

    .btn-primary:hover {
      background-color: #005dc2;
    }

    .btn-secondary {
      background-color: #6c757d;
      border: none;
    }

    .btn-secondary:hover {
      background-color: #5a6268;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid px-3">
      <div class="d-flex align-items-center">
        <button class="btn text-white me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
          aria-controls="sidebar">
          <i class="bi bi-list fs-3"></i>
        </button>
        <a class="navbar-brand" href="#">
          Iva Laundry
        </a>
      </div>
    </div>
  </nav>

  <!-- Sidebar -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
      <a href="#"><i class="bi bi-house"></i> Dashboard</a>
      <a href="#"><i class="bi bi-basket2-fill"></i> Pesan Laundry</a>
      <a href="#"><i class="bi bi-chat-dots"></i> Pengaduan</a>
      <form method="POST" action="{{ route('logout') }}" class="mt-auto">
        @csrf
        <button type="submit" class="logout-btn mt-3">Keluar</button>
      </form>
    </div>
  </div>

  <!-- Konten -->
  <div class="main-container">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('checkout') }}">
      @csrf

      <!-- Alamat -->
      <div class="mb-3">
        <label for="alamatPelanggan" class="form-label">
          <i class="bi bi-geo-alt"></i> Alamat Lengkap
        </label>
        <input type="text" class="form-control" id="alamatPelanggan" name="alamat" placeholder="Masukkan alamat Anda"
          required>
      </div>

      <div class="text-end mb-4">
        <button type="button" class="btn btn-success rounded-pill px-4">
          <i class="bi bi-check2-circle"></i> Simpan Alamat
        </button>
      </div>

      <!-- Tabs -->
      <ul class="nav nav-tabs mb-3 justify-content-center">
        <li class="nav-item flex-fill text-center">
          <button class="nav-link active w-100" id="kategori-tab" data-bs-toggle="tab" data-bs-target="#kategori"
            type="button">Kategori Laundry</button>
        </li>
        <li class="nav-item flex-fill text-center">
          <button class="nav-link w-100" id="paket-tab" data-bs-toggle="tab" data-bs-target="#paket"
            type="button">Jenis Paket</button>
        </li>
      </ul>

      <div class="tab-content">
        <!-- Kategori -->
        <div class="tab-pane fade show active" id="kategori">
          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center mb-3">
              <span><i class="bi bi-card-image me-2"></i> Pakaian</span>
              <div class="btn-group quantity-control">
                <button type="button" class="btn btn-outline-secondary minus">-</button>
                <span class="px-3 quantity">0</span>
                <button type="button" class="btn btn-outline-secondary plus">+</button>
              </div>
              <input type="hidden" name="pakaian" value="0" class="quantity-input">
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-center mb-3">
              <span><i class="bi bi-card-image me-2"></i> Seprai / Selimut / Bed Cover</span>
              <div class="btn-group quantity-control">
                <button type="button" class="btn btn-outline-secondary minus">-</button>
                <span class="px-3 quantity">0</span>
                <button type="button" class="btn btn-outline-secondary plus">+</button>
              </div>
              <input type="hidden" name="seprai" value="0" class="quantity-input">
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span><i class="bi bi-card-image me-2"></i> Handuk</span>
              <div class="btn-group quantity-control">
                <button type="button" class="btn btn-outline-secondary minus">-</button>
                <span class="px-3 quantity">0</span>
                <button type="button" class="btn btn-outline-secondary plus">+</button>
              </div>
              <input type="hidden" name="handuk" value="0" class="quantity-input">
            </li>
          </ul>

          <div class="text-center btn-checkout">
            <button class="btn btn-primary rounded-pill px-5" type="submit">Checkout</button>
          </div>
        </div>

        <!-- Paket -->
        <div class="tab-pane fade" id="paket">
          <div class="mb-4">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="paket" id="paket1" value="Reguler (Fresh Coffee)">
              <label class="form-check-label" for="paket1"><i class="bi bi-box"></i> Reguler (Fresh Coffee)</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="paket" id="paket2" value="Express (Fresh Coffee)">
              <label class="form-check-label" for="paket2"><i class="bi bi-box"></i> Express (Fresh Coffee)</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="paket" id="paket3" value="Reguler (Vanilla)">
              <label class="form-check-label" for="paket3"><i class="bi bi-box"></i> Reguler (Vanilla)</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="paket" id="paket4" value="Express (Vanilla)">
              <label class="form-check-label" for="paket4"><i class="bi bi-box"></i> Express (Vanilla)</label>
            </div>
          </div>

          <div class="text-center btn-checkout">
            <button class="btn btn-primary rounded-pill px-5" type="submit">Checkout</button>
          </div>
        </div>
      </div>
    </form>

    <div class="mt-4 text-start">
      <a href="{{ url()->previous() }}" class="btn btn-secondary rounded-pill px-4">
        <i class="bi bi-arrow-left"></i> Kembali
      </a>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Script Tombol +/- -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.quantity-control').forEach(function(group) {
        let minus = group.querySelector('.minus');
        let plus = group.querySelector('.plus');
        let quantity = group.querySelector('.quantity');
        let input = group.parentElement.querySelector('.quantity-input');

        plus.addEventListener('click', function() {
          let value = parseInt(quantity.textContent);
          value++;
          quantity.textContent = value;
          input.value = value;
        });

        minus.addEventListener('click', function() {
          let value = parseInt(quantity.textContent);
          if (value > 0) {
            value--;
            quantity.textContent = value;
            input.value = value;
          }
        });
      });
    });
  </script>

  <button type="button" class="btn btn-success rounded-pill px-4" id="simpanAlamat">
  <i class="bi bi-check2-circle"></i> Simpan
</button>

<script>
  document.getElementById('simpanAlamat').addEventListener('click', function () {
    document.querySelector('form').submit();
  });
</script>


</body>

</html>