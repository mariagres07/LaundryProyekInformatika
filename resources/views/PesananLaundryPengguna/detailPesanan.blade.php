<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
          <span>{{ $pesanan['nama'] }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>Alamat</span>
          <span>{{ $pesanan['alamat'] }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>Kategori</span>
          <span>{{ $pesanan['kategori'] }}</span>
        </li>   
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>Jenis Paket</span>
          <span>{{ $pesanan ['paket'] }}</span>
        </li>   
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>Estimasi Hari</span>
          <span>{{ $pesanan['estimasi'] }}</span>
        </li>   
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>Total Harga</span>
          <span>{{ $pesanan['harga'] }}</span>
        </li>   
      </ul>
    </div>
</div>
</body>
</html>
