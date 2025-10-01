<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Tambah Karyawan</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/mkaryawan/store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap *</label>
                    <input type="text" name="namaKaryawan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username *</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">No HP *</label>
                    <input type="text" name="noHp" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password *</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat *</label>
                    <textarea name="alamat" class="form-control" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ url('/mkaryawan') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
