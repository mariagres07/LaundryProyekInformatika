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

        {{-- Nama & Alamat --}}
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>Nama Pelanggan</span>
          <span>{{ $pesanan->pelanggan->namaPelanggan ?? '-' }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>Alamat</span>
          <span>{{ $pesanan->alamat ?? '-' }}</span>
        </li>

        {{-- Kategori Laundry --}}
        <li class="list-group-item">
          <strong>Kategori Laundry:</strong>
          <ul class="mt-2 mb-0">
            <li>Pakaian: {{ $pesanan->pakaian ?? 0 }}</li>
            <li>Seprai / Selimut / Bed Cover: {{ $pesanan->seprai ?? 0 }}</li>
            <li>Handuk: {{ $pesanan->handuk ?? 0 }}</li>
          </ul>
        </li>

        {{-- Jenis Paket --}}
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>Jenis Paket</span>
          <span>{{ $pesanan->paket ?? '-' }}</span>
        </li>

        {{-- Estimasi Hari --}}
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>Estimasi Hari</span>
          @php
              $hari = str_contains(strtolower($pesanan->paket ?? ''), 'express') ? 1 : 3;
          @endphp
          <span>{{ $hari }} Hari</span>
        </li>

        {{-- Total Harga --}}
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>Total Harga</span>
          <span>Rp {{ number_format($pesanan->totalHarga ?? 0, 0, ',', '.') }}</span>
        </li>

      </ul>
    </div>
  </div>
  <div class="text-center">
    <a href="{{ route('pesanLaundry') }}" class="btn btn-primary px-4">Kembali ke Beranda</a>
</div>
</body>
</html>
