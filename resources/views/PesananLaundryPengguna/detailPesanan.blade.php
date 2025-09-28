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
        crossorigin="anonymous">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" 
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body class="container py-4">

  <h1 class="mb-4">Detail Pesanan Laundry</h1>

  {{-- Alert sukses --}}
  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <div class="card mb-4 shadow-sm">
    <div class="card-header bg-primary text-white">
      <i class="bi bi-receipt"></i> Ringkasan Pesanan
    </div>
    <div class="card-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>Nama</span>
          <span>{{ $nama }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>Alamat</span>
          <span>{{ $alamat }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>Kategori</span>
          <span>{{ $kategori }}</span>
        </li>   
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>Jenis Paket</span>
          <span>{{ $paket }}</span>
        </li>   
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>Estimasi Hari</span>
          <span>{{ $estimasi }}</span>
        </li>   
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>Total Harga</span>
          <span>{{ $harga }}</span>
        </li>   
      </ul>
    </div>
  </div>

  <!-- Tombol kembali -->
  <div class="mb-3">
    <a href="{{ route('pesanLaundry') }}" class="btn btn-secondary rounded-pill px-4">
      <i class="bi bi-arrow-left"></i> Kembali
    </a>
  </div>

</body>
</html>
