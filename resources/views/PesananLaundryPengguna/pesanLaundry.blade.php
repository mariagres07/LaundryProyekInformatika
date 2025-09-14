<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Welcome user!</title>
  
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

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-md">
    <a class="navbar-brand" href="#">Welcome user!</a>
  </div>
</nav>

  <!-- Pilih kategori laundry atau jenis paket -->
  <div class="btn-group mb-4" role="group" aria-label="Kategori vs Paket">
    <input type="radio" class="btn-check" name="pilihanUtama" id="kategoriLaundry" autocomplete="off" checked>
    <label class="btn btn-outline-primary" for="kategoriLaundry">Kategori Laundry</label>

    <input type="radio" class="btn-check" name="pilihanUtama" id="jenisPaket" autocomplete="off">
    <label class="btn btn-outline-primary" for="jenisPaket">Jenis Paket</label>
  </div>

  <!-- Pilih jumlah kategori laundry -->
  <ul class="list-group mb-4">
    <li class="list-group-item d-flex justify-content-between align-items-center">
      <span><i class="bi bi-card-image"></i> Pakaian</span>
      <div class="btn-group">
        <button class="btn btn-outline-secondary">-</button>
        <span class="px-3">0</span>
        <button class="btn btn-outline-secondary">+</button>
      </div>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      <span><i class="bi bi-card-image"></i> Seprai / Selimut / Bed Cover</span>
      <div class="btn-group">
        <button class="btn btn-outline-secondary">-</button>
        <span class="px-3">0</span>
        <button class="btn btn-outline-secondary">+</button>
      </div>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      <span><i class="bi bi-card-image"></i> Handuk</span>
      <div class="btn-group">
        <button class="btn btn-outline-secondary">-</button>
        <span class="px-3">0</span>
        <button class="btn btn-outline-secondary">+</button>
      </div>
    </li>
  </ul>

  <!-- Tombol checkout (disabled sementara) -->
  <button type="button" class="btn btn-secondary mb-4" disabled>Checkout</button>

  <!-- Pilih jenis paket -->
  <div class="mb-3">
    <div class="form-check">
      <input class="form-check-input" type="radio" name="paket" id="paketRegulerCoffee" checked>
      <label class="form-check-label bi-card-image" for="paketRegulerCoffee">
        Reguler (Fresh Coffee)
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="paket" id="paketExpressCoffee">
      <label class="form-check-label bi-card-image" for="paketExpressCoffee">
        Express (Fresh Coffee)
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="paket" id="paketRegulerVanila">
      <label class="form-check-label bi-card-image" for="paketRegulerVanila">
        Reguler (Vanila)
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="paket" id="paketExpressVanila">
      <label class="form-check-label bi-card-image" for="paketExpressVanila">
        Express (Vanila)
      </label>
    </div>
  </div>

  <!-- Tombol checkout aktif -->
  <button class="btn btn-primary" type="submit">Checkout</button>

</body>
</html>
