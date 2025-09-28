<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Input Karyawan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
  <h2 class="fw-bold mb-4 text-center">Input Karyawan Baru</h2>

  <form action="{{ route('karyawan.store') }}" method="POST" class="card p-4 shadow">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nama Lengkap</label>
      <input type="text" name="namaKaryawan" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <textarea name="alamat" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">No HP</label>
      <input type="text" name="noHp" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>

</body>
</html>
