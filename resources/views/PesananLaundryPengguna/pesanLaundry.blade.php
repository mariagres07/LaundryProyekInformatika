<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Pesan Laundry</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
        crossorigin="anonymous">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" 
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body class="container py-4">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-md">
      <a class="navbar-brand" href="#">Hello</a>
    </div>
  </nav>

  <!-- Alert sukses -->
  @if(session('success'))
      <div class="alert alert-success mt-3">
          {{ session('success') }}
      </div>
  @endif

  <!-- Form Pesan Laundry -->
  <form method="POST" action="{{ route('checkout') }}">
    @csrf

    <!-- Alamat -->
    <div class="mb-3">
      <label for="alamatPelanggan" class="form-label">
        <i class="bi bi-house"></i> Alamat
      </label>
      <input type="text" class="form-control" id="alamatPelanggan" name="alamat" placeholder="Masukkan alamat lengkap" required>
    </div>

    <!-- Tombol simpan alamat -->
    <div class="text-end mb-4">
      <button type="submit" class="btn btn-success rounded-pill px-4">
        <i class="bi"></i> Simpan
      </button>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-3 justify-content-center w-100" id="laundryTabs" role="tablist">
      <li class="nav-item flex-fill text-center" role="presentation">
        <button class="nav-link active w-100" id="kategori-tab" data-bs-toggle="tab" data-bs-target="#kategori" type="button" role="tab">
          Kategori Laundry
        </button>
      </li>
      <li class="nav-item flex-fill text-center" role="presentation">
        <button class="nav-link w-100" id="paket-tab" data-bs-toggle="tab" data-bs-target="#paket" type="button" role="tab">
          Jenis Paket
        </button>
      </li>
    </ul>

    <!-- Tabs content -->
    <div class="tab-content" id="laundryTabsContent">
      
  <!-- Kategori Laundry -->
<div class="tab-pane fade show active" id="kategori" role="tabpanel" aria-labelledby="kategori-tab">
  <ul class="list-group mb-4 w-100">
    
    <!-- Pakaian -->
    <li class="list-group-item d-flex justify-content-between align-items-center rounded-3 mb-3">
      <span><i class="bi bi-card-image me-2"></i> Pakaian</span>
      <div class="btn-group quantity-control">
        <button type="button" class="btn btn-outline-secondary rounded-circle px-3 minus">-</button>
        <span class="px-3 quantity">0</span>
        <button type="button" class="btn btn-outline-secondary rounded-circle px-3 plus">+</button>
      </div>
      <input type="hidden" name="pakaian" value="0" class="quantity-input">
    </li>

    <!-- Seprai -->
    <li class="list-group-item d-flex justify-content-between align-items-center rounded-3 mb-3">
      <span><i class="bi bi-card-image me-2"></i> Seprai / Selimut / Bed Cover</span>
      <div class="btn-group quantity-control">
        <button type="button" class="btn btn-outline-secondary rounded-circle px-3 minus">-</button>
        <span class="px-3 quantity">0</span>
        <button type="button" class="btn btn-outline-secondary rounded-circle px-3 plus">+</button>
      </div>
      <input type="hidden" name="seprai" value="0" class="quantity-input">
    </li>

    <!-- Handuk -->
    <li class="list-group-item d-flex justify-content-between align-items-center rounded-3 mb-3">
      <span><i class="bi bi-card-image me-2"></i> Handuk</span>
      <div class="btn-group quantity-control">
        <button type="button" class="btn btn-outline-secondary rounded-circle px-3 minus">-</button>
        <span class="px-3 quantity">0</span>
        <button type="button" class="btn btn-outline-secondary rounded-circle px-3 plus">+</button>
      </div>
      <input type="hidden" name="handuk" value="0" class="quantity-input">
    </li>

  </ul>

  <!-- Tombol checkout kategori -->
  <div class="text-center">
    <button class="btn btn-primary rounded-pill px-5" type="submit">Checkout</button>
  </div>
</div>

      <!-- Jenis Paket -->
      <div class="tab-pane fade" id="paket" role="tabpanel" aria-labelledby="paket-tab">
        <div class="mb-4">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="paket" id="paketRegulerCoffee" value="Reguler (Fresh Coffee)" required>
            <label class="form-check-label" for="paketRegulerCoffee">
              <i class="bi bi-card-image"></i> Reguler (Fresh Coffee)
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="paket" id="paketExpressCoffee" value="Express (Fresh Coffee)">
            <label class="form-check-label" for="paketExpressCoffee">
              <i class="bi bi-card-image"></i> Express (Fresh Coffee)
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="paket" id="paketRegulerVanila" value="Reguler (Vanilla)">
            <label class="form-check-label" for="paketRegulerVanila">
              <i class="bi bi-card-image"></i> Reguler (Vanilla)
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="paket" id="paketExpressVanila" value="Express (Vanilla)">
            <label class="form-check-label" for="paketExpressVanila">
              <i class="bi bi-card-image"></i> Express (Vanilla)
            </label>
          </div>
        </div>
        
        <!-- Tombol checkout paket -->
        <div class="text-center">
          <button class="btn btn-primary rounded-pill px-5" type="submit">Checkout</button>
        </div>
      </div>
    </div>
  </form>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
          integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
          crossorigin="anonymous"></script> 

<!-- Tombol kembali -->
<div class="mb-3">
  <a href="{{ url()->previous() }}" class="btn btn-secondary rounded-pill px-4">
    <i class="bi bi-arrow-left"></i> Kembali
  </a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        crossorigin="anonymous"></script>

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
