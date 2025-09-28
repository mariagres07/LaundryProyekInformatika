<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hapus Karyawan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="card shadow p-4 text-center">
    <h4>Yakin ingin menghapus karyawan <b>{{ $karyawan->namaKaryawan }}</b>?</h4>

    <form action="{{ route('karyawan.destroy', $karyawan->idKaryawan) }}" method="POST" class="mt-3">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">Ya, Hapus</button>
      <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>

</body>
</html>
