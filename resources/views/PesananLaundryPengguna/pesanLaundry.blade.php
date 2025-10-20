<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pesan Laundry - IVA Laundry</title>

  <!-- Bootstrap 5.3 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      min-height: 100vh;
      font-family: 'Poppins', sans-serif;
      background: #f9f9f9;
    }

    /* Sidebar */
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
      cursor: pointer;
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
      margin-top: 15px;
    }
    .logout-btn:hover {
      background-color: #f8d7da;
      color: #a00;
    }

    /* Quantity Control */
    .quantity-control {
      display: flex;
      align-items: center;
      gap: 5px;
    }
    .quantity-control button {
      width: 36px;
      height: 36px;
      padding: 0;
      font-size: 1.2rem;
    }
    .quantity-control .quantity {
      min-width: 30px;
      display: inline-block;
      text-align: center;
    }

    .rounded-pill { border-radius: 50rem !important; }

    /* Container content */
    .main-container {
      max-width: 900px;
      margin: 20px auto;
      padding: 20px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.05);
    }

    /* Tabs styling */
    .nav-tabs .nav-link {
      font-weight: 500;
    }

    .nav-tabs .nav-link.active {
      background-color: #0d6efd;
      color: #fff;
      border-radius: 12px 12px 0 0;
    }

    /* Checkout button */
    .btn-checkout {
      margin-top: 10px;
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
    <a href="{{ route('pesanLaundry') }}" class="mb-2"><i class="bi bi-list-check"></i> Pesanan</a>
    <a href="{{ route('pelanggan.edit') }}" class="mb-2"><i class="bi bi-person"></i> Profil Akun</a>
    <a href="{{ route('pengaduan.create') }}" class="mb-2"><i class="bi bi-chat-dots"></i> Buat Pengaduan</a>
    <a href="{{ route('logout') }}" class="logout-btn mt-auto text-center text-decoration-none">KELUAR</a>
  </div>
</div>

  <div class="main-container">
    <!-- Alert sukses -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Alert error -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Pesan Laundry -->
    <form method="POST" action="{{ route('checkout') }}">
      @csrf
      <input type="hidden" name="namaPesanan" value="Pesanan Laundry">
      <input type="hidden" name="idLayanan" value="1">

      <!-- Alamat -->
      <div class="mb-3">
        <label for="alamatPelanggan" class="form-label">
          <i class="bi bi-house"></i> Alamat
        </label>
        <input type="text" class="form-control" id="alamatPelanggan" name="alamat" placeholder="Masukkan alamat lengkap" required>
      </div>

      <!-- Tombol simpan alamat -->
      <div class="text-end mb-4">
        <button type="button" class="btn btn-success rounded-pill px-4" id="simpanAlamat">
          <i class="bi bi-check2-circle"></i> Simpan
        </button>
      </div>

      <!-- Tabs -->
      <ul class="nav nav-tabs mb-3 justify-content-center" id="laundryTabs" role="tablist">
        <li class="nav-item flex-fill text-center" role="presentation">
          <button class="nav-link active w-100" id="kategori-tab" data-bs-toggle="tab" data-bs-target="#kategori" type="button" role="tab">Kategori Laundry</button>
        </li>
        <li class="nav-item flex-fill text-center" role="presentation">
          <button class="nav-link w-100" id="paket-tab" data-bs-toggle="tab" data-bs-target="#paket" type="button" role="tab">Jenis Paket</button>
        </li>
      </ul>

      <!-- Tabs content -->
      <div class="tab-content" id="laundryTabsContent">
        <!-- Kategori Laundry -->
        <div class="tab-pane fade show active" id="kategori" role="tabpanel" aria-labelledby="kategori-tab">
          <ul class="list-group mb-4">
            <!-- Pakaian -->
            <li class="list-group-item d-flex justify-content-between align-items-center rounded-3 mb-3">
              <span><i class="bi bi-card-image me-2"></i> Pakaian</span>
              <div class="btn-group quantity-control">
                <button type="button" class="btn btn-outline-secondary rounded-circle minus">-</button>
                <span class="px-3 quantity">0</span>
                <button type="button" class="btn btn-outline-secondary rounded-circle plus">+</button>
              </div>
              <input type="hidden" name="pakaian" value="0" class="quantity-input">
            </li>

            <!-- Seprai -->
            <li class="list-group-item d-flex justify-content-between align-items-center rounded-3 mb-3">
              <span><i class="bi bi-card-image me-2"></i> Seprai / Selimut / Bed Cover</span>
              <div class="btn-group quantity-control">
                <button type="button" class="btn btn-outline-secondary rounded-circle minus">-</button>
                <span class="px-3 quantity">0</span>
                <button type="button" class="btn btn-outline-secondary rounded-circle plus">+</button>
              </div>
              <input type="hidden" name="seprai" value="0" class="quantity-input">
            </li>

            <!-- Handuk -->
            <li class="list-group-item d-flex justify-content-between align-items-center rounded-3 mb-3">
              <span><i class="bi bi-card-image me-2"></i> Handuk</span>
              <div class="btn-group quantity-control">
                <button type="button" class="btn btn-outline-secondary rounded-circle minus">-</button>
                <span class="px-3 quantity">0</span>
                <button type="button" class="btn btn-outline-secondary rounded-circle plus">+</button>
              </div>
              <input type="hidden" name="handuk" value="0" class="quantity-input">
            </li>
          </ul>
          <div class="text-center btn-checkout">
            <button class="btn btn-primary rounded-pill px-5" type="submit">Checkout</button>
          </div>
        </div>

        <!-- Jenis Paket -->
        <div class="tab-pane fade" id="paket" role="tabpanel" aria-labelledby="paket-tab">
          <div class="mb-4">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="paket" id="paketRegulerCoffee" value="Reguler (Fresh Coffee)" required>
              <label class="form-check-label" for="paketRegulerCoffee"><i class="bi bi-card-image"></i> Reguler (Fresh Coffee)</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="paket" id="paketExpressCoffee" value="Express (Fresh Coffee)">
              <label class="form-check-label" for="paketExpressCoffee"><i class="bi bi-card-image"></i> Express (Fresh Coffee)</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="paket" id="paketRegulerVanila" value="Reguler (Vanilla)">
              <label class="form-check-label" for="paketRegulerVanila"><i class="bi bi-card-image"></i> Reguler (Vanilla)</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="paket" id="paketExpressVanila" value="Express (Vanilla)">
              <label class="form-check-label" for="paketExpressVanila"><i class="bi bi-card-image"></i> Express (Vanilla)</label>
            </div>
          </div>
          <div class="text-center btn-checkout">
            <button class="btn btn-primary rounded-pill px-5" type="submit">Checkout</button>
          </div>
        </div>
      </div>
    </form>

    <!-- Tombol kembali -->
    <div class="mt-4">
      <a href="{{ url()->previous() }}" class="btn btn-secondary rounded-pill px-4">
        <i class="bi bi-arrow-left"></i> Kembali
      </a>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Script untuk tombol +/- -->
  <script>
  document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('.quantity-control').forEach(function (group) {
          let minus = group.querySelector('.minus');
          let plus = group.querySelector('.plus');
          let quantity = group.querySelector('.quantity');
          let input = group.parentElement.querySelector('.quantity-input');

          plus.addEventListener('click', function () {
              let value = parseInt(quantity.textContent);
              value++;
              quantity.textContent = value;
              input.value = value;
          });

          minus.addEventListener('click', function () {
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

</body>
</html>
