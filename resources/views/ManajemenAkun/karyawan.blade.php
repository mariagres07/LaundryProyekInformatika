<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Karyawan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
  <div class="text-center mb-4">
    <h2 class="fw-bold">Data Karyawan</h2>
  </div>

  <!-- Form Cari -->
  <form method="get" action="{{ route('karyawan.index') }}" class="d-flex mb-3">
    <input type="text" class="form-control me-2" name="cari" placeholder="Cari karyawan..." value="{{ request('cari') }}">
    <button class="btn btn-primary">Cari</button>
  </form>

  <!-- Tombol Input -->
  <div class="mb-3 text-end">
    <a href="{{ route('karyawan.create') }}" class="btn btn-success">+ Input Karyawan</a>
  </div>

  <!-- Alert sukses -->
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <!-- Tabel Data -->
  <table class="table table-bordered table-hover text-center">
    <thead class="table-primary">
      <tr>
        <th>Nama Lengkap</th>
        <th>Username</th>
        <th style="width:200px;">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($karyawan as $item)
        <tr>
          <td>{{ $item->namaKaryawan }}</td>
          <td>@{{ $item->username }}</td>
          <td>
            <a href="{{ route('karyawan.edit', $item->idKaryawan) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('karyawan.destroy', $item->idKaryawan) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus karyawan ini?')">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="3" class="text-center">Data tidak ditemukan</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

</body>
</html>
