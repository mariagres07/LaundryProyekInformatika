<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Karyawan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
  <h2 class="fw-bold mb-4 text-center">Edit Data Karyawan</h2>

  <form action="{{ route('karyawan.update', $karyawan->idKaryawan) }}" method="POST" class="card p-4 shadow">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Nama Lengkap</label>
      <input type="text" name="namaKaryawan" class="form-control" value="{{ $karyawan->namaKaryawan }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-control" value="{{ $karyawan->username }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Password (opsional)</label>
      <input type="password" name="password" class="form-control" placeholder="Isi jika ingin ganti password">
    </div>

    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <textarea name="alamat" class="form-control" rows="3" required>{{ $karyawan->alamat }}</textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">No HP</label>
      <input type="text" name="noHp" class="form-control" value="{{ $karyawan->noHp }}" required>
    </div>

    <button type="submit" class="btn btn-warning">Update</button>
    <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>

</body>
</html>
