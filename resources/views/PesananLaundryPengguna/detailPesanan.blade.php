<!DOCTYPE html>
<html lang="en">
<head>  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Detail Pesanan</title>
  
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

  <h1 class="mb-4">Pesan Laundry</h1>

  <div class="card mb-4 shadow-sm">
    <div class="card-header bg-primary text-white">
      <i class="bi bi-receipt"></i> Detail Pesanan
    </div>
    <div class="card-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span><i class="bi bi-person"></i> Nama</span>
          <span>---</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span><i class="bi bi-house"></i> Alamat</span>
          <span>---</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span><i class="bi bi-tags"></i> Kategori</span>
          <span>---</span>
        </li>   
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span><i class="bi bi-box-seam"></i> Jenis Paket</span>
          <span>---</span>
        </li>   
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span><i class="bi bi-clock-history"></i> Estimasi Hari</span>
          <span>---</span>
        </li>   
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span><i class="bi bi-cash-stack"></i> Total Harga</span>
          <span>---</span>
        </li>   
      </ul>
    </div>
  </div>

  <div class="d-flex gap-2">
    <a href="#" class="btn btn-primary"><i class="bi bi-check-circle"></i> Konfirmasi Pesanan</a>
    <a href="#" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
  </div>

</body>
</html>
