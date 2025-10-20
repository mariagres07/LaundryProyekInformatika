<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Buat Pengaduan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

  <div class="container mt-5">
    <div class="card shadow">
      <div class="card-body">
        <h3 class="text-center text-primary fw-bold mb-4">Buat Pengaduan</h3>

        {{-- Form pengaduan --}}
        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <!-- ID Pelanggan (hidden) -->
          <input type="hidden" name="idPelanggan" value="5">

          <!-- ID Pesanan (hidden) -->
          <input type="hidden" name="idPesanan" value="12">

          <!-- Judul -->
          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Judul <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="judul" class="form-control" placeholder="Masukkan judul pengaduan" required>
            </div>
          </div>

          <!-- Deskripsi -->
          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Deskripsi <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <textarea name="deskripsi" rows="4" class="form-control" placeholder="Tulis deskripsi pengaduan..." required></textarea>
            </div>
          </div>

          <!-- Upload file -->
          <div class="mb-3">
            <label class="form-label">Tambahkan file (opsional)</label>
            <input type="file" name="lampiran" class="form-control">
          </div>

          <!-- Tombol -->
          <div class="d-flex justify-content-end">
            <button type="submit" name="aksi" value="ya" class="btn btn-primary me-2">YA</button>
            <button type="submit" name="aksi" value="tidak" class="btn btn-secondary">TIDAK</button>
          </div>
        </form>

        {{-- Popup pesan --}}
        @if(session('pesan'))
        <script>
          alert("{{ session('pesan') }}");
        </script>
        @endif
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>